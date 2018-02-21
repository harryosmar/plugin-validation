<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 6:40 PM
 */

namespace PluginSimpleValidate\Contracts;

interface RuleMapping
{
    /**
     * @param string $key
     * @param array $args
     * @return Rule
     */
    public function getRule(string $key, array $args = []) : Rule;

    /**
     * @return $this
     */
    public static function getInstance();
}