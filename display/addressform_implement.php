<?php
/**
 * Created by PhpStorm.
 * User: Antoinette
 * Date: 2/23/16
 * Time: 3:38 PM
 */
class addressForm_Implement implements addressForm_Interface{

    function addressForm($id, $type){
        foreach(get_class_methods($this) as $key => $value){
            if($key !== 0) {
                switch ($value) {
                    case 'buildAddress_Header':
                        call_user_func(array($this, $value), $id);
                        continue 2;
                    case 'buildAddress_FormBody':
                        call_user_func(array($this, $value), $id);
                        continue 2;
                    case 'buildAddress_FormButton':
                        call_user_func(array($this, $value), $type);
                        continue 2;
                }
                call_user_func(array($this, $value));
            }
        }
    }

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

    function buildAddress_FormButton($type){
        global $buttonBuild;
        $formButton = $buttonBuild->build_AddressButton($type);

        return $formButton;
    }

    function buildAddress_Footer(){
        global $HTML;
        $footer = $HTML::closeForm();
        $footer .= $HTML::closeDiv();

        return $footer;
    }
}

?>