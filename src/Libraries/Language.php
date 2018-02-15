<?php

namespace PluginSimpleValidate\Libraries;

class Language
{
    /**
     * @var string
     */
    private $lang;

    /**
     * @var array
     */
    private $translation;

    /**
     * Language constructor.
     * @param string $lang
     */
    public function __construct(string $lang)
    {
        $this->lang = $lang;
        $this->translation = include implode(DIRECTORY_SEPARATOR, [dirname(__FILE__), '..', 'lang', $this->lang . '.php']);
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @param string $key
     * @return array|string
     */
    public function getTranslation(string $key = '')
    {
        if (empty($key)) {
            return $this->translation;
        }

        return isset($this->translation[$key]) ? $this->translation[$key] : $key;
    }
}