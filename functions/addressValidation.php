<?php
/**
 * Created by PhpStorm.
 * User: Paty-A
 * Date: 3/7/16
 * Time: 5:20 PM
 */
class confirm{

    public function remove_slashes($string) {
        $string=implode("",explode("\\",$string));
        return stripslashes(trim($string));
    }

    public function strip_tags_content($text, $tags = '', $invert = FALSE) {
        preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
        $tags = array_unique($tags[1]);
        if(is_array($tags) AND count($tags) > 0) {
            if($invert == FALSE) {
                return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
            }
            else {
                return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
            }
        }
        elseif($invert == FALSE) {
            return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
        }
        return $text;
    }

    protected function assign_store($lat, $long) {
        $store = $this->get_delivery_store($lat, $long);
        if ($_SESSION['order']['store'] != $store) {
            $_SESSION['order']['store'] = $store;
        }
        return $store;
    }

    protected function get_delivery_store($ulat, $ulng) {
        global $db;
        /* check all stores for address contained */
        $stores = $db->get_all_stores();
        $point = new Point();
        foreach ($stores as $k => $v) {
            /* check if point in polygon */
            $polygon = $this->get_polygon($k);
            $status = $point->pointInPolygon($ulat." ".$ulng, $polygon);
            if($status!="outside") {
                return $k;
            }
        }
        return false;
    }

    private function get_polygon($store) {
        global $db;
        $coords = $db->get_store_polygon_by_id($store);
        if(is_array($coords)) {
            foreach($coords as $item) {
                $polygon[] = $item['dlat']." ".$item['dlng'];
            }
            $polygon[] = $polygon[0];
            return $polygon;
        }
        return false;
    }


    public function geocode($address){
        include('geolocation.php');
        /**
         * @params: $address array
         * @perform: sanitize $address
         * @return: geolocation data.
         */
        $core_address = [
            $address['address_1'],
            $address['city'],
            $address['abbreviation'],
            $address['zip']
        ];
        $address = implode("+", $core_address);
        $address = urlencode($address);
        $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
        $resp_json = file_get_contents($url);
        $resp = json_decode($resp_json, true);
        // response status will be 'OK', if able to geocode given address
        if ($resp['status'] == 'OK') {
            // get the important data
            $lati = $resp['results'][0]['geometry']['location']['lat'];
            $longi = $resp['results'][0]['geometry']['location']['lng'];
            $formatted_address = $resp['results'][0]['formatted_address'];
            // verify if data is complete
            if ($lati && $longi && $formatted_address) {
                $data_arr = [];
                array_push(
                    $data_arr,
                    $lati,
                    $longi,
                    $formatted_address
                );
                return $data_arr;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}