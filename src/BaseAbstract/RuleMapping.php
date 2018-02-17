<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/17/18
 * Time: 11:07 AM
 */

namespace PluginSimpleValidate\BaseAbstract;

abstract class RuleMapping implements \PluginSimpleValidate\Contracts\RuleMapping
{
    const VALIDATE_IS_TRUE = 'is_true';

    const VALIDATE_NUMBER = 'numeric';

    const VALIDATE_REQUIRED = 'required';

    const VALIDATE_EMAIL = 'valid_email';

    const VALIDATE_ALPHA = 'alpha';

    const VALIDATE_ALPHA_OR_NUMERIC = 'alpha_or_numeric';

    const VALIDATE_DECIMAL = 'decimal';

    const VALIDATE_INTEGER = 'integer';

    const VALIDATE_NATURAL_NUMBER = 'natural';

    const VALIDATE_NATURAL_NO_ZERO_NUMBER = 'natural_no_zero';

    const VALIDATE_EQUAL = 'equal';

    const VALIDATE_LESS_THAN = 'less_than';

    const VALIDATE_GREATER_THAN = 'greater_than';

    const VALIDATE_LESS_OR_EQUAL_THAN = 'less_or_equal_than';

    const VALIDATE_GREATER_OR_EQUAL_THAN = 'greater_or_equal_than';

    const VALIDATE_BETWEEN = 'between';

    const VALIDATE_BETWEEN_OR_EQUAL_THAN = 'between_or_equal';

    const VALIDATE_LENGTH = 'length';

    const VALIDATE_LENGTH_LESS_THAN = 'length_less_than';

    const VALIDATE_LENGTH_GREATER_THAN = 'length_greater_than';

    const VALIDATE_LENGTH_LESS_OR_EQUAL_THAN = 'length_less_or_equal_than';

    const VALIDATE_LENGTH_GREATER_OR_EQUAL_THAN = 'length_greater_or_equal_than';

    const VALIDATE_LENGTH_BETWEEN = 'length_between';

    const VALIDATE_LENGTH_BETWEEN_OR_EQUAL_THAN = 'length_between_or_equal';

    /**
     * @return array
     */
    abstract protected static function getList();
}