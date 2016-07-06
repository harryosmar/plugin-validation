<?php

namespace PluginSimpleValidate;

use PluginSimpleValidate\helper\Validate;
use PluginSimpleValidate\Libraries\Config;
use PluginSimpleValidate\Libraries\Language;

class Field
{
    protected $label, $value, $error, $lang;

    public function __construct($label, $value, $lang = 'en'){
        $this->label = $label;
        $this->value = $value;
        $this->lang = $lang;
    }

    public function setLanguage($lang){
        $this->lang = $lang;
        return $this;
    }

    public function setLabel($label){
        $this->label = $label;
        return $this;
    }

    public function getLabel(){
        return $this->label;
    }

    public function setValue($value){
        $this->value = $value;
        return $this;
    }

    public function getValue(){
        return $this->value;
    }

    public function getErrorMessage(){
        return $this->error;
    }

    public function isValid(){
        return !$this->error ? true : false;
    }

    public function is_true($condition, $message){
        if( !$condition ){
            $this->error = $message;
        }

        return $this;
    }

    public function is_required($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        $value = preg_replace('/^\s+|\s+$/', '', $this->value);

        if( Validate\is_empty($value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('required'), $this->label);
        }

        return $this;
    }

    public function is_matches($str, $message = null){
        if(!empty($this->error)){
            return $this;
        }

        if($str !== $this->value){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('matches'), $this->label, $str);
        }

        return $this;
    }

    public function is_numeric($message = null){
        if(!empty($this->error)){
            return $this;
        }

        if( ! is_numeric($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('numeric'), $this->label);
        }

        return $this;
    }

    public function is_valid_email($message = null){
        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_valid_email($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('email'), $this->label);
        }

        return $this;
    }

    public function is_alpha($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_alpha($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('alpha'), $this->label);
        }

        return $this;
    }

    public function is_alpha_numeric($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_alpha_numeric($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('alpha_numeric'), $this->label);
        }

        return $this;
    }

    public function is_decimal($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_decimal($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('decimal'), $this->label);
        }

        return $this;
    }

    public function is_integer($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if( ! is_integer($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('integer'), $this->label);
        }

        return $this;
    }

    public function is_natural($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_natural($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('natural'), $this->label);
        }

        return $this;
    }

    public function is_natural_no_zero($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_natural_no_zero($this->value)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('natural_no_zero'), $this->label);
        }

        return $this;
    }

    public function greater_than($min, $message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if ( ! is_numeric($this->value))
        {
            $this->error = sprintf(Language::getInstance()->getMessage('numeric'), $this->label);
        }

        if($this->value <= $min){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('greater_than'), $this->label, $min);
        }

        return $this;
    }

    public function equal_or_greater_than($min, $message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if ( ! is_numeric($this->value))
        {
            $this->error = sprintf(Language::getInstance()->getMessage('numeric'), $this->label);
        }

        if($this->value < $min){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('equal_or_greater_than'), $this->label, $min);
        }

        return $this;
    }

    public function less_than($max, $message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if ( ! is_numeric($this->value))
        {
            $this->error = sprintf(Language::getInstance()->getMessage('numeric'), $this->label);
        }

        if($this->value >= $max){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('less_than'), $this->label, $max);
        }

        return $this;
    }

    public function equal_or_less_than($max, $message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if ( ! is_numeric($this->value))
        {
            $this->error = sprintf(Language::getInstance()->getMessage('numeric'), $this->label);
        }

        if($this->value > $max){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('equal_or_less_than'), $this->label, $max);
        }

        return $this;
    }

    public function min($min, $message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if(!Validate\min_length($this->value, $min)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('min'), $this->label, $min);
        }

        return $this;
    }

    public function max($max, $message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if(!Validate\max_length($this->value, $max)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('max'), $this->label, $max);
        }

        return $this;
    }

    public function exact($length, $message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if(!Validate\exact_length($this->value, $length)){
            $this->error = $message ? $message : sprintf(Language::getInstance()->getMessage('exact'), $this->label, $length);
        }

        return $this;
    }
}