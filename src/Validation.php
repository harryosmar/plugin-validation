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
     * @var bool
     */
    private $status;

    /**
     * Validation constructor.
     * @param Language $language
     */
    public function __construct(Language $language)
    {
        $this->language = $language;
        $this->fields = [];
        $this->errors = [];
        $this->status = false;
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
        $this->emptyErrors();

        /** @var Field $field */
        foreach ($this->fields as $field) {
            if (!$field->isValid($this->language)) {
                $this->status = false;
                $this->errors[$field->getName()] = $field->getErrors();

                /**
                 * break when there is any field error
                 */
                if ($break_when_error) {
                    break;
                }
            }
        }

        if (empty($this->errors)) {
            $this->status = true;
        }

        return $this->status;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return $this
     */
    protected function emptyErrors()
    {
        $this->errors = [];
        return $this;
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

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }
}