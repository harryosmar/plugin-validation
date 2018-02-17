<?php

namespace PluginSimpleValidate\Tests\unit;

use PluginSimpleValidate\Field;

class FieldTest extends Base
{
    public function test_construct()
    {
        $field = new Field('name', 'value');
        $this->assertEquals('name', $field->getName());
        $this->assertEquals('value', $field->getValue());
    }

    public function test_is_required(){
        $field = (new Field('username', ''))->required();
        $this->assertFalse($field->isValid($this->language));
        $this->assertEquals(['field is required'], $field->getErrors());
    }

    public function test_is_less_than(){
        $field = (new Field('score', 90.90))->lessThan(90.87);
        $this->assertFalse($field->isValid($this->language));
        $this->assertEquals(['field must be less than 90.87'], $field->getErrors());
    }

    public function test_equal(){
        $field = (new Field('confirm_password', 'newpassword'))->equal('oldpassword');
        $this->assertFalse($field->isValid($this->language));
        $this->assertEquals(['field must be equal with "oldpassword"'], $field->getErrors());
    }

    public function test_between(){
        $field = (new Field('grade_b', 86))->between(79, 86);
        $this->assertFalse($field->isValid($this->language));
        $this->assertEquals(['field must be greater than 79 or less than 86'], $field->getErrors());
    }

    public function test_field_multi_rules(){
        $field = (new Field('email', ''))->required()->validEmail();
        $this->assertFalse($field->isValid($this->language));
        $this->assertEquals(['field is required', 'field must be a valid email address'], $field->getErrors());
    }

    public function test_is_true(){
        $field = (new Field('value', 5 < 4))->isTrue('comparison error');
        $this->assertFalse($field->isValid($this->language));
        $this->assertEquals(['comparison error'], $field->getErrors());
    }
}
