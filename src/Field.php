<?php

namespace PluginSimpleValidate;

use PluginSimpleValidate\Libraries\Language;

class Field implements \PluginSimpleValidate\Contracts\Field
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @var array
     */
    private $errors;

    /**
     * @var array
     * array of Rule
     */
    private $rules = [];

    /**
     * @var bool
     */
    private $status;

    /**
     * Field constructor.
     * @param string $name
     * @param mixed $value
     */
    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
        $this->errors = [];
    }

    /**
     * @param string $rulesMethod
     * @return $this
     */
    public function addRules(string $rulesMethod)
    {
        $this->rules[$rulesMethod] = RuleMapping::getRule($rulesMethod);
        return $this;
    }

    /**
     * @param Language $language
     * @param bool $break_when_error
     * @return bool
     */
    public function isValid(Language $language, $break_when_error = false) : bool
    {
        /** @var \PluginSimpleValidate\Contracts\Rule $rule */
        foreach ($this->rules as $ruleName => $rule) {
            if (!$rule->isValid($language, $this->value)) {
                $this->status = false;
                $this->errors[] = $language->getTranslation(
                    $rule->getLangKey()
                );

                /**
                 * break when there is any rule error
                 */
                if ($break_when_error === true) {
                    break;
                }
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
    public function required()
    {
        $this->addRules('required');
        return $this;
    }

    /**
     * @return $this
     */
    public function validEmail()
    {
        $this->addRules('valid_email');
        return $this;
    }
}