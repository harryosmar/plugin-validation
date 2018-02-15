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
        'equal' => [
            'validation_method' => 'is_equal',
            'lang_key' => 'equal'
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
        ]
    ];

    /**
     * @param string $key
     * @return Rule
     * @throws RuleNotExist
     */
    public static function getRule(string $key) : Rule
    {
        if (!isset(static::$list[$key])) {
            throw new RuleNotExist('Rule does not exist');
        }

        return new Rule(
            static::$list[$key]['validation_method'],
            static::$list[$key]['lang_key']
        );
    }
}