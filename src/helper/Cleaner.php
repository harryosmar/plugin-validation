<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 4:18 PM
 */

namespace PluginSimpleValidate\helper\Cleaner;

use PluginSimpleValidate\Exception\InvalidTypeParameter;

if (! function_exists('trim_doubled_space')) {
    function trim_doubled_space($value)
    {
        return preg_replace('/^\s+|\s+$/', '', $value);
    }
}

if (! function_exists('is_valid_type_for_length')) {
    function is_valid_type_for_length($value)
    {
        if (is_array($value) || is_string($value)) {
            return true;
        }

        return false;
    }
}

if (! function_exists('check_is_valid_type_for_length')) {
    function check_is_valid_type_for_length($value) {
        if (!is_valid_type_for_length($value)) {
            throw new InvalidTypeParameter('Invalid parameter type');
        }
    }
}

if (! function_exists('get_length')) {
    function get_length($value)
    {
        if (is_array($value)) {
            return count($value);
        }

        if (is_string($value)) {
            return strlen($value);
        }

        return 0;
    }
}