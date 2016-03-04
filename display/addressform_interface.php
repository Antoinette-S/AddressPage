<?php
/**
 * Created by PhpStorm.
 * User: Antoinette
 * Date: 2/23/16
 * Time: 3:33 PM
 */

interface addressForm_Interface{
    function buildAddress_Header($id);
    function buildAddress_Form();
    function buildAddress_FormBody($id);
    function buildAddress_FormButton($type);
    function buildAddress_Footer();
}

?>