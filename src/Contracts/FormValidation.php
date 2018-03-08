<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 2/15/18
 * Time: 6:52 PM
 */

namespace PluginSimpleValidate\Contracts;


use Zend\Diactoros\ServerRequest;

interface FormValidation extends Validation
{
    /**
     * @param ServerRequest $serverRequest
     * @param array $rules
     */
    public function createFromPost(ServerRequest $serverRequest, $rules = []);
}