<?php
/**
 * Created by PhpStorm.
 * User: mint
 * Date: 3/7/16
 * Time: 9:59 AM
 */
class addressForm_Display extends addressForm_Implement{

    function addressDisplay($id, $type){
        $this->buildAddress_Header($id);
        $this->buildAddress_Form();
        $this->buildAddress_FormBody($id);
        $this->buildAddress_FormButton($type);
        $this->buildAddress_Footer();
}


    protected function buildAddress_FormButton($type){
        global $buttonBuild;
        $formButton = $buttonBuild->build_AddressButton($type);

        return $formButton;
    }
}