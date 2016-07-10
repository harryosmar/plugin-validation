<?php

namespace PluginSimpleValidate;

use PluginSimpleValidate\helper\Validate;
use PluginSimpleValidate\Libraries\Language;

class Field
{
    private $field, $value, $label, $error, $lang;


    private $rules = [];

    private $numeric_rules = ['numeric', 'integer', 'decimal'];

    public function __construct($field, $value, $label = null, $lang = 'en'){
        $this->field = $field;
        $this->value = $value;
        $this->label = $label === null ? $this->field : $label;
        $this->lang = $lang;
    }

    public function setLanguage($lang){
        $this->lang = $lang;
        return $this;
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

    public function is_true($condition, $message){
        $this->rules[] = 'is_true';

        if( !$condition ){
            $this->error = $message;
        }

        return $this;
    }

    public function is_required($message = null)
    {
        $this->rules[] = 'is_required';

        if(!empty($this->error)){
            return $this;
        }

        $value = preg_replace('/^\s+|\s+$/', '', $this->value);

        if( Validate\is_empty($value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('required', $this->lang), $this->label);
        }

        return $this;
    }

    public function is_matches($str, $message = null){
        $this->rules[] = 'is_matches';

        if(!empty($this->error)){
            return $this;
        }

        if($str !== $this->value){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('matches', $this->lang), $this->label, $str);
        }

        return $this;
    }

    public function is_numeric($message = null){
        $this->rules[] = 'is_numeric';

        if(!empty($this->error)){
            return $this;
        }

        if( ! is_numeric($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('numeric', $this->lang), $this->label);
        }

        return $this;
    }

    public function is_valid_email($message = null){
        $this->rules[] = 'is_valid_email';

        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_valid_email($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('email', $this->lang), $this->label);
        }

        return $this;
    }

    public function is_alpha($message = null)
    {
        $this->rules[] = 'is_alpha';

        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_alpha($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('alpha', $this->lang), $this->label);
        }

        return $this;
    }

    public function is_alpha_numeric($message = null)
    {
        $this->rules[] = 'is_alpha_numeric';

        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_alpha_numeric($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('alpha_numeric', $this->lang), $this->label);
        }

        return $this;
    }

    public function is_decimal($message = null)
    {
        $this->rules[] = 'is_decimal';

        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_decimal($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('decimal', $this->lang), $this->label);
        }

        return $this;
    }

    public function is_integer($message = null)
    {
        $this->rules[] = 'is_integer';

        if(!empty($this->error)){
            return $this;
        }

        if( ! is_integer($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('integer', $this->lang), $this->label);
        }

        return $this;
    }

    public function is_natural($message = null)
    {
        $this->rules[] = 'is_natural';

        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_natural($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('natural', $this->lang), $this->label);
        }

        return $this;
    }

    public function is_natural_no_zero($message = null)
    {
        $this->rules[] = 'is_natural_no_zero';

        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_natural_no_zero($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('natural_no_zero', $this->lang), $this->label);
        }

        return $this;
    }

    private function hasNumericRules(){
        foreach($this->rules as $rule){
            if(in_array($rule, $this->numeric_rules)){
                return true;
            }
        }

        return false;
    }

    public function min($min, $message = null)
    {
        $this->rules[] = 'min';

        if(!empty($this->error)){
            return $this;
        }

        if(!Validate\min_length($this->value, $min, $this->hasNumericRules())){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('min', $this->lang), $this->label, $min);
        }

        return $this;
    }

    public function max($max, $message = null)
    {
        $this->rules[] = 'max';

        if(!empty($this->error)){
            return $this;
        }

        if(!Validate\max_length($this->value, $max, $this->hasNumericRules())){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('max', $this->lang), $this->label, $max);
        }

        return $this;
    }

    public function exact($length, $message = null)
    {
        $this->rules[] = 'exact';

        if(!empty($this->error)){
            return $this;
        }

        if(!Validate\exact_length($this->value, $length, $this->hasNumericRules())){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('exact', $this->lang), $this->label, $length);
        }

        return $this;
    }

    public function equal($expected, $message = null)
    {
        $this->rules[] = 'equal';

        if(!empty($this->error)){
            return $this;
        }

        if(!Validate\equal($expected, $this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('equal', $this->lang), $this->label, $expected);
        }

        return $this;
    }
}