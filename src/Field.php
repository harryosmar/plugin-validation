<?php

namespace PluginSimpleValidate;

use PluginSimpleValidate\BaseAbstract\RuleMapping as AbstractRuleMapping;
use PluginSimpleValidate\Libraries\Language;

class Field extends \PluginSimpleValidate\BaseAbstract\Field implements \PluginSimpleValidate\Contracts\Field
{
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
     * @param string $rulesMethod
     * @param array $args
     * @return $this
     */
    public function addRules(string $rulesMethod, array $args = [])
    {
        $this->rules[$rulesMethod] = \PluginSimpleValidate\Libraries\RuleMapping::getInstance()->getRule($rulesMethod, $args);
        return $this;
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
     * @param string $message
     * @return $this
     */
    public function isTrue(string $message = '')
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_IS_TRUE, [static::VAR_MESSAGE => $message]);
        return $this;
    }

    /**
     * @return $this
     */
    public function required()
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_REQUIRED);
        return $this;
    }

    /**
     * @return $this
     */
    public function notEmpty()
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_IS_NOT_EMPTY);
        return $this;
    }

    /**
     * @return $this
     */
    public function validEmail()
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_EMAIL);
        return $this;
    }

    /**
     * @param int|float|double|string $match
     * @return $this
     */
    public function equal($match)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_EQUAL, [static::VAR_MATCH => $match]);
        return $this;
    }

    /**
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function isNumber()
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_NUMBER);
        return $this;
    }

    /**
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function isAlpha()
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_ALPHA);
        return $this;
    }

    /**
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function isAlphaOrNumeric()
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_ALPHA_OR_NUMERIC);
        return $this;
    }

    /**
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function isDecimal()
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_DECIMAL);
        return $this;
    }

    /**
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function isInteger()
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_INTEGER);
        return $this;
    }

    /**
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function isNatural()
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_NATURAL_NUMBER);
        return $this;
    }

    /**
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function isNaturalNoZero()
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_NATURAL_NO_ZERO_NUMBER);
        return $this;
    }

    /**
     * @param int|float|double $limit
     * @return $this
     */
    public function lessThan($limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LESS_THAN, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param int|float|double $limit
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function greaterThan($limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_GREATER_THAN, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param int|float|double $limit
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function lessOrEqualThan($limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LESS_OR_EQUAL_THAN, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param int|float|double $limit
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function greaterOrEqualThan($limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_GREATER_OR_EQUAL_THAN, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return $this
     */
    public function between($lower, $upper)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_BETWEEN, [static::VAR_LOWER_LIMIT => $lower, static::VAR_UPPER_LIMIT => $upper]);
        return $this;
    }

    /**
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function betweenOrEqual($lower, $upper)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_BETWEEN_OR_EQUAL_THAN, [static::VAR_LOWER_LIMIT => $lower, static::VAR_UPPER_LIMIT => $upper]);
        return $this;
    }

    /**
     * @param int|float|double $limit
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function length($limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH);
        return $this;
    }

    /**
     * @param int|float|double $limit
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function lengthLessThan($limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH_LESS_THAN, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param int|float|double $limit
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function lengthGreaterThan($limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH_GREATER_THAN, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param int|float|double $limit
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function lengthLessOrEqualThan($limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH_LESS_OR_EQUAL_THAN, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param int|float|double $limit
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function lengthGreaterOrEqualThan($limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH_GREATER_OR_EQUAL_THAN, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function lengthBetween($lower, $upper)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH_BETWEEN, [static::VAR_LOWER_LIMIT => $lower, static::VAR_UPPER_LIMIT => $upper]);
        return $this;
    }

    /**
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function lengthBetweenOrEqual($lower, $upper)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH_BETWEEN_OR_EQUAL_THAN, [static::VAR_LOWER_LIMIT => $lower, static::VAR_UPPER_LIMIT => $upper]);
        return $this;
    }

    /**
     * @param string $region
     * @return \PluginSimpleValidate\Contracts\Field
     */
    public function isValidPhone(string $region)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_PHONE_NUMBER, [static::VAR_REGION => $region]);
        return $this;
    }
}