<?php

require_once("addressform_display.php");
/**
 * Created by PhpStorm.
 * User: Paty-A
 * Date: 2/23/16
 * Time: 3:38 PM
 * Description: class that implements the interface methods and
 * sets the values of the forms entirety
 */
class addressForm_Implement extends addressForm_Display implements addressForm_Interface{

    /**
     * Instructions: expects id to set header
     * div class & pass to form body + type
     * Description: builds full address form,
     * includes header, form tag, body, & footer
     *
     * @param $id
     * @param $type
     */
    function addressDisplay($id, $type){
        $formDisplay = '';

        $formDisplay .= $this->buildAddress_Header($id);
        $formDisplay .= $this->buildAddress_Form();
        $formDisplay .= $this->buildAddress_FormBody($id, $type);
        $formDisplay .= $this->buildAddress_Footer();

        echo $formDisplay;
    }

    /**
     * Description: sets header as
     * div tag, uses the id as class
     * for javascript load
     *
     * @param $id
     * @return string
     */
    function buildAddress_Header($id){
        $header = HTML_elements::openDiv($id);

        return $header;
    }

    /**
     * @return string, form open element
     * with defined values
     */
    function buildAddress_Form(){
        $form = HTML_elements::openForm('add-edit-address-form', 'address-form add-form edit-form', '', 'POST');

        return $form;
    }

    /**
     * Description: calls parent method
     * to build form body
     *
     * @param $id
     * @param $type
     * @return string, form body
     */
    function buildAddress_FormBody($id, $type){
        $body = parent::buildAddress_FormBody($id, $type);

        return $body;
    }

    /**
     * @return string, closing form tags
     */
    function buildAddress_Footer(){
        $footer = HTML_elements::closeForm();
        $footer .= HTML_elements::closeDiv();

        return $footer;
    }
}

