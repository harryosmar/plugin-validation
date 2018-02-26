<?php

namespace PluginSimpleValidate\helper\Validate;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberUtil;
use PluginSimpleValidate\BaseAbstract\Field;
use PluginSimpleValidate\Exception\InvalidTypeParameter;
use function PluginSimpleValidate\helper\Cleaner\get_length;
use function PluginSimpleValidate\helper\Cleaner\is_valid_type_for_length;
use function PluginSimpleValidate\helper\Cleaner\trim_doubled_space;

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
        return $value !== '';
    }
}

if (! function_exists('is_not_empty')) {
    function is_not_empty($value)
    {
        return !empty(trim_doubled_space($value));
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

if (! function_exists('is_alpha_or_numeric')) {
    function is_alpha_or_numeric($value)
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

if (! function_exists('is_integer')) {
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
        return $value === $args[Field::VAR_MATCH];
    }
}

if (! function_exists('less_than')) {
    function less_than($value, array $args)
    {
        return $value < $args[Field::VAR_LIMIT];
    }
}

if (! function_exists('greater_than')) {
    function greater_than($value, array $args)
    {
        return $value > $args[Field::VAR_LIMIT];
    }
}

if (! function_exists('less_or_equal_than')) {
    function less_or_equal_than($value, array $args)
    {
        return $value <= $args[Field::VAR_LIMIT];
    }
}

if (! function_exists('greater_or_equal_than')) {
    function greater_or_equal_than($value, array $args)
    {
        return $value >= $args[Field::VAR_LIMIT];
    }
}

if (! function_exists('between')) {
    function between($value, array $args)
    {
        return $value < $args[Field::VAR_UPPER_LIMIT] && $value > $args[Field::VAR_LOWER_LIMIT];
    }
}

if (! function_exists('between_or_equal')) {
    function between_or_equal($value, array $args)
    {
        return $value <= $args[Field::VAR_UPPER_LIMIT] && $value >= $args[Field::VAR_LOWER_LIMIT];
    }
}

if (! function_exists('length')) {
    function length($value, array $args)
    {
        return run_length_rule(
            $value,
            get_length($value) === $args[Field::VAR_LIMIT]
        );
    }
}

if (! function_exists('length_less_than')) {
    function length_less_than($value, array $args)
    {
        return run_length_rule(
            $value,
            get_length($value) < $args[Field::VAR_LIMIT]
        );
    }
}

if (! function_exists('length_greater_than')) {
    function length_greater_than($value, array $args)
    {
        return run_length_rule(
            $value,
            get_length($value) > $args[Field::VAR_LIMIT]
        );
    }
}

if (! function_exists('length_less_or_equal_than')) {
    function length_less_or_equal_than($value, array $args)
    {
        return run_length_rule(
            $value,
            get_length($value) <= $args[Field::VAR_LIMIT]
        );
    }
}

if (! function_exists('length_greater_or_equal_than')) {
    function length_greater_or_equal_than($value, array $args)
    {
        return run_length_rule(
            $value,
            get_length($value) >= $args[Field::VAR_LIMIT]
        );
    }
}

if (! function_exists('length_between')) {
    function length_between($value, array $args)
    {
        return run_length_rule(
            $value,
            get_length($value) < $args[Field::VAR_UPPER_LIMIT] && get_length($value) > $args[Field::VAR_LOWER_LIMIT]
        );
    }
}


if (! function_exists('length_between_or_equal')) {
    function length_between_or_equal($value, array $args)
    {
        return run_length_rule(
            $value,
            get_length($value) <= $args[Field::VAR_UPPER_LIMIT] && get_length($value) >= $args[Field::VAR_LOWER_LIMIT]
        );
    }
}

if (! function_exists('valid_phone_number')) {
    function valid_phone_number($value, array $args)
    {
        try {
            $phoneUtil = PhoneNumberUtil::getInstance();

            /** @var PhoneNumber $phoneNumber */
            $phoneNumberProto = $phoneUtil->parse($value, $args[Field::VAR_REGION]);
            return $phoneUtil->isValidNumber(
                $phoneNumberProto
            );
        } catch (NumberParseException $exception) {
            return false;
        }
    }
}

if (! function_exists('run_length_rule')) {
    function run_length_rule($value, $result) {
        if (!is_valid_type_for_length($value)) {
            throw new InvalidTypeParameter('Invalid parameter type');
        }

        return $result;
    }
}