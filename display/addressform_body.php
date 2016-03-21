<?php
/**
 * Created by PhpStorm.
 * User: Paty-A
 * Date: 2/23/16
 * Time: 1:44 PM
 * Description: class to build form body
 * includes general form body
 * and error form body
 */
require_once("addresspanel_format.php");

class addressForm_Body extends addressPanel_Format{

    /**
     * Instructions: expects to receive
     * array of values
     * Description: checks if param is array
     * and builds the form. if empty builds empty form.
     * if POST action isset builds form using POST
     * array values
     *
     * @param $array
     * @return string, contains all the panels that
     * build form content
     */
    function build_FormBody($array){
        if (isset($array) && is_array($array) && !$_POST['action']) {
            $formBody = self::set_FormBody($array);
        }
        elseif(!$_POST['address']) {
            $formBody = self::set_FormBody('');
        }
        else {
            global $aArgs;
            $formBody = self::set_FormBody($aArgs);
        }

        return $formBody;
    }

    /**
     * Instructions: expects to receive array
     * of values to pass to form panels
     * Description: builds an array of panels
     * and sets them in an array to be used later
     *
     * @param $array
     * @param $error
     * @return array, form panels with defined values
     */
    private function get_FormBody($array, $error)
    {
        $option = parent::formatPanel_State($array);

        $panel = array(
        'name' => parent::buildGenericPanel('formfield' .$error, 'add_address_name\' class=\'required', 'Address Nickname', 'text', 'add_address_name', $array['address_name']),
        'comp' => parent::buildGenericPanel('formfield', 'add_company', 'Company', 'text', 'add_company', $array['company']),
        'address' => parent::buildGenericPanel('formfield left' .$error, 'add_address_1\' class=\'required', 'Address', 'text', 'add_address_1', $array['address_1']),
        'floor' => parent::buildGenericPanel('formfield med left' .$error, 'add_address_3\' class=\'required', 'Floor, Apt No.', 'text', 'add_address_3', $array['address_3']),
        'street' => parent::buildGenericPanel('formfield', 'add_address_2', 'Cross Street', 'text', 'add_address_2', $array['address_2']),
        'city' => parent::buildGenericPanel('formfield left'.$error, 'add_city\' class=\'required', 'City', 'text', 'add_city', $array['city']),
        'state' => parent::buildStatePanel($option, $error),
        'zip' => parent::buildGenericPanel('formfield short left'.$error, 'add_zip\' class=\'required', 'Zip Code', 'text', 'add_zip', $array['zip']),
        'phone' => parent::formatPanel_Phone('formfield left'.$error, 'add_phone\' class=\'required', 'Phone Number', 'text', 'add_phone', $array['phone']),
        'ext' => parent::buildGenericPanel('formfield short left', 'add_ext', 'Extension', 'text', 'add_ext', $array['ext']),
        'cmmt' => parent::buildCommentPanel($array),
        'default' => parent::formatPanel_Default($array)
        );

        return $panel;
    }

    /**
     * Instructions: expects to be passed
     * array to use to build form panels
     * Description: gets array of panels from
     * get_FormBody, checks if errors were set
     * for each & takes the error key to check
     * for match with panel array, if true
     * sets error class to matched panel.
     * Calls panels to build using panel array key
     *
     * @param $array
     * @return string, form panels with/without
     * error div
     */
    private function set_FormBody($array)
    {
        $errorDiv = null;
        $panel = '';
        $panelArray = self::get_FormBody($array, $errorDiv);
        foreach($panelArray as $k => $v) {
            $error = $_SESSION['error'];
            foreach ($error as $e => $str) {
                $key = substr($e, strpos($e, "_") + 1);
                if (strpos($k, $key) !== false) {
                    $errorDiv = ' error';
                }
            }
            $panel .= self::get_FormBody($array, $errorDiv)[$k];
            unset($errorDiv);
            continue;
        }
        unset($_SESSION['error']);
        return $panel;
    }
}
