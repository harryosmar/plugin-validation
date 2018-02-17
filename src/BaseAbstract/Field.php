<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/16/18
 * Time: 11:01 PM
 */

namespace PluginSimpleValidate\BaseAbstract;

abstract class Field implements \PluginSimpleValidate\Contracts\Field
{
    const VAR_LIMIT = 'limit';

    const VAR_MATCH = 'match';

    const VAR_LOWER_LIMIT = 'lower';

    const VAR_UPPER_LIMIT = 'upper';

    const VAR_MESSAGE = 'message';

    /**
     * @param string $rulesMethod
     * @param array $args
     * @return $this
     */
    abstract protected function addRules(string $rulesMethod, array $args = []);
}