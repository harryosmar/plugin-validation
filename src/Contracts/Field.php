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
     * @param Language $language
     * @param bool $break_when_error
     * @return bool
     */
    public function isValid(Language $language, $break_when_error = false) : bool;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return array
     */
    public function getRules();

    /**
     * @return array
     */
    public function getErrors();

    /**
     * @return mixed
     */
    public function required();

    /**
     * @return $this
     */
    public function validEmail();

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
     * @param int|float|double $lower
     * @param int|float|double $upper
     * @return $this
     */
    public function between($lower, $upper);

    /**
     * @param string $message
     * @return $this
     */
    public function isTrue(string $message = '');
}