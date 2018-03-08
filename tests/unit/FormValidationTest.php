<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/8/18
 * Time: 4:37 PM
 */

namespace PluginSimpleValidate\Tests\unit;

use PluginSimpleValidate\FormValidation;
use Zend\Diactoros\ServerRequest;

class FormValidationTest extends Base
{
    public function test_createFromPost()
    {
        $validation = new FormValidation($this->language);
        $validation->createFromPost(
            $this->create_fake_request(),
            $this->create_rules()
        );

        $validation->run();

        if (!$validation->getStatus()) {
            $this->assertEquals([
                    'email' => [
                        'field must be a valid email address',
                    ],
                    'grant_type' => [
                        'field is required',
                    ],
                    'client_id' => [
                        'field is required',
                        'field must be a number',
                    ],
                    'client_secret' => [
                        'field is required',
                        'field may only letters and numbers',
                    ],
                    'redirect_uri' => [
                        'field is required',
                    ],
                    'username' => [
                        'field is required',
                        'field length must be greater or equal than 5 or less or equal than 10',
                    ],
                    'password' => [
                        'field is required',
                        'field length must be greater than 5',
                    ],
                    'scope' => [
                        'field is required',
                    ],
                ],
                $validation->getErrors()
            );
        }
    }

    /**
     * @return ServerRequest
     */
    private function create_fake_request()
    {
        return new ServerRequest(
            [],
            [],
            null,
            'POST',
            'php://input',
            [],
            [],
            [],
            [
                'email' => 'abc',
                'grant_type' => '',
                'client_id' => '',
                'client_secret' => '',
                'redirect_uri' => '',
                'username' => '',
                'password' => '',
                'scope' => '',
            ]
        );

    }

    /**
     * @return array
     */
    private function create_rules()
    {
        return [
            'email' => 'required,validEmail',
            'grant_type' => 'required',
            'client_id' => 'required,isNumber',
            'client_secret' => 'required,isAlphaOrNumeric',
            'redirect_uri' => 'required',
            'username' => 'required,lengthBetweenOrEqual:5:10',
            'password' => 'required,lengthGreaterThan:5',
            'scope' => 'required',
        ];
    }
}