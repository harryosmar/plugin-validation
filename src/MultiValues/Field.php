<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/26/18
 * Time: 4:53 PM
 */

namespace PluginSimpleValidate\MultiValues;

use PluginSimpleValidate\Contracts\MultiValuesField;
use PluginSimpleValidate\BaseAbstract\RuleMapping as AbstractRuleMapping;
use PluginSimpleValidate\Contracts\RuleWithValue;
use PluginSimpleValidate\Libraries\Language;

class Field extends \PluginSimpleValidate\BaseAbstract\Field implements MultiValuesField
{
    /**
     * @param Language $language
     * @return bool
     */
    public function isValid(Language $language) : bool
    {
        // empty the `errors` array
        $this->emptyErrors();

        /** @var RuleWithValue $rule */
        foreach ($this->rules as $ruleName => $rule) {
            if (!$rule->isValid($language, $rule->getValue())) {
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
     * @param mixed $value
     * @param array $args
     * @return $this
     */
    public function addRules(string $rulesMethod, $value, array $args = [])
    {
        $this->rules[uniqid(rand(), true) . $rulesMethod] = \PluginSimpleValidate\Libraries\MultiValues\RuleMapping::getInstance()->getRule($rulesMethod, $value, $args);
        return $this;
    }

    /**
     * Field constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name, null);
    }

    /**
     * @param $value
     * @param string $message
     * @return $this
     */
    public function isTrue($value, string $message = '')
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_IS_TRUE, $value, [static::VAR_MESSAGE => $message]);
        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function required($value)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_REQUIRED, $value);
        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function notEmpty($value)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_IS_NOT_EMPTY, $value);
        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function validEmail($value)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_EMAIL, $value);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int|string $match
     * @return $this
     */
    public function equal($value, $match)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_EQUAL, $value, [static::VAR_MATCH => $match]);
        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function isNumber($value)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_NUMBER, $value);
        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function isAlpha($value)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_ALPHA, $value);
        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function isAlphaOrNumeric($value)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_ALPHA_OR_NUMERIC, $value);
        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function isDecimal($value)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_DECIMAL, $value);
        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function isInteger($value)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_INTEGER, $value);
        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function isNatural($value)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_NATURAL_NUMBER, $value);
        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function isNaturalNoZero($value)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_NATURAL_NO_ZERO_NUMBER, $value);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $limit
     * @return $this
     */
    public function lessThan($value, $limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LESS_THAN, $value, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $limit
     * @return $this
     */
    public function greaterThan($value, $limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_GREATER_THAN, $value, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $limit
     * @return $this
     */
    public function lessOrEqualThan($value, $limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LESS_OR_EQUAL_THAN, $value, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $limit
     * @return $this
     */
    public function greaterOrEqualThan($value, $limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_GREATER_OR_EQUAL_THAN, $value, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $lower
     * @param float|int $upper
     * @return $this
     */
    public function between($value, $lower, $upper)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_BETWEEN, $value, [static::VAR_LOWER_LIMIT => $lower, static::VAR_UPPER_LIMIT => $upper]);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $lower
     * @param float|int $upper
     * @return $this
     */
    public function betweenOrEqual($value, $lower, $upper)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_BETWEEN_OR_EQUAL_THAN, $value, [static::VAR_LOWER_LIMIT => $lower, static::VAR_UPPER_LIMIT => $upper]);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $limit
     * @return $this
     */
    public function length($value, $limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH, $value);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $limit
     * @return $this
     */
    public function lengthLessThan($value, $limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH_LESS_THAN, $value, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $limit
     * @return $this
     */
    public function lengthGreaterThan($value, $limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH_GREATER_THAN, $value, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $limit
     * @return $this
     */
    public function lengthLessOrEqualThan($value, $limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH_LESS_OR_EQUAL_THAN, $value, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $limit
     * @return $this
     */
    public function lengthGreaterOrEqualThan($value, $limit)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH_GREATER_OR_EQUAL_THAN, $value, [static::VAR_LIMIT => $limit]);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $lower
     * @param float|int $upper
     * @return $this
     */
    public function lengthBetween($value, $lower, $upper)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH_BETWEEN, $value, [static::VAR_LOWER_LIMIT => $lower, static::VAR_UPPER_LIMIT => $upper]);
        return $this;
    }

    /**
     * @param mixed $value
     * @param float|int $lower
     * @param float|int $upper
     * @return $this
     */
    public function lengthBetweenOrEqual($value, $lower, $upper)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_LENGTH_BETWEEN_OR_EQUAL_THAN, $value, [static::VAR_LOWER_LIMIT => $lower, static::VAR_UPPER_LIMIT => $upper]);
        return $this;
    }

    /**
     * @param mixed $value
     * @param string $region
     * @return $this
     */
    public function isValidPhone($value, string $region)
    {
        $this->addRules(AbstractRuleMapping::VALIDATE_PHONE_NUMBER, $value, [static::VAR_REGION => $region]);
        return $this;
    }
}