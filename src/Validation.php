<?php

namespace PluginSimpleValidate;

use PluginSimpleValidate\Libraries\Config;

class Validation
{

    private $fields = [];

    private $errors = [];

    public function __construct($lang = null)
    {
        $lang = $lang === null ? Config::getInstance()->getDefaultLanguages() : $lang;
        if(Config::getInstance()->isValidLanguage($lang)){
            $this->lang = $lang;
        }
    }

    /**
     * @param Field $field
     * @param bool $reinitialize
     * @return $this
     */
    public function addField(Field $field, $reinitialize = false){
        if($reinitialize === true){
            $this->fields = [];
        }

        $field->setLanguage($this->lang);
        $this->fields[$field->getLabel()] = $field;
        return $this;
    }

    /**
     * @param bool $break_when_error
     * @return bool
     */
    public function run($break_when_error = false){
        /** @var Field $field */
        foreach($this->fields as $field){
            if(!$field->isValid()){
                $this->errors[$field->getLabel()] = $field->getErrorMessage();
                if($break_when_error){
                    break;
                }
            }
        }

        return empty($this->errors) ? true : false;
    }


    public function getErrors(){
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

}