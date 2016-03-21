<?php
require_once("addresspanel_build.php");

/**
 * Description: class to format specific elements in addresspanel_build
 * that need additional information
 *
 */

class addressPanel_Format extends addressPanel_Build{

    /**
     * Description: protected function to format
     * the array of states in the US and select
     * state (either from POST or DB)
     *
     * @param $array
     * @return string, type options element
     */
    protected function formatPanel_State($array){
        global $db;
        $states = null;
        $states = $db->get_states();
        if ($states && is_array($states)) {
            foreach ($states as $state) {
                $state_id = "".$state['id']."";
                $state_abb = $state['abbreviation'];
                if ((isset($_POST['add_state']) && $state['id'] == $_POST['add_state']) || (!isset($_POST['add_state']) && $state['id'] == $array['state_id'])) {
                    $state_id .= ' selected="selected"';
                }
                $option .= HTML_elements::getOption($state_id, $state_abb);
            }
        }
        return $option;
    }

    /**
     *
     * Description: protected function to format
     * phone number, if phone is empty the
     * default phone for user is substituted
     *
     * @param $divClass
     * @param $labelFor
     * @param $label
     * @param $inputType
     * @param $inputName
     * @param $num
     * @return string, div element containing
     * formatted phone number
     */
    protected function formatPanel_Phone($divClass, $labelFor, $label, $inputType, $inputName, $num){
        global $db;
        $phonePanel = '';

        if (empty($num)) {
            $user = $db->get_user_info_by_id($_SESSION['js_user_id']);
            $num = sprintf("(%s) %s-%s",
                substr($user['default_phone'], 0, 3),
                substr($user['default_phone'], 3, 3),
                substr($user['default_phone'], 6));
        } else{
            $num = preg_replace('/\D+/', '', ($num));
            $num = sprintf("(%s) %s-%s",
                substr($num, 0, 3),
                substr($num, 3, 3),
                substr($num, 6));
        }

        $phonePanel .= parent::buildGenericPanel($divClass, $labelFor, $label, $inputType, $inputName, $num);
        return $phonePanel;
    }

    /**
     * Description: protected function to format default
     * input from POST and/or address array
     *
     * @param $array
     * @return string, div element containing
     * checked or unchecked input
     */
    protected function formatPanel_Default($array){
        $defaultPanel = '';

        $default = 'default\'';
        if((isset($_POST['add_default']) && $_POST['add_default'] == 'default') || (!isset($_POST['add_default']) && $array['default'] == '1')){
            $checked = ' checked=\'checked\'';
        }
        else{
            $checked = '';
        }

        $defaultPanel .= parent::buildDefaultPanel($default, $checked);
        return $defaultPanel;
    }
}
