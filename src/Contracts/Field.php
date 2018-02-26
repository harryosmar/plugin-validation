<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 6:50 PM
 */

namespace PluginSimpleValidate\Contracts;

use PluginSimpleValidate\Libraries\Language;

interface Field
{
    /**
     * @param $language
     * @return bool
     */
    public function isValid(Language $language) : bool;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value);

    /**
     * @return array
     */
    public function getRules();

    /**
     * @return array
     */
    public function getErrors();

    /**
     * @param string $message
     * @return $this
     */
    public function isTrue(string $message = '');

    /**
     * @return $this
     */
    public function required();

    /**
     * @return $this
     */
    public function notEmpty();

    /**
     * @return $this
     */
    public function isNumber();

    /**
     * @return $this
     */
    public function validEmail();

    /**
     * @return $this
     */
    public function isAlpha();

    /**
     * @return $this
     */
    public function isAlphaOrNumeric();

    /**
     * @return $this
     */
    public function isDecimal();

    /**
     * @return $this
     */
    public function isInteger();

    /**
     * @return $this
     */
    public function isNatural();

    /**
     * @return $this
     */
    public function isNaturalNoZero();

    /**
     * @param int|float|double|string $match
     * @return $this
     */
    public function equal($match);

    /**
     * @param int|float|double $limit
     * @return $this
     */
    public function lessThan($limit);

    /**
     * @param int|float|double $limit
     * @return $this
     */
    public function greaterThan($limit);

    /**
     * @param int|float|double $limit
     * @return $this
     */
    public function lessOrEqualThan($limit);

    /**
     * @param int|float|double $limit
     * @return $this
     */
    public function greaterOrEqualThan($limit);

    /**
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return $this
     */
    public function between($lower, $upper);

    /**
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return $this
     */
    public function betweenOrEqual($lower, $upper);

    /**
     * @param int|float|double $limit
     * @return $this
     */
    public function length($limit);

    /**
     * @param int|float|double $limit
     * @return $this
     */
    public function lengthLessThan($limit);

    /**
     * @param int|float|double $limit
     * @return $this
     */
    public function lengthGreaterThan($limit);

    /**
     * @param int|float|double $limit
     * @return $this
     */
    public function lengthLessOrEqualThan($limit);

    /**
     * @param int|float|double $limit
     * @return $this
     */
    public function lengthGreaterOrEqualThan($limit);

    /**
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return $this
     */
    public function lengthBetween($lower, $upper);

    /**
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return $this
     */
    public function lengthBetweenOrEqual($lower, $upper);

    /**
     * @param string $region
     * @return $this
     */
    public function isValidPhone(string $region);
}