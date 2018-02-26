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
    protected $validationMethod;

    /**
     * @var string
     */
    protected $langKey;

    /**
     * @var bool
     */
    protected $status;

    /**
     * @var string
     */
    protected $error;

    /**
     * @var array
     */
    protected $args;

    /**
     * Rule constructor.
     * @param string $validationMethod
     * @param string $langKey
     * @param array $args
     */
    public function __construct(string $validationMethod, string $langKey, $args = [])
    {
        $this->validationMethod = $validationMethod;
        $this->langKey = $langKey;
        $this->status = false;
        $this->args = $args;
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
                $value,
                $this->args
            ]
        )) {
            $this->status = false;

            $this->error = vsprintf(
                $language->getTranslation(
                    $this->getLangKey()
                ),
                $this->args
            );

        } else {
            $this->status = true;
        }

        return $this->status;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }
}