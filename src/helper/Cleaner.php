<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 4:18 PM
 */

namespace PluginSimpleValidate\helper\Cleaner;

if (! function_exists('trim_doubled_space')) {
    function trim_doubled_space($value)
    {
        return preg_replace('/^\s+|\s+$/', '', $value);
    }
}