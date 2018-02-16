<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 5:05 PM
 */

namespace PluginSimpleValidate;

use PluginSimpleValidate\Libraries\Language;

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

    /**
     * @var bool
     */
    private $status;

    /**
     * @var string
     */
    private $error;

    public function __construct(string $validationMethod, string $langKey)
    {
        $this->validationMethod = $validationMethod;
        $this->langKey = $langKey;
        $this->status = false;
        $this->error = '';
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

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param Language $language
     * @param $value
     * @return bool
     */
    public function isValid(Language $language, $value) : bool
    {
        if (!call_user_func_array(
            '\\PluginSimpleValidate\\helper\\Validate\\' . $this->getValidationMethod(),
            [
                $value
            ]
        )) {
            $this->status = false;

            $this->error = $language->getTranslation(
                $this->getLangKey()
            );
        } else {
            $this->status = true;
        }

        return $this->status;
    }
}