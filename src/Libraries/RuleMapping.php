<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 4:51 PM
 */

namespace PluginSimpleValidate\Libraries;

use PluginSimpleValidate\Contracts\Rule as ContractsRule;
use PluginSimpleValidate\Exception\RuleNotExist;
use PluginSimpleValidate\Rule;

class RuleMapping extends \PluginSimpleValidate\BaseAbstract\RuleMapping implements \PluginSimpleValidate\Contracts\RuleMapping
{
    /**
     * @var $this
     */
    private static $instance;

    /**
     * @return \PluginSimpleValidate\Contracts\RuleMapping
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
     * @param array $args
     * @return ContractsRule
     * @throws RuleNotExist
     */
    public function getRule(string $key, array $args = []): ContractsRule
    {
        $this->checkRule($key);

        return new Rule(
            $this->list[$key]['validation_method'],
            $this->list[$key]['lang_key'],
            $args
        );
    }
}