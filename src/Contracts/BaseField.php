<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/26/18
 * Time: 5:00 PM
 */

namespace PluginSimpleValidate\Contracts;

use PluginSimpleValidate\Libraries\Language;

interface BaseField
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
     * @return array
     */
    public function getRules();

    /**
     * @return array
     */
    public function getErrors();
}