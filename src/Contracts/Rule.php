<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 6:49 PM
 */

namespace PluginSimpleValidate\Contracts;

interface Rule
{
    public function getValidationMethod(): string;

    /**
     * @return string
     */
    public function getLangKey(): string;
}