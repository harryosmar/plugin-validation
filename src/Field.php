<?php

namespace PluginSimpleValidate;

use PluginSimpleValidate\helper\Validate;
use PluginSimpleValidate\Libraries\Language;

class Field
{
    private $field, $value, $label, $error, $lang;

    private $rules = [];

    private $numeric_rules = ['is_number', 'is_integer', 'is_decimal'];

    public function __construct($field, $value, $label = null, $lang = 'en'){
        $this->field = $field;
        $this->value = $value;
        $this->label = $label === null ? $this->field : $label;
        $this->lang = $lang;
    }


    private function hasNumericRules(){
        foreach($this->rules as $rule_name => $rule){
            if(in_array($rule_name, $this->numeric_rules)){
                return true;
            }
        }

        return false;
    }

    private function getFieldErrorMessage($lang_key, $args){
        return vsprintf(Language::getInstance()->getMessage($lang_key, $this->lang), $args);
    }

    public function setLanguage($lang){
        $this->lang = $lang;
        return $this;
    }

    public function getLanguage(){
        return $this->lang;
    }

    public function setField($field){
        $this->field = $field;
        return $this;
    }

    public function getField(){
        return $this->field;
    }

    public function setValue($value){
        $this->value = $value;
        return $this;
    }

    public function getValue(){
        return $this->value;
    }

    public function setLabel($label){
        $this->label = $label;
        return $this;
    }

    public function getLabel(){
        return $this->label;
    }

    public function getErrorMessage(){
        return $this->error;
    }


    public function isValid(){
        return !$this->error ? true : false;
    }

    public function runValidation(){
        foreach($this->rules as $rule_name => $rule){
            if(!empty($this->error)){
                return false;
            }

            if(!call_user_func_array('\\PluginSimpleValidate\\helper\\Validate\\' . $rule_name, $rule['parameters'])){
                $this->error = $rule['override_message'] !== null ? $rule['override_message'] : $this->getFieldErrorMessage($rule['lang_key'], $rule['default_message_args']);
                return false;
            }

        }

        return true;
    }

    public function is_true($message){
        $this->rules['is_true'] = [
            'override_message' => $message,
            'parameters' => [$this->value],
            'lang_key' => null
        ];

        return $this;
    }

    public function is_required($message = null)
    {
        $this->rules['is_required'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label],
            'parameters' => [$this->value],
            'lang_key' => 'required'
        ];

        return $this;
    }

    public function is_numeric($message = null){
        $this->rules['is_number'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label],
            'parameters' => [$this->value],
            'lang_key' => 'numeric'
        ];

        return $this;
    }

    public function is_valid_email($message = null){
        $this->rules['is_valid_email'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label],
            'parameters' => [$this->value],
            'lang_key' => 'email'
        ];

        return $this;
    }

    public function is_alpha($message = null)
    {
        $this->rules['is_alpha'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label],
            'parameters' => [$this->value],
            'lang_key' => 'alpha'
        ];

        return $this;
    }

    public function is_alpha_numeric($message = null)
    {
        $this->rules['is_alpha_numeric'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label],
            'parameters' => [$this->value],
            'lang_key' => 'alpha_numeric'
        ];

        return $this;
    }

    public function is_decimal($message = null)
    {
        $this->rules['is_decimal'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label],
            'parameters' => [$this->value],
            'lang_key' => 'decimal'
        ];

        return $this;
    }

    public function is_integer($message = null)
    {
        $this->rules['is_integer'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label],
            'parameters' => [$this->value],
            'lang_key' => 'integer'
        ];

        return $this;
    }

    public function is_natural($message = null)
    {
        $this->rules['is_natural'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label],
            'parameters' => [$this->value],
            'lang_key' => 'natural'
        ];

        return $this;
    }

    public function is_natural_no_zero($message = null)
    {
        $this->rules['is_natural_no_zero'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label],
            'parameters' => [$this->value],
            'lang_key' => 'natural_no_zero'
        ];

        return $this;
    }

    public function min($min, $message = null)
    {
        $hasNumericRules = $this->hasNumericRules();
        $this->rules['min_length'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label, $min],
            'parameters' => [$this->value, $min, $hasNumericRules],
            'lang_key' => 'min:' . Validate\get_type($this->value, $hasNumericRules)
        ];

        return $this;
    }

    public function max($max, $message = null)
    {
        $hasNumericRules = $this->hasNumericRules();
        $this->rules['max_length'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label, $max],
            'parameters' => [$this->value, $max, $hasNumericRules],
            'lang_key' => 'max:' . Validate\get_type($this->value, $hasNumericRules)
        ];

        return $this;
    }

    public function exact_length($length, $message = null)
    {
        $hasNumericRules = $this->hasNumericRules();
        $this->rules['exact_length'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label, $length],
            'parameters' => [$this->value, $length, $hasNumericRules],
            'lang_key' => 'exact:' . Validate\get_type($this->value, $hasNumericRules)
        ];

        return $this;
    }

    public function equal($expected, $message = null)
    {
        $this->rules['equal'] = [
            'override_message' => $message,
            'default_message_args' => [$this->label, $expected],
            'parameters' => [$expected, $this->value],
            'lang_key' => 'equal'
        ];

        return $this;
    }
}