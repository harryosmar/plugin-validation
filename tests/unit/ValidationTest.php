<?php

namespace PluginSimpleValidate\Tests\unit;

use PluginSimpleValidate\Field;
use PluginSimpleValidate\RuleMapping;
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

        return $validation->addField((new Field(RuleMapping::getInstance(), 'email', ''))
            ->required()
            ->validEmail()
        )->addField((new Field(RuleMapping::getInstance(), 'password', ''))
            ->required()
            ->isAlphaOrNumeric()
            ->lengthGreaterThan(5)
        );
    }
}
