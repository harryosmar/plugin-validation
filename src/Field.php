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
    private $error;

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
     * @return bool
     */
    public function isValid(Language $language) : bool
    {
        /** @var \PluginSimpleValidate\Contracts\Rule $rule */
        foreach ($this->rules as $ruleName => $rule) {
            if (!call_user_func_array(
                '\\PluginSimpleValidate\\helper\\Validate\\' . $rule->getValidationMethod(),
                    [
                        $this->value
                    ]
            )) {
                $this->status = false;

                $this->error[] = $language->getTranslation(
                    $rule->getLangKey()
                );
            }
        }


        if ($this->status !== false) {
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
    public function getError(): array
    {
        return $this->error;
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