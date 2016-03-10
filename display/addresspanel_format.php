<?php
class addressPanel_Format extends addressPanel_Build{

    function formatPanel_State($array){
        global $db;
        global $HTML;
        $states = $db->get_states();
        if ($states && is_array($states)) {
            foreach ($states as $state) {
                $state_id = "".$state['id']."";
                $state_abb = $state['abbreviation'];
                if ((isset($_POST['add_state']) && $state['id'] == $_POST['add_state']) || (!isset($_POST['add_state']) && $state['id'] == $array['state_id'])) {
                    $state_id .= ' selected="selected"';
                }
                $option .= $HTML::getOption($state_id, $state_abb);
            }
        }
        return $option;
    }

    function formatPanel_Phone($array){
        global $db;
        $num = $array['phone'];

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
        parent::buildPhonePanel($num);
    }

    function formatPanel_Default($array){
        $default = 'default\'';
        if((isset($_POST['add_default']) && $_POST['add_default'] == 'default') || (!isset($_POST['add_default']) && $array['default'] == '1')){
            $checked = ' checked=\'checked\'';
        }
        else{
            $checked = '';
        }
        parent::buildDefaultPanel($default, $checked);
    }
}
?>