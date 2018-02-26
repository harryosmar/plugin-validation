<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/26/18
 * Time: 4:54 PM
 */

namespace PluginSimpleValidate\WithValue;

use PluginSimpleValidate\Contracts\RuleWithValue;

class Rule extends \PluginSimpleValidate\Rule implements RuleWithValue
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * Rule constructor.
     * @param string $validationMethod
     * @param string $langKey
     * @param array $value
     * @param array $args
     */
    public function __construct($validationMethod, $langKey, $value, array $args = [])
    {
        $this->value = $value;
        parent::__construct($validationMethod, $langKey, $args);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}