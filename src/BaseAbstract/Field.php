<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/16/18
 * Time: 11:01 PM
 */

namespace PluginSimpleValidate\BaseAbstract;

use PluginSimpleValidate\Libraries\Language;

abstract class Field implements \PluginSimpleValidate\Contracts\Field
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
     * @param Language $language
     * @return bool
     */
    public function isValid(Language $language) : bool
    {
        // empty the `errors` array
        $this->emptyErrors();

        /** @var \PluginSimpleValidate\Contracts\Rule $rule */
        foreach ($this->rules as $ruleName => $rule) {
            if (!$rule->isValid($language, $this->value)) {
                $this->status = false;
                $this->errors[] = $rule->getError();
            }
        }

        if (empty($this->errors)) {
            $this->status = true;
        }

        return $this->status;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
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
     * @param string $rulesMethod
     * @param array $args
     * @return $this
     */
    protected function addRules(string $rulesMethod, array $args = [])
    {
        $this->rules[$rulesMethod] = \PluginSimpleValidate\Libraries\RuleMapping::getInstance()->getRule($rulesMethod, $args);
        return $this;
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