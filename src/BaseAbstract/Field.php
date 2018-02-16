<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/16/18
 * Time: 11:01 PM
 */

namespace PluginSimpleValidate\BaseAbstract;

abstract class Field
{
    /**
     * @param string $rulesMethod
     * @param array $args
     * @return $this
     */
    abstract protected function addRules(string $rulesMethod, array $args = []);
}