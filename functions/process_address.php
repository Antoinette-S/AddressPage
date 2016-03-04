<?php
include("addressLibrary.php");
global $confirm;

if ($_POST['action'] == 'save address') {
    $a = $_POST['address'];
    parse_str($a);

    $phone = preg_replace('/\D+/', '', ($add_phone));
    $aArgs = array(
        'phone' => $phone,
        'ext' => $add_ext,
        'company' => $add_company,
        'address_name' => $add_address_name,
        'address_1' => $add_address_1,
        'address_2' => $add_address_2,
        'address_3' => $add_address_3,
        'city' => $add_city,
        'state_id' => $add_state,
        'zip' => $add_zip,
        'comments' => $add_comments,
        'type' => 'D',
        'default' => $add_default ? '1' : '0',
    );

    foreach ($aArgs as $key => $value) {
        $value = $confirm->remove_slashes($value);
        $value = $confirm->strip_tags_content($value);
        $aArgs[$key] = $value;
    }

    $aArgs = $errorCheck->address_validation($aArgs);
    $coordinates = $confirm->geocode($aArgs);

    $aArgs['lat'] = $coordinates['0'];
    $aArgs['lng'] = $coordinates['1'];

    $error = $errorCheck->check_error($aArgs);


    if (!$error) {
        $addressFunctions->reset_default($aArgs);
        if ($_POST['edit_id'] && is_numeric($_POST['edit_id'])) {
            $addressFunctions->update_address($aArgs);
        } else {
            $addressFunctions->match_address($aArgs);
            $addressFunctions->add_address($aArgs);
        }
    }
}

$addressForm->addressForm($id = $_POST['edit_id'], $type='save');

?>
