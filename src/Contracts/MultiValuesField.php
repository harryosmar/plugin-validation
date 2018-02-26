<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 6:50 PM
 */

namespace PluginSimpleValidate\Contracts;

interface MultiValuesField extends BaseField
{
    /**
     * @param string $rulesMethod
     * @param mixed $value
     * @param array $args
     * @return mixed
     */
    public function addRules(string $rulesMethod, $value, array $args = []);

    /**
     * @param $value
     * @param string $message
     * @return $this
     */
    public function isTrue($value, string $message = '');

    /**
     * @param  mixed $value
     * @return $this
     */
    public function required($value);

    /**
     * @param  mixed $value
     * @return $this
     */
    public function notEmpty($value);

    /**
     * @param  mixed $value
     * @return $this
     */
    public function isNumber($value);

    /**
     * @param  mixed $value
     * @return $this
     */
    public function validEmail($value);

    /**
     * @param  mixed $value
     * @return $this
     */
    public function isAlpha($value);

    /**
     * @param  mixed $value
     * @return $this
     */
    public function isAlphaOrNumeric($value);

    /**
     * @param  mixed $value
     * @return $this
     */
    public function isDecimal($value);

    /**
     * @param  mixed $value
     * @return $this
     */
    public function isInteger($value);

    /**
     * @param  mixed $value
     * @return $this
     */
    public function isNatural($value);

    /**
     * @param  mixed $value
     * @return $this
     */
    public function isNaturalNoZero($value);

    /**
     * @param  mixed $value
     * @param int|float|double|string $match
     * @return $this
     */
    public function equal($value, $match);

    /**
     * @param  mixed $value
     * @param int|float|double $limit
     * @return $this
     */
    public function lessThan($value, $limit);

    /**
     * @param  mixed $value
     * @param int|float|double $limit
     * @return $this
     */
    public function greaterThan($value, $limit);

    /**
     * @param  mixed $value
     * @param int|float|double $limit
     * @return $this
     */
    public function lessOrEqualThan($value, $limit);

    /**
     * @param  mixed $value
     * @param int|float|double $limit
     * @return $this
     */
    public function greaterOrEqualThan($value, $limit);

    /**
     * @param  mixed $value
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return $this
     */
    public function between($value, $lower, $upper);

    /**
     * @param  mixed $value
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return $this
     */
    public function betweenOrEqual($value, $lower, $upper);

    /**
     * @param  mixed $value
     * @param int|float|double $limit
     * @return $this
     */
    public function length($value, $limit);

    /**
     * @param  mixed $value
     * @param int|float|double $limit
     * @return $this
     */
    public function lengthLessThan($value, $limit);

    /**
     * @param  mixed $value
     * @param int|float|double $limit
     * @return $this
     */
    public function lengthGreaterThan($value, $limit);

    /**
     * @param  mixed $value
     * @param int|float|double $limit
     * @return $this
     */
    public function lengthLessOrEqualThan($value, $limit);

    /**
     * @param  mixed $value
     * @param int|float|double $limit
     * @return $this
     */
    public function lengthGreaterOrEqualThan($value, $limit);

    /**
     * @param  mixed $value
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return $this
     */
    public function lengthBetween($value, $lower, $upper);

    /**
     * @param  mixed $value
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return $this
     */
    public function lengthBetweenOrEqual($value, $lower, $upper);

    /**
     * @param  mixed $value
     * @param string $region
     * @return $this
     */
    public function isValidPhone($value, string $region);
}