<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/17/18
 * Time: 11:07 AM
 */

namespace PluginSimpleValidate\BaseAbstract;

abstract class RuleMapping implements \PluginSimpleValidate\Contracts\RuleMapping
{
    const VALIDATE_IS_TRUE = 'is_true';

    const VALIDATE_NUMBER = 'numeric';

    const VALIDATE_REQUIRED = 'required';

    const VALIDATE_EMAIL = 'valid_email';

    const VALIDATE_ALPHA = 'alpha';

    const VALIDATE_ALPHA_OR_NUMERIC = 'alpha_or_numeric';

    const VALIDATE_DECIMAL = 'decimal';

    const VALIDATE_INTEGER = 'integer';

    const VALIDATE_NATURAL_NUMBER = 'natural';

    const VALIDATE_NATURAL_NO_ZERO_NUMBER = 'natural_no_zero';

    const VALIDATE_EQUAL = 'equal';

    const VALIDATE_LESS_THAN = 'less_than';

    const VALIDATE_GREATER_THAN = 'greater_than';

    const VALIDATE_LESS_OR_EQUAL_THAN = 'less_or_equal_than';

    const VALIDATE_GREATER_OR_EQUAL_THAN = 'greater_or_equal_than';

    const VALIDATE_BETWEEN = 'between';

    const VALIDATE_BETWEEN_OR_EQUAL_THAN = 'between_or_equal';

    const VALIDATE_LENGTH = 'length';

    const VALIDATE_LENGTH_LESS_THAN = 'length_less_than';

    const VALIDATE_LENGTH_GREATER_THAN = 'length_greater_than';

    const VALIDATE_LENGTH_LESS_OR_EQUAL_THAN = 'length_less_or_equal_than';

    const VALIDATE_LENGTH_GREATER_OR_EQUAL_THAN = 'length_greater_or_equal_than';

    const VALIDATE_LENGTH_BETWEEN = 'length_between';

    const VALIDATE_LENGTH_BETWEEN_OR_EQUAL_THAN = 'length_between_or_equal';

    const VALIDATE_PHONE_NUMBER = 'valid_phone_number';

    /**
     * @var array
     */
    protected $list;

    /**
     * @var $this
     */
    protected static $instance;

    protected function __construct()
    {
        $this->list = [
            static::VALIDATE_IS_TRUE => [
                'validation_method' => 'is_true',
                'lang_key' => 'is_true'
            ],
            static::VALIDATE_NUMBER => [
                'validation_method' => 'is_number',
                'lang_key' => 'numeric'
            ],
            static::VALIDATE_REQUIRED => [
                'validation_method' => 'is_required',
                'lang_key' => 'required'
            ],
            static::VALIDATE_EMAIL => [
                'validation_method' => 'is_valid_email',
                'lang_key' => 'email'
            ],
            static::VALIDATE_ALPHA => [
                'validation_method' => 'is_alpha',
                'lang_key' => 'alpha'
            ],
            static::VALIDATE_ALPHA_OR_NUMERIC => [
                'validation_method' => 'is_alpha_or_numeric',
                'lang_key' => 'alpha_or_numeric'
            ],
            static::VALIDATE_DECIMAL => [
                'validation_method' => 'is_decimal',
                'lang_key' => 'decimal'
            ],
            static::VALIDATE_INTEGER => [
                'validation_method' => 'is_integer',
                'lang_key' => 'integer'
            ],
            static::VALIDATE_NATURAL_NUMBER => [
                'validation_method' => 'is_natural',
                'lang_key' => 'natural'
            ],
            static::VALIDATE_NATURAL_NO_ZERO_NUMBER => [
                'validation_method' => 'is_natural_no_zero',
                'lang_key' => 'natural_no_zero'
            ],
            static::VALIDATE_EQUAL => [
                'validation_method' => 'is_equal',
                'lang_key' => 'equal'
            ],
            static::VALIDATE_LESS_THAN => [
                'validation_method' => 'less_than',
                'lang_key' => 'less_than'
            ],
            static::VALIDATE_GREATER_THAN => [
                'validation_method' => 'greater_than',
                'lang_key' => 'greater_than'
            ],
            static::VALIDATE_LESS_OR_EQUAL_THAN => [
                'validation_method' => 'less_or_equal_than',
                'lang_key' => 'less_or_equal_than'
            ],
            static::VALIDATE_GREATER_OR_EQUAL_THAN => [
                'validation_method' => 'greater_or_equal_than',
                'lang_key' => 'greater_or_equal_than'
            ],
            static::VALIDATE_BETWEEN => [
                'validation_method' => 'between',
                'lang_key' => 'between'
            ],
            static::VALIDATE_BETWEEN_OR_EQUAL_THAN => [
                'validation_method' => 'between_or_equal',
                'lang_key' => 'between_or_equal'
            ],
            static::VALIDATE_LENGTH => [
                'validation_method' => 'length',
                'lang_key' => 'length'
            ],
            static::VALIDATE_LENGTH_LESS_THAN => [
                'validation_method' => 'length_less_than',
                'lang_key' => 'length_less_than'
            ],
            static::VALIDATE_LENGTH_GREATER_THAN => [
                'validation_method' => 'length_greater_than',
                'lang_key' => 'length_greater_than'
            ],
            static::VALIDATE_LENGTH_LESS_OR_EQUAL_THAN => [
                'validation_method' => 'length_less_or_equal_than',
                'lang_key' => 'length_less_or_equal_than'
            ],
            static::VALIDATE_LENGTH_GREATER_OR_EQUAL_THAN => [
                'validation_method' => 'length_greater_or_equal_than',
                'lang_key' => 'length_greater_or_equal_than'
            ],
            static::VALIDATE_LENGTH_BETWEEN => [
                'validation_method' => 'length_between',
                'lang_key' => 'length_between'
            ],
            static::VALIDATE_LENGTH_BETWEEN_OR_EQUAL_THAN => [
                'validation_method' => 'length_between_or_equal',
                'lang_key' => 'length_between_or_equal'
            ],
            static::VALIDATE_PHONE_NUMBER => [
                'validation_method' => 'valid_phone_number',
                'lang_key' => 'phone_number'
            ],
        ];
    }
}