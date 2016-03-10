<?php
/**
 * Created by PhpStorm.
 * User: Paty-A
 * Date: 2/23/16
 * Time: 3:38 PM
 */
class addressForm_Implement implements addressForm_Interface{

    function buildAddress_Header($id){
        global $HTML;
        $header = $HTML::openDiv($id);

        return $header;
    }

    function buildAddress_Form(){
        global $HTML;
        $form = $HTML::openForm('add-edit-address-form', 'address-form add-form edit-form', '', 'POST');

        return $form;
    }

    function buildAddress_FormBody($id){
        global $formBody;
        global $db;
        $add = $db->get_delivery_address_by_id($id);
        $body = $formBody::build_FormBody($add);

        return $body;
    }

    function buildAddress_Footer(){
        global $HTML;
        $footer = $HTML::closeForm();
        $footer .= $HTML::closeDiv();

        return $footer;
    }
}

?>