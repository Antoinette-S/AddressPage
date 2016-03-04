<?php
/**
 * Created by PhpStorm.
 * User: Antoinette
 * Date: 2/23/16
 * Time: 1:44 PM
 */
class addressForm_Body{
    function build_FormBody($array){
        if (isset($array) && is_array($array)) {
            $formBody = self::get_FormBody($array);
        }
        else {
            $formBody = self::get_FormBody('');
        }
        return $formBody;
    }

    function get_FormBody($array){
        global $buildPanel;
        global $formatPanel;
        $addressBuild = get_class_methods($buildPanel);

        foreach ($addressBuild as $v) {
            if(self::get_FormBodyError($v, $array) == false) {
                switch ($v) {
                    case 'buildStatePanel':
                        $option = $formatPanel::formatPanel_State($array);
                        call_user_func(array($buildPanel, $v), $option);
                        continue 2;
                    case 'buildPhonePanel':
                        $formatPanel::formatPanel_Phone($array);
                        continue 2;
                    case 'buildDefaultPanel':
                        $formatPanel::formatPanel_Default($array);
                        continue 2;
                }
                call_user_func(array($buildPanel, $v), $array);
            }
        }
        unset($_SESSION['error']);
    }

    function get_FormBodyError($v, $array){
        global $buildPanel;
        global $HTML;
        global $formatPanel;

        $error = $_SESSION['error'];
        foreach ($error as $e => $str) {
            $key = substr($e, strpos($e, "_") + 1);
            if (strpos(strtolower($v), $key)) {
                if ($key !== 'state') {
                    $HTML::openDiv('error');
                    call_user_func(array($buildPanel, $v), $array);
                    $HTML::closeDiv();
                } elseif(strpos(strtolower($v), $key) && $key == 'state') {
                    $HTML::openDiv('error');
                    $option = $formatPanel::formatPanel_State($array);
                    call_user_func(array($buildPanel, $v), $option);
                    $HTML::closeDiv();

                }
                return true;
            }
        }
        return false;
    }
}
?>