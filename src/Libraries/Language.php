<?php

namespace PluginSimpleValidate\Libraries;

class Language{
    /** @var self */
    private static $instance;


    private function __construct()
    {
        $this->langs = [
            'en' => include_once implode(DIRECTORY_SEPARATOR, [dirname(__FILE__), '..', 'lang', 'en', 'validation.php']),
            'id' => include_once implode(DIRECTORY_SEPARATOR, [dirname(__FILE__), '..', 'lang', 'id', 'validation.php'])
        ];
    }

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new Language();
        }

        return self::$instance;
    }

    public function getMessage($key = null, $lang){
        return isset($this->langs[$lang][$key]) ? $this->langs[$lang][$key] : null;
    }

}