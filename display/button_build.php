<?php
/**
 * Created by PhpStorm.
 * User: Antoinette
 * Date: 2/23/16
 * Time: 2:48 PM
 */
class button_Build{

    function build_AddressButton($type) {
        global $HTML;
        $buttonPanel = $HTML::openDiv('buttons '.$type.'_button');
        $buttonPanel .= $HTML::openButton('save address','submit', 'action', $type.' address');
        echo $type;
        $buttonPanel .= $HTML::closeButton();
        $buttonPanel .= $HTML::closeDiv();

        return $buttonPanel;
    }
}
?>