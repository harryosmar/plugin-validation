<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 5:05 PM
 */

namespace PluginSimpleValidate;

class Rule
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

    public function __construct(string $validationMethod, string $langKey)
    {
        $this->validationMethod = $validationMethod;
        $this->langKey = $langKey;
        $this->status = false;
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
    public function isStatus(): bool
    {
        return $this->status;
    }
}