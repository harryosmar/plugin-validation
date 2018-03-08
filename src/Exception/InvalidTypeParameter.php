<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/17/18
 * Time: 10:09 AM
 */

namespace PluginSimpleValidate\Exception;

use Exception;
use Throwable;

class InvalidTypeParameter extends Exception
{
    public function __construct($message = "Invalid parameter type", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}