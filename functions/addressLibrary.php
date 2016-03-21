<?php
/**
 * Created by PhpStorm.
 * User: Paty-A
 * Date: 3/3/16
 * Time: 5:37 PM
 * Includes: necessary files and classes
 * for process_address.php
 *
 */

include_once("../../settings.php");
include_once("../frontend_functions.php");
include_once("../login_functions.php");
include_once("../geocode_functions.php");
include("../session.php");

include_once("addressValidation.php");
include_once("check_address.php");
include_once("address_functions.php");

include_once("../display/addressform_interface.php");
include_once("../display/addressform_implement.php");


?>
    <script>$.ajaxPrefilter(function( options, originalOptions, jqXHR ) { options.async = true; });</script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="../include/functions/js/jquery.address-page.js"></script>
<?php

$addressForm = new addressForm_Implement();
$errorCheck = new check_address();
$addressFunctions = new address_functions();
$confirm = new confirm();

?>