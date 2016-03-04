<?php
/**
 * Created by PhpStorm.
 * User: Antoinette
 * Date: 2/11/16
 * Time: 3:13 PM
 */

class address_functions
{
    function reset_default($aArgs){
        global $db;
        if ($aArgs['default'] == '1') {
            $db->reset_default_delivery_address($_SESSION['js_user_id']);
        }
    }

    function update_address($aArgs){
        global $db;
        if ($db->update_delivery_address($_POST['edit_id'], $aArgs)) {
            $_SESSION['js_action'] = 'addupdate';
        } else {
            $_SESSION['js_action'] = 'addediterror';
        }
    }

    function add_address($aArgs){
        global $db;
        global $errorCheck;
        $aArgs['created_ts'] = date('Y-m-d H:i:s');
        $aArgs['user_id'] = $_SESSION['js_user_id'];
        if($_SESSION['js_action'] !== 'addexists') {
            if ($db->add_delivery_address($aArgs)) {
                $_SESSION['js_action'] = 'addsave';
            } else {
                $errorCheck->check_error($aArgs);
            }
        }
    }

    function match_address($aArgs){
        global $db;
        $aArgs['user_id'] = $_SESSION['js_user_id'];
        $address_match = $db->match_delivery_address(array(
            'user_id' => $aArgs['user_id'],
            'type' => $aArgs['type'],
            'lat' => $aArgs['lat'],
            'lng' => $aArgs['lng'],
            'address_1' => $aArgs['address_1'],
            'address_2' => $aArgs['address_2'],
            'address_3' => $aArgs['address_3']
        ));
        if ($address_match) {
            $_SESSION['js_action'] = 'addexists';
        }
    }
}
?>