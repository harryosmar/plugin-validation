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
     * @param array $translation
     * provide parameter $translation for your own custom translation array
     */
    public function __construct(string $lang, array $translation = [])
    {
        $this->lang = $lang;

        if (!empty($translation)) {
            $this->translation = $translation;
        } else {
            $this->translation = include implode(DIRECTORY_SEPARATOR, [dirname(__FILE__), '..', 'lang', $this->lang . '.php']);
        }
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
     * @return string
     */
    public function getTranslation(string $key)
    {
        return isset($this->translation[$key]) ? $this->translation[$key] : $key;
    }
}