<?php

namespace PluginSimpleValidate\Tests\unit;

use PluginSimpleValidate\Field;
use PluginSimpleValidate\Validation;

class ValidationTest extends Base
{
    public function setUp()
    {
        parent::setUp();
    }

    public function test_run()
    {
        $validation = $this->generateValidationMultiFieldMultiRules();

        $this->assertFalse($validation->run());

        $this->assertEquals(
            [
                'email' => [
                    'field is required',
                    'field must be a valid email address',
                ],
                'password' => [
                    'field is required',
                    'field may only letters and numbers',
                    'field length must be greater than 5',
                ],
            ],
            $validation->getErrors()
        );
    }

    public function test_run_contain_multi_field_multi_value()
    {
        $validation = $this->generateValidationMultiFieldMultiRules();
        $name = '';
        $validation->addField((new \PluginSimpleValidate\MultiValues\Field('name'))
            ->isTrue($name !== '', 'required')
            ->isTrue(strlen($name) > 6, 'length must be greater than 6'));

        $this->assertFalse($validation->run());

        $this->assertEquals(
            [
                'email' => [
                    'field is required',
                    'field must be a valid email address',
                ],
                'password' => [
                    'field is required',
                    'field may only letters and numbers',
                    'field length must be greater than 5',
                ],
                'name' => [
                    'required',
                    'length must be greater than 6'
                ]
            ],
            $validation->getErrors()
        );
    }

    public function test_run_name_validation()
    {
        $firstNameField = (new Field('firstname', ''))->required()->lengthGreaterOrEqualThan(4);
        $lastNameField = (new Field('lastname', ''))->required()->lengthGreaterOrEqualThan(4);
        $fullNameField = (new Field(
            'fullname',
            $firstNameField->getValue() . ' ' . $lastNameField->getValue()
        ))->lengthGreaterOrEqualThan(10);

        $validation = new Validation($this->language);

        $validation->addField($firstNameField)->addField($lastNameField)->addField($fullNameField);

        $this->assertFalse($validation->run());

        $this->assertEquals(
            [
                'firstname' => [
                    'field is required',
                    'field length must be greater or equal than 4'
                ],
                'lastname' => [
                    'field is required',
                    'field length must be greater or equal than 4'
                ],
                'fullname' => [
                    'field length must be greater or equal than 10',
                ],
            ],
            $validation->getErrors()
        );
    }

    public function test_run_with_error_break()
    {
        $validation = $this->generateValidationMultiFieldMultiRules();

        $this->assertFalse($validation->run(true));

        $this->assertEquals(
            [
                'email' => [
                    'field is required',
                    'field must be a valid email address',
                ],
            ],
            $validation->getErrors()
        );
    }

    private function generateValidationMultiFieldMultiRules()
    {
        $validation = new Validation($this->language);

        return $validation->addField((new Field('email', ''))
            ->required()
            ->validEmail()
        )->addField((new Field('password', ''))
            ->required()
            ->isAlphaOrNumeric()
            ->lengthGreaterThan(5)
        );
    }
}
