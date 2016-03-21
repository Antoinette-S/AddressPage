<?php
/**
 * Created by PhpStorm.
 * User: Paty-A
 * Date: 2/17/16
 * Time: 2:46 PM
 * Description: class to set html elements
 * that will be used in the corresponding
 * child classes to build an address form
 */

class HTML_elements{

    /**
     * Instructions: expects to receive
     * a class to build a div
     *
     * @param $divClass
     * @return string, div element
     */
    final public function openDiv($divClass){
        return "<div class='$divClass'>";
    }

    /**
     * @return string, close div tag
     */
    final public function closeDiv(){
        return "</div>";
    }

    /**
     * Instructions: expects to receive
     * values to build an form
     *
     * @param $formName
     * @param $formClass
     * @param $formAction
     * @param $formMethod
     * @return string, form element
     */
    final public function openForm($formName, $formClass, $formAction, $formMethod){
        return "<form name='$formName' id='$formName' class='$formClass' action='$formAction' method='$formMethod'>";
    }

    /**
     * @return string, close form tag
     */
    function closeForm(){
        return "</form>";
    }

    /**
     * Instructions: expects to receive
     * values to build label element
     *
     * @param $lblAttr
     * @param $label
     * @return string, label open &
     * close tag + label text
     */
    final public function getLabel($lblAttr, $label){
        return "<label for='$lblAttr'> $label </label>";
    }

    /**
     * Instructions: expects to receive values
     * to build input element
     *
     * @param $inputType
     * @param $inputName
     * @param $inputValue
     * @return string, input element
     */
    final public function getInput($inputType, $inputName, $inputValue){
        return "<input type='$inputType' name='$inputName' id='$inputName' size='40' value='$inputValue' />";
    }

    /**
     * Instructions: expects to receive values
     * to build a textarea element
     *
     * @param $textName
     * @param $textArea
     * @return string, open & close tag + text
     */
    final public function getTextArea($textName, $textArea){
        return "<textarea name='$textName' id='$textName'> $textArea </textarea>";
    }

    /**
     * Instructions: expects to receive values
     * to build select tag
     *
     * @param $selectName
     * @return string, open select tag
     */
     final public function openSelect($selectName){
        return "<select name='$selectName' id='$selectName'>";
    }

    /**
     * @return string, close select tag
     */
    final public function closeSelect(){
        return "</select>";
    }

    /**
     * Instructions: expects to receive values
     * to build options
     * Dependencies: must be wrapped in open &
     * close select tags
     *
     * @param $optionValue
     * @param $option
     * @return string, options open & close tags +
     * option text
     */
    final public function getOption($optionValue, $option){
        return "<option value=$optionValue> $option </option>";
    }

    /**
     * Instructions: expects to receive values
     * to build open tag for button
     *
     * @param $buttonClass
     * @param $buttonType
     * @param $buttonName
     * @param $buttonValue
     * @return string, open button tag
     */
    final public function openButton($buttonClass, $buttonType, $buttonName, $buttonValue){
        return "<button class='$buttonClass' type='$buttonType' name='$buttonName' value='$buttonValue'>";
    }

    /**
     * @return string, close button tag
     */
    final public function closeButton(){
        return "</button>";
    }
}
