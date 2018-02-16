<?php

namespace PluginSimpleValidate\helper\Validate;

use function PluginSimpleValidate\helper\Cleaner\trim_doubled_space;

const VAR_LIMIT = 'limit';

const VAR_MATCH = 'match';

const VAR_LOWER_LIMIT = 'lower';

const VAR_UPPER_LIMIT = 'upper';

const VAR_MESSAGE = 'message';


if (! function_exists('is_true')) {
    function is_true($value)
    {
        return $value === true;
    }
}

if (! function_exists('is_number')) {
    function is_number($value)
    {
        return is_numeric($value);
    }
}

if (! function_exists('is_required')) {
    function is_required($value)
    {
        return !empty(trim_doubled_space($value));
    }
}

if (! function_exists('is_empty')) {
    function is_empty($value)
    {
        return empty(trim_doubled_space($value));
    }
}

if (! function_exists('is_valid_email')) {
    function is_valid_email($value)
    {
        return preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $value);
    }
}

if (! function_exists('is_alpha')) {
    function is_alpha($value)
    {
        return preg_match("/^([a-z])+$/i", $value);
    }
}

if (! function_exists('is_alpha_numeric')) {
    function is_alpha_numeric($value)
    {
        return preg_match("/^([a-z0-9])+$/i", $value);
    }
}

if (! function_exists('is_decimal')) {
    function is_decimal($value)
    {
        return preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $value);
    }
}

if (! function_exists('is_true')) {
    function is_integer($value)
    {
        return preg_match('/^[\-+]?[0-9]+$/', $value);
    }
}

if (! function_exists('is_natural')) {
    function is_natural($value)
    {
        return preg_match('/^[0-9]+$/', $value);
    }
}

if (! function_exists('is_natural_no_zero')) {
    function is_natural_no_zero($value)
    {
        return preg_match('/^[1-9]+[0]*$/', $value);
    }
}

if (! function_exists('is_equal')) {
    function is_equal($value, array $args)
    {
        return $value === $args[VAR_MATCH];
    }
}

if (! function_exists('less_than')) {
    function less_than($value, array $args)
    {
        return $value < $args[VAR_LIMIT];
    }
}

if (! function_exists('greater_than')) {
    function greater_than($value, array $args)
    {
        return $value > $args[VAR_LIMIT];
    }
}

if (! function_exists('less_or_equal_than')) {
    function less_or_equal_than($value, array $args)
    {
        return $value <= $args[VAR_LIMIT];
    }
}

if (! function_exists('greater_or_equal_than')) {
    function greater_or_equal_than($value, array $args)
    {
        return $value >= $args[VAR_LIMIT];
    }
}

if (! function_exists('between')) {
    function between($value, array $args)
    {
        return $value < $args[VAR_UPPER_LIMIT] && $value > $args[VAR_LOWER_LIMIT];
    }
}

if (! function_exists('between_or_equal')) {
    function between_or_equal($value, array $args)
    {
        return $value <= $args[VAR_UPPER_LIMIT] && $value >= $args[VAR_LOWER_LIMIT];
    }
}