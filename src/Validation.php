<?php

namespace PluginSimpleValidate;

use PluginSimpleValidate\Libraries\Language;

class Validation implements \PluginSimpleValidate\Contracts\Validation
{
    /**
     * @var array
     * array of Field
     */
    private $fields;

    /**
     * @var array
     */
    private $errors;

    /**
     * @var Language
     */
    private $language;

    /**
     * Validation constructor.
     * @param Language $language
     */
    public function __construct(Language $language)
    {
        $this->language = $language;
        $this->fields = [];
        $this->errors = [];
    }

    /**
     * @param \PluginSimpleValidate\Contracts\Field $field
     * @return $this
     */
    public function addField(\PluginSimpleValidate\Contracts\Field $field)
    {
        $this->fields[$field->getName()] = $field;
        return $this;
    }

    /**
     * @param bool $break_when_error
     * @return bool
     */
    public function run($break_when_error = false) : bool
    {
        /** @var Field $field */
        foreach ($this->fields as $field) {
            if (!$field->isValid($this->language)) {
                $this->errors[$field->getName()] = $field->getError();
                if ($break_when_error) {
                    break;
                }
            }
        }

        return empty($this->errors) ? true : false;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param string $fieldName
     * @return array|Field|null
     */
    public function getFields(string $fieldName = '')
    {
        if (empty($fieldName)) {
            return $this->fields;
        }

        return isset($this->fields[$fieldName]) ? $this->fields[$fieldName] : null;
    }
}