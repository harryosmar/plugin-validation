<?php

namespace PluginSimpleValidate\helper\Validate;

function is_empty($value){
    $value = preg_replace('/^\s+|\s+$/', '', $value);
    return empty($value);
}


function is_valid_email($value){
    return preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $value);
}


function is_alpha($value){
    return preg_match("/^([a-z])+$/i", $value);
}


function is_alpha_numeric($value){
    return preg_match("/^([a-z0-9])+$/i", $value);
}


function is_decimal($value){
    return preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $value);
}


function is_integer($value){
    return preg_match('/^[\-+]?[0-9]+$/', $value);
}


function is_natural($value){
    return preg_match('/^[0-9]+$/', $value);
}


function is_natural_no_zero($value){
    return preg_match('/^[1-9]+$/', $value);
}

function get_type($value, $hasNumericRules = false){
    if (is_numeric($value) && $hasNumericRules) {
        return 'number';
    }elseif (is_array($value)) {
        return 'array';
    }

    return 'string';
}

function min_length($value, $min, $hasNumericRules = false){
    $min = intval($min);

    switch (get_type($value, $hasNumericRules)) {
        case 'number':
            return $value < $min ? false : true;
        case 'array':
            return count($value) < $min ? false : true;
        default :
            return mb_strlen($value) < $min ? false : true;
    }
}

function max_length($value, $max, $hasNumericRules = false){
    $max = intval($max);

    switch (get_type($value, $hasNumericRules)) {
        case 'number':
            return $value > $max ? false : true;
        case 'array':
            return count($value) > $max ? false : true;
        default :
            return mb_strlen($value) > $max ? false : true;
    }
}


function exact_length($value, $length, $hasNumericRules = false){
    $length = intval($length);

    switch (get_type($value, $hasNumericRules)) {
        case 'number':
            return $value === $length ? true : false;
        case 'array':
            return count($value) === $length ? true : false;
        default :
            return mb_strlen($value) === $length ? true : false;
    }
}


function equal($expected, $actual){
    return $expected === $actual;
}