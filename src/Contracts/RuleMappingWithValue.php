<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 6:40 PM
 */

namespace PluginSimpleValidate\Contracts;

interface RuleMappingWithValue extends BaseRuleMapping
{
    /**
     * @param string $key
     * @param mixed $value
     * @param array $args
     * @return RuleWithValue
     */
    public function getRule(string $key, $value, array $args = []) : RuleWithValue;
}