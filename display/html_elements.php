<?php
/**
 * Created by PhpStorm.
 * User: Antoinette
 * Date: 2/17/16
 * Time: 2:46 PM
 */

class HTML_elements{

    function openDiv($divClass){
        echo "<div class='$divClass'>";
    }
    function closeDiv(){
        echo "</div>";
    }

    function openForm($formName, $formClass, $formAction, $formMethod){
        echo "<form name='$formName' id='$formName' class='$formClass' action='$formAction' method='$formMethod'>";
    }
    function closeForm(){
        echo "</form>";
    }

    function getLabel($lblAttr, $label){
        echo "<label for='$lblAttr'> $label </label>";
    }

    function getInput($inputType, $inputName, $inputValue){
        echo "<input type='$inputType' name='$inputName' id='$inputName' size='40' value='$inputValue' />";
    }

    function getTextArea($textName, $textArea){
        echo "<textarea name='$textName' id='$textName'> $textArea </textarea>";
    }

    function openSelect($selectName){
        echo "<select name='$selectName' id='$selectName'>";
    }
    function closeSelect(){
        echo "</select>";
    }

    function getOption($optionValue, $option){
        return "<option value=$optionValue> $option </option>";
    }

    function openButton($buttonClass, $buttonType, $buttonName, $buttonValue){
        echo "<button class='$buttonClass' type='$buttonType' name='$buttonName' value='$buttonValue'>";
    }

    function closeButton(){
        echo "</button>";
    }
}
?>