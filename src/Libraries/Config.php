<?php

namespace PluginSimpleValidate\Libraries;

class Config{

    private $language_config;

    /** @var self */
    private static $instance;


    private function __construct()
    {
        $this->language_config = include_once implode(DIRECTORY_SEPARATOR, [dirname(__FILE__), '..', 'config', 'language.php']);
    }

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new Config();
        }

        return self::$instance;
    }

    public function isValidLanguage($lang){
        if(!in_array($lang, $this->language_config['avaliable_langs'])){
            throw new \Exception('invalid language, choose one of the avaliable languages : %s', print_r($this->language_config['avaliable_langs'], true));
        }

        return true;
    }

    public function getAvaliableLanguages(){
        return $this->language_config['avaliable_langs'];
    }


    public function getDefaultLanguages(){
        return $this->language_config['default_language'];
    }
}