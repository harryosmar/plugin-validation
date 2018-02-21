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
     * @return Contracts\Rule
     * @throws RuleNotExist
     */
    public function getRule(string $key, array $args = []) : \PluginSimpleValidate\Contracts\Rule
    {
        if (!isset($this->list[$key])) {
            throw new RuleNotExist('Rule does not exist');
        }

        return new Rule(
            $this->list[$key]['validation_method'],
            $this->list[$key]['lang_key'],
            $args
        );
    }
}