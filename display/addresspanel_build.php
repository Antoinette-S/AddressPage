<?php
/**
 * Created by PhpStorm.
 * User: Paty-A
 * Date: 2/17/16
 * Time: 3:59 PM
 * Description: class to build panels that will be placed in address form
 * extends base class html_elements comprised of all
 * elements needed to build a generic form
 *
 */
require_once("html_elements.php");

class addressPanel_Build extends HTML_elements{

    /**
     * Description: function to build a generic panel
     * of predefined values
     *
     * @param $divClass
     * @param $labelFor
     * @param $label
     * @param $inputType
     * @param $inputName
     * @param $inputValue
     * @return string, div element containing
     * predefined label & input element
     */
    function buildGenericPanel($divClass, $labelFor, $label, $inputType, $inputName, $inputValue)
    {
        $genPanel = '';

        $genPanel .= parent::openDiv($divClass);
        $genPanel .= parent::getLabel($labelFor, $label);
        $genPanel .= parent::getInput($inputType, $inputName, $inputValue);
        $genPanel .= parent::closeDiv();

        return $genPanel;
    }

    /**
     * Description: function to build a div panel,
     * will contain another div to hold the selector
     * element and options element that is defined
     * in addresspanel_format
     *
     * @param $state
     * @param $error
     * @return string, div element containing
     * necessary elements to build a select panel
     */

    function buildStatePanel($state, $error)
    {
        $statePanel = '';

        $statePanel .= parent::openDiv('formfield short left'.$error);
        $statePanel .= parent::getLabel('add_state\' class=\'required', 'State');
        $statePanel .= parent::openDiv('select-holder');
        $statePanel .= parent::openSelect('add_state');
        $statePanel .= $state;
        $statePanel .= parent::closeSelect();
        $statePanel .= parent::closeDiv();
        $statePanel .= parent::closeDiv();

        return $statePanel;
    }

    /**
     * Description: function to build a div panel
     * containing necessary elements for a textarea
     *
     * @param $array
     * @return string, div panel containing predefined
     * values for label & textarea + new line break
     */
    function buildCommentPanel($array)
    {
        $commentPanel = '';

        $commentPanel .= parent::openDiv('formfield textarea');
        $commentPanel .= parent::getLabel('add_comments', 'Delivery Instructions');
        $commentPanel .= parent::getTextArea('add_comments', $array['comments']);
        $commentPanel .= parent::closeDiv();
        $commentPanel .= "<br>";

        return $commentPanel;
    }

    /**
     * Description: function to build div panel
     * containing necessary elements to build
     * a checkbox
     *
     * @param $default
     * @param $checked
     * @return string, div element containing
     * input & label + thematic break (horizontal line)
     * & new line break
     */
    function buildDefaultPanel($default, $checked)
    {
        $defaultPanel = '';

        $defaultPanel .= parent::openDiv('formfield');
        $defaultPanel .= parent::getInput('checkbox', 'add_default', $default.$checked);
        $defaultPanel .= parent::getLabel('add_default\' class=\'checkbox', 'Make this my default address');
        $defaultPanel .= parent::closeDiv();
        $defaultPanel .= "<hr><br>";

        return $defaultPanel;
    }
}
