<?php

class check_address{

    function check_error($check_address){
        echo '';
        $error = $this->requirement_error($check_address);
        $error = $this->general_error($check_address);

        if (isset($_SESSION['error']) && is_array($_SESSION['error']) && $_SESSION['order']['delivery']['address'] != 'pickup') {
            echo "<div class='addressInfo' id='error' style='margin-left: 10px;'><strong>Please use the form below to correct the following errors:</strong><ul><li>" . implode('</li><li>', $error) . "</li></ul></div>";
        }
        unset($_POST['action']);
        return $error;
    }

    function requirement_error($address){
        if (trim($address['address_name']) == "") {
            $_SESSION['error']['no_name'] = "You must provide an address name.";
        }

        if (trim($address['address_1']) == "") {
            $_SESSION['error']['no_address'] = "You must provide your address.";
        }

        if (trim($address['address_3']) == "") {
            $_SESSION['error']['no_floor'] = "You must provide a floor or apartment. (N/A if not applicable)";
        }

        if (trim($address['city']) == "") {
            $_SESSION['error']['no_city'] = "You must provide your city.";
        }

        if (!$this->state_error($address)) {
            $_SESSION['error']['no_state'] = "You must select a valid state.";
        }
        if (!$address['phone']&& trim($address['phone']) == "") {
            $_SESSION['error']['no_phone'] = "You must provide a valid phone number.";
        }

        if (trim($address['zip']) == "" || !is_numeric($address['zip'])) {
            $_SESSION['error']['no_zip'] = "You must provide a numeric zip code.";
        }

        $e = $_SESSION['error'];
        return $e;
    }

    function general_error($address){
        global $confirm;
        $assigned_store = $confirm->assign_store($address['lat'], $address['lng']);

        if($assigned_store === false || count($assigned_store) !== 1){
            $_SESSION['error']['general'] = 'I\'m sorry, there was a problem finding a store near you. Please try again.';
        }

        $e = $_SESSION['error'];
        return $e;
    }

    function address_validation($address) {
        global $db;
        unset($_SESSION['error']);

        (empty($address['phone']) && isset($address['default_phone']) ? $address['phone'] = $address['default_phone'] : '');
        (strlen($address['phone']) < 7 || strlen($address['phone']) > 11 ? $_SESSION['error']['no_phone'] = true : '');
        (trim($address['address_name']) == "" ? $_SESSION['error']['no_name'] = true : '');
        (trim($address['address_1']) == "" ? $_SESSION['error']['no_address'] = true : '');
        (isset($address['address_3']) ?: $_SESSION['error']['no_floor'] = true);
        ((trim($address['address_3']) == "") ? $_SESSION['error']['no_floor'] = true : '');
        (trim($address['city']) == "" ? $_SESSION['error']['no_city'] = true : '');
        (trim($address['zip']) == "" ? $_SESSION['error']['no_zip'] = true: '');

        if (empty($_SESSION['error']['no_phone'])) {
            $phone = sprintf("(%s) %s-%s", substr($address['phone'], 0, 3), substr($address['phone'], 3, 3), substr($address['phone'], 6));

            $address['phone'] = $phone;
            $address['ext'] = ($address['ext'] ? "x" . $address['ext'] : "");
        }

        $state_abbr = $db->get_state_abbreviation_by_id($address['state_id']);
        $address['abbreviation']= $state_abbr;

        return $address;
    }

    function state_error($address){
        /**
         * original function: $confirm->geocode($address)
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
            // get state data
            $state = $resp['results'][0]['address_components'][6]['short_name'];

            if($state == $core_address[2]){
                return true;
            }
            else{
                return false;
            }
        } else {
            return false;
        }

    }
}
?>