<?php
/**
 * Created by PhpStorm.
 * User: Paty-A
 * Date: 3/3/16
 * Time: 5:37 PM
 */

include_once("../../settings.php");
include_once("../frontend_functions.php");
include_once("../login_functions.php");
include_once("../geocode_functions.php");
include("../session.php");

require_once("addressValidation.php");
require_once("check_address.php");
require_once("address_functions.php");

require_once("../display/addressform_interface.php");
require_once("../display/addressform_implement.php");
require_once("../display/addressform_display.php");

require_once("../display/addressform_body.php");

require_once("../display/addresspanel_build.php");
require_once("../display/addresspanel_format.php");

require_once("../display/button_build.php");
require_once("../display/html_elements.php");

?>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="../include/functions/js/jquery.address-page.js"></script>
<?php

$addressForm = new addressForm_Implement();
$addressDisplay = new addressForm_Display();
$formBody = new addressForm_Body();
$buildPanel = new addressPanel_Build();
$formatPanel = new addressPanel_Format();
$buttonBuild = new button_Build();
$HTML = new HTML_elements();
$errorCheck = new check_address();
$addressFunctions = new address_functions();
$confirm = new confirm();

?>