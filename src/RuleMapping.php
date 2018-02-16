<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 4:51 PM
 */

namespace PluginSimpleValidate;

use PluginSimpleValidate\Exception\RuleNotExist;

class RuleMapping implements \PluginSimpleValidate\Contracts\RuleMapping
{
    protected static $list = [
        'numeric' => [
            'validation_method' => 'is_number',
            'lang_key' => 'alpha'
        ],
        'required' => [
            'validation_method' => 'is_required',
            'lang_key' => 'required'
        ],
        'alpha_numeric' => [
            'validation_method' => 'is_alpha_numeric',
            'lang_key' => 'alpha_numeric'
        ],
        'decimal' => [
            'validation_method' => 'is_decimal',
            'lang_key' => 'decimal'
        ],
        'valid_email' => [
            'validation_method' => 'is_valid_email',
            'lang_key' => 'email'
        ],
        'integer' => [
            'validation_method' => 'is_integer',
            'lang_key' => 'integer'
        ],
        'natural' => [
            'validation_method' => 'is_natural',
            'lang_key' => 'natural'
        ],
        'natural_no_zero' => [
            'validation_method' => 'is_natural_no_zero',
            'lang_key' => 'natural_no_zero'
        ],
        'equal' => [
            'validation_method' => 'is_equal',
            'lang_key' => 'equal'
        ],
        'less_than' => [
            'validation_method' => 'less_than',
            'lang_key' => 'less_than'
        ],
        'greater_than' => [
            'validation_method' => 'greater_than',
            'lang_key' => 'greater_than'
        ],
        'less_or_equal_than' => [
            'validation_method' => 'less_or_equal_than',
            'lang_key' => 'less_or_equal_than'
        ],
        'greater_or_equal_than' => [
            'validation_method' => 'greater_or_equal_than',
            'lang_key' => 'greater_or_equal_than'
        ],
        'between' => [
            'validation_method' => 'between',
            'lang_key' => 'between'
        ],
        'between_or_equal' => [
            'validation_method' => 'between_or_equal',
            'lang_key' => 'between_or_equal'
        ],
    ];

    /**
     * @param string $key
     * @param array $args
     * @return Contracts\Rule
     * @throws RuleNotExist
     */
    public static function getRule(string $key, array $args = []) : \PluginSimpleValidate\Contracts\Rule
    {
        if (!isset(static::$list[$key])) {
            throw new RuleNotExist('Rule does not exist');
        }

        return new Rule(
            static::$list[$key]['validation_method'],
            static::$list[$key]['lang_key'],
            $args
        );
    }
}