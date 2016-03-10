<?php
/**
 * Created by PhpStorm.
 * User: Paty-A
 * Date: 2/17/16
 * Time: 3:59 PM
 */

class addressPanel_Build{

    function buildNamePanel($array){
        global $HTML;
        $namePanel = $HTML::openDiv('formfield');
        $namePanel .= $HTML::getLabel('add_address_name\' class=\'required','Address Nickname');
        $namePanel .= $HTML::getInput('text', 'add_address_name', $array['address_name']);
        $namePanel .= $HTML::closeDiv();

        return $namePanel;
    }

    function buildCompanyPanel($array){
        global $HTML;
        $compPanel = $HTML::openDiv('formfield');
        $compPanel .= $HTML::getLabel('add_company', 'Company');
        $compPanel .= $HTML::getInput('text', 'add_company', $array['company']);
        $compPanel .= $HTML::closeDiv();

        return $compPanel;
    }

    function buildAddressPanel($array){
        global $HTML;
        $addressPanel = $HTML::openDiv('formfield left');
        $addressPanel .= $HTML::getLabel('add_address_1\' class=\'required', 'Address');
        $addressPanel .= $HTML::getInput('text', 'add_address_1', $array['address_1']);
        $addressPanel .= $HTML::closeDiv();

        return $addressPanel;
    }

    function buildFloorPanel($array){
        global $HTML;
        $floorPanel = $HTML::openDiv('formfield med left');
        $floorPanel .= $HTML::getLabel('add_address_3\' class=\'required', 'Floor, Apt No.');
        $floorPanel .= $HTML::getInput('text', 'add_address_3', $array['address_3']);
        $floorPanel .= $HTML::closeDiv();

        return $floorPanel;
    }

    function buildStreetPanel($array){
        global $HTML;
        $streetPanel = $HTML::openDiv('formfield');
        $streetPanel .= $HTML::getLabel('add_address_2', 'Cross Street');
        $streetPanel .= $HTML::getInput('text', 'add_address_2', $array['address_2']);
        $streetPanel .= $HTML::closeDiv();

        return $streetPanel;
    }

    function buildCityPanel($array){
        global $HTML;
        $cityPanel = $HTML::openDiv('formfield left');
        $cityPanel .= $HTML::getLabel('add_city\' class=\'required', 'City');
        $cityPanel .= $HTML::getInput('text', 'add_city', $array['city']);
        $cityPanel .= $HTML::closeDiv();

        return $cityPanel;
    }

    function buildStatePanel($state){
        global $HTML;
        $statePanel = $HTML::openDiv('formfield short left');
        $statePanel .= $HTML::getLabel('add_state\' class=\'required', 'State');
        $statePanel .= $HTML::openDiv('select-holder');
        $statePanel .= $HTML::openSelect('add_state');
        echo $state;
        $statePanel .= $HTML::closeSelect();
        $statePanel .= $HTML::closeDiv();
        $statePanel .= $HTML::closeDiv();

        return $statePanel;
    }

    function buildZipPanel($array){
        global $HTML;
        $zipPanel = $HTML::openDiv('formfield short left');
        $zipPanel .= $HTML::getLabel('add_zip\' class=\'required', 'Zip Code');
        $zipPanel .= $HTML::getInput('text', 'add_zip', $array['zip']);
        $zipPanel .= $HTML::closeDiv();

        return $zipPanel;
    }

    function buildPhonePanel($num){
        global $HTML;
        $phonePanel = $HTML::openDiv('formfield left');
        $phonePanel .= $HTML::getLabel('add_phone\' class=\'required', 'Phone Number');
        $phonePanel .= $HTML::getInput('text', 'add_phone', $num);
        $phonePanel .= $HTML::closeDiv();

        return $phonePanel;
    }

    function buildExtensionPanel($array){
        global $HTML;
        $extPanel = $HTML::openDiv('formfield short left');
        $extPanel .= $HTML::getLabel('add_ext', 'Extension');
        $extPanel .= $HTML::getInput('text', 'add_ext', $array['ext']);
        $extPanel .= $HTML::closeDiv();

        return $extPanel;
    }

    function buildCommentPanel($array){
        global $HTML;
        $commentPanel = $HTML::openDiv('formfield textarea');
        $commentPanel .= $HTML::getLabel('add_comments', 'Delivery Instructions');
        $commentPanel .= $HTML::getTextArea('add_comments', $array['comments']);
        $commentPanel .= $HTML::closeDiv();
        echo "<br>";

        return $commentPanel;
    }

    function buildDefaultPanel($default, $checked){
        global $HTML;
        $defaultPanel = $HTML::openDiv('formfield');
        $defaultPanel .= $HTML::getInput('checkbox', 'add_default', $default.$checked);
        $defaultPanel .= $HTML::getLabel('add_default\' class=\'checkbox', 'Make this my default address');
        $defaultPanel .= $HTML::closeDiv();
        echo "<hr><br>";

        return $defaultPanel;
    }
}
?>