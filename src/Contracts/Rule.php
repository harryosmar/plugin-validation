<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 6:49 PM
 */

namespace PluginSimpleValidate\Contracts;

use PluginSimpleValidate\Libraries\Language;

interface Rule
{
    public function getValidationMethod(): string;

    /**
     * @return string
     */
    public function getLangKey(): string;

    /**
     * @return bool
     */
    public function getStatus(): bool;

    /**
     * @param Language $language
     * @param $value
     * @return bool
     */
    public function isValid(Language $language, $value) : bool;
}