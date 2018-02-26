<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 6:52 PM
 */

namespace PluginSimpleValidate\Contracts;


interface Validation
{
    /**
     * @param BaseField $field
     */
    public function addField(BaseField $field);

    /**
     * @param bool $break_when_error
     * @return bool
     */
    public function run($break_when_error = false) : bool;

    /**
     * @return array
     */
    public function getErrors();

    /**
     * @param string $fieldName
     * @return array|Field|null
     */
    public function getFields(string $fieldName = '');
}