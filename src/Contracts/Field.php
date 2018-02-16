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
     * @param string $rulesMethod
     * @return mixed
     */
    public function addRules(string $rulesMethod);

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
}