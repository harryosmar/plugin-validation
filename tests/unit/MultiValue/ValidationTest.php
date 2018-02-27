<?php

namespace PluginSimpleValidate\Tests\unit\MultiValue;

use PluginSimpleValidate\MultiValues\Field;
use PluginSimpleValidate\Tests\unit\Base;
use PluginSimpleValidate\Validation;

class ValidationTest extends Base
{
    public function setUp()
    {
        parent::setUp();
    }

    public function test_run()
    {
        $validation = new Validation($this->language);

        $firstName = '';
        $lastName = '';

        $validation->addField((new Field('name'))
            ->isTrue($firstName !== '', 'first name required')->isTrue(strlen($firstName) >= 4, 'first name length must be at least 4')
            ->isTrue($lastName !== '', 'last name required')->isTrue(strlen($lastName) >= 4, 'last name length must be at least 4')
            ->isTrue(strlen($firstName . ' ' . $lastName) >= 10, 'full name length must be at least 10'));

        $this->assertFalse($validation->run());

        $this->assertEquals(
            [
                'name' => [
                    'first name required',
                    'first name length must be at least 4',
                    'last name required',
                    'last name length must be at least 4',
                    'full name length must be at least 10'
                ]
            ],
            $validation->getErrors()
        );
    }
}
