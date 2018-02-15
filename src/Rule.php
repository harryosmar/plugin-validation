<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 5:05 PM
 */

namespace PluginSimpleValidate;

class Rule implements \PluginSimpleValidate\Contracts\Rule
{
    /**
     * @var string
     */
    private $validationMethod;

    /**
     * @var string
     */
    private $langKey;

    public function __construct(string $validationMethod, string $langKey)
    {
        $this->validationMethod = $validationMethod;
        $this->langKey = $langKey;
    }

    /**
     * @return string
     */
    public function getValidationMethod(): string
    {
        return $this->validationMethod;
    }

    /**
     * @return string
     */
    public function getLangKey(): string
    {
        return $this->langKey;
    }
}