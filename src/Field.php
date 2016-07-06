<?php

namespace PluginSimpleValidate;

use PluginSimpleValidate\helper\Validate;

class Field
{
    protected $label, $value, $error;

    public function __construct($label, $value){
        $this->label = $label;
        $this->value = $value;
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
            $this->error = $message ? $message : sprintf("The %s field is required", $this->label);
        }

        return $this;
    }

    public function is_matches($str, $message = null){
        if(!empty($this->error)){
            return $this;
        }

        if($str !== $this->value){
            $this->error = $message ? $message : sprintf("The %s field is not matches with '%s'", $this->label, $str);
        }

        return $this;
    }

    public function is_numeric($message = null){
        if(!empty($this->error)){
            return $this;
        }

        if( ! is_numeric($this->value)){
            $this->error = $message ? $message : sprintf("The %s field must contain only numbers", $this->label);
        }

        return $this;
    }

    public function is_valid_email($message = null){
        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_valid_email($this->value)){
            $this->error = $message ? $message : sprintf("The %s field must contain a valid email address", $this->label);
        }

        return $this;
    }

    public function is_alpha($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_alpha($this->value)){
            $this->error = $message ? $message : sprintf("The %s field may only contain alphabetical characters", $this->label);
        }

        return $this;
    }

    public function is_alpha_numeric($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_alpha_numeric($this->value)){
            $this->error = $message ? $message : sprintf("The %s field may only contain alpha-numeric characters", $this->label);
        }

        return $this;
    }

    public function is_decimal($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_decimal($this->value)){
            $this->error = $message ? $message : sprintf("The %s field may only contain only decimal number", $this->label);
        }

        return $this;
    }

    public function is_integer($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if( ! is_integer($this->value)){
            $this->error = $message ? $message : sprintf("The %s field must contain an integer", $this->label);
        }

        return $this;
    }

    public function is_natural($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_natural($this->value)){
            $this->error = $message ? $message : sprintf("The %s field must contain only positive numbers", $this->label);
        }

        return $this;
    }

    public function is_natural_no_zero($message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if( ! Validate\is_natural_no_zero($this->value)){
            $this->error = $message ? $message : sprintf("The %s field must contain a number greater than zero", $this->label);
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
            $this->error = sprintf("The %s field value must be a number", $this->label);
        }

        if($this->value <= $min){
            $this->error = $message ? $message : sprintf("The %s field must be greater than %d", $this->label, $min);
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
            $this->error = sprintf("The %s field value must be a number", $this->label);
        }

        if($this->value < $min){
            $this->error = $message ? $message : sprintf("The %s field must be equal or greater than %d", $this->label, $min);
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
            $this->error = sprintf("The %s field value must be a number", $this->label);
        }

        if($this->value >= $max){
            $this->error = $message ? $message : sprintf("The %s field must be less than %d", $this->label, $max);
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
            $this->error = sprintf("The %s field value must be a number", $this->label);
        }

        if($this->value > $max){
            $this->error = $message ? $message : sprintf("The %s field must be equal or less than %d", $this->label, $max);
        }

        return $this;
    }

    public function min_length($min, $message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if(!Validate\min_length($this->value, $min)){
            $this->error = $message ? $message : sprintf("The %s field length must be equal or greater than %d", $this->label, $min);
        }

        return $this;
    }

    public function max_length($max, $message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if(!Validate\max_length($this->value, $max)){
            $this->error = $message ? $message : sprintf("The %s field length must be equal or less than %d", $this->label, $max);
        }

        return $this;
    }

    public function exact_length($length, $message = null)
    {
        if(!empty($this->error)){
            return $this;
        }

        if(!Validate\exact_length($this->value, $length)){
            $this->error = $message ? $message : sprintf("The %s field length must be exactly %d", $this->label, $length);
        }

        return $this;
    }
}