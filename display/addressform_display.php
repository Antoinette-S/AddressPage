<?php
/**
 * Created by PhpStorm.
 * User: mint
 * Date: 3/7/16
 * Time: 9:59 AM
 * Description: class to set the display of a form
 * extends addressform_body which sets
 * the address body panels
 */
require_once("addressform_body.php");

class addressForm_Display extends addressForm_Body{

    /**
     * Instructions: expects to receive an id
     * to pass to db which generates an array
     * to set form body, and the type that
     * is passed to form button
     *
     * @param $id
     * @param $type
     * @return string, the entirety of the form body
     */
    protected function buildAddress_FormBody($id, $type)
    {
        global $db;
        $add = $db->get_delivery_address_by_id($id);
        $body = parent::build_FormBody($add);
        $body .= $this->buildAddress_FormButton($type);

        return $body;
    }

    /**
     * Instructions: expects value to define
     * the type of button
     *
     * @param $type
     * @return string, div panel containing
     * element necessary to build button
     */
    protected function buildAddress_FormButton($type)
    {
        $buttonPanel = HTML_elements::openDiv('buttons ' . $type . '_button');
        $buttonPanel .= HTML_elements::openButton('save address', 'submit', 'action', $type . ' address');
        $buttonPanel .= $type;
        $buttonPanel .= HTML_elements::closeButton();
        $buttonPanel .= HTML_elements::closeDiv();

        return $buttonPanel;
    }
}