<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 4:59 PM
 */

namespace PluginSimpleValidate\Exception;

use Throwable;

class RuleNotExist extends \Exception
{
    public function __construct($message = "Rule does not exist", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}