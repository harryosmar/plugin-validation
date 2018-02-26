<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/26/18
 * Time: 5:38 PM
 */

namespace PluginSimpleValidate\Libraries\MultiValues;

use PluginSimpleValidate\Contracts\RuleMappingWithValue;
use PluginSimpleValidate\Contracts\RuleWithValue as ContractsRuleWithValue;
use PluginSimpleValidate\Exception\RuleNotExist;
use PluginSimpleValidate\WithValue\Rule;

class RuleMapping extends \PluginSimpleValidate\BaseAbstract\RuleMapping implements RuleMappingWithValue
{
    /**
     * @var $this
     */
    private static $instance;

    /**
     * @return \PluginSimpleValidate\Contracts\RuleMappingWithValue
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param array $args
     * @return ContractsRuleWithValue
     * @throws RuleNotExist
     */
    public function getRule(string $key, $value, array $args = []): ContractsRuleWithValue
    {
        $this->checkRule($key);

        return new Rule(
            $this->list[$key]['validation_method'],
            $this->list[$key]['lang_key'],
            $value,
            $args
        );
    }
}