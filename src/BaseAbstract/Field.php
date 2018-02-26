<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/16/18
 * Time: 11:01 PM
 */

namespace PluginSimpleValidate\BaseAbstract;

use PluginSimpleValidate\Contracts\BaseField;
use PluginSimpleValidate\Libraries\Language;

abstract class Field implements BaseField
{
    const VAR_LIMIT = 'limit';

    const VAR_MATCH = 'match';

    const VAR_LOWER_LIMIT = 'lower';

    const VAR_UPPER_LIMIT = 'upper';

    const VAR_MESSAGE = 'message';

    const VAR_REGION = 'region';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var array
     */
    protected $errors;

    /**
     * @var array
     * array of Rule
     */
    protected $rules = [];

    /**
     * @var bool
     */
    protected $status;

    /**
     * @var \PluginSimpleValidate\Contracts\RuleMapping
     */
    protected $ruleMapping;

    /**
     * Field constructor.
     * @param string $name
     * @param mixed $value
     */
    public function __construct(
        string $name,
        $value
    ) {
        $this->name = $name;
        $this->value = $value;
        $this->errors = [];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return $this
     */
    protected function emptyErrors()
    {
        $this->errors = [];
        return $this;
    }
}