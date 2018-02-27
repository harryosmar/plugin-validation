<?php

namespace PluginSimpleValidate\Tests\unit\MultiValue;


use PluginSimpleValidate\MultiValues\Field;
use PluginSimpleValidate\Tests\unit\Base;

class FieldTest extends Base
{
    public function test_construct()
    {
        $field = new Field('name');
        $this->assertEquals('name', $field->getName());
    }

    public function test_is_true()
    {
        $firstname = 'harry';
        $lastname = '';
        $field = new Field('name');
        $field->isTrue($firstname !== '', 'firstname required')
            ->isTrue($lastname !== '', 'lastname required')
            ->isTrue(strlen($firstname . ' ' . $lastname) > 10, 'fullname length must be greater than 10');

        $this->assertFalse($field->isValid($this->language));
        $this->assertEquals([
            'lastname required',
            'fullname length must be greater than 10'
        ], $field->getErrors());

    }

    public function test_multi_rules()
    {
        $email = '';

        $field = (new Field('email'))
            ->required($email)
            ->validEmail($email)
            ->lengthBetweenOrEqual($email, 5, 10);
        $this->assertFalse($field->isValid($this->language));
        $this->assertEquals([
            'field is required',
            'field must be a valid email address',
            'field length must be greater or equal than 5 or less or equal than 10',
        ], $field->getErrors());
    }
}
