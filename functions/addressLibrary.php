<?php
/**
 * Created by PhpStorm.
 * User: Antoinette
 * Date: 3/3/16
 * Time: 5:37 PM
 */

include_once("../../settings.php");
include_once("../frontend_functions.php");
include_once("../login_functions.php");
include_once("../geocode_functions.php");
include("../session.php");
include("check_address.php");
include("address_functions.php");
?>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.address-page.js"></script>
<?php
spl_autoload_register(function ($class_name) {
    $file = strtolower($class_name);
    include_once '../display/' . $file . '.php';
});

$addressForm = new addressForm_Implement();
$formBody = new addressForm_Body();
$buildPanel = new addressPanel_Build();
$formatPanel = new addressPanel_Format();
$buttonBuild = new button_Build();
$HTML = new HTML_elements();
$errorCheck = new check_address();
$addressFunctions = new address_functions();

?>