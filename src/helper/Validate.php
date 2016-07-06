<?php

namespace PluginSimpleValidate\helper\Validate;

if (! function_exists('is_empty')) {
    function is_empty($value){
        $value = preg_replace('/^\s+|\s+$/', '', $value);
        return empty($value);
    }
}

if (! function_exists('is_valid_email')) {
    function is_valid_email($value){
        return preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $value);
    }
}

if (! function_exists('is_alpha')) {
    function is_alpha($value){
        return preg_match("/^([a-z])+$/i", $value);
    }
}

if (! function_exists('is_alpha_numeric')) {
    function is_alpha_numeric($value){
        return preg_match("/^([a-z0-9])+$/i", $value);
    }
}

if (! function_exists('is_decimal')) {
    function is_decimal($value){
        return preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $value);
    }
}

if (! function_exists('is_integer')) {
    function is_integer($value){
        return preg_match('/^[\-+]?[0-9]+$/', $value);
    }
}

if (! function_exists('is_natural')) {
    function is_natural($value){
        return preg_match('/^[0-9]+$/', $value);
    }
}

if (! function_exists('is_natural_no_zero')) {
    function is_natural_no_zero($value){
        return preg_match('/^[1-9]+$/', $value);
    }
}

if (! function_exists('max_length')) {
    function max_length($value, $max){
        return strlen($value) > $max ? false : true;
    }
}

if (! function_exists('min_length')) {
    function min_length($value, $min){
        return strlen($value) < $min ? false : true;
    }
}

if (! function_exists('exact_length')) {
    function exact_length($value, $length){
        return strlen($value) === $length ? true : false;
    }
}