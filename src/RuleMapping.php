<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 4:51 PM
 */

namespace PluginSimpleValidate;

use PluginSimpleValidate\Exception\RuleNotExist;

class RuleMapping extends \PluginSimpleValidate\BaseAbstract\RuleMapping
{
    /**
     * @return array
     */
    protected static function getList()
    {
        return [
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
        ];
    }

    /**
     * @param string $key
     * @param array $args
     * @return Contracts\Rule
     * @throws RuleNotExist
     */
    public static function getRule(string $key, array $args = []) : \PluginSimpleValidate\Contracts\Rule
    {
        $list = static::getList();

        if (!isset($list[$key])) {
            throw new RuleNotExist('Rule does not exist');
        }

        return new Rule(
            $list[$key]['validation_method'],
            $list[$key]['lang_key'],
            $args
        );
    }
}