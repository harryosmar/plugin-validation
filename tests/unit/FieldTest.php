<?php

namespace PluginSimpleValidate\Tests\unit;

use PluginSimpleValidate\Field;
use PluginSimpleValidate\Libraries\Language;

class FieldTest extends Base
{
    /**
     * @var Language
     */
    private $language;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->language = new Language('id');
    }

    public function test_construct()
    {
        $field = new Field('name', 'value');
        $this->assertEquals('name', $field->getName());
        $this->assertEquals('value', $field->getValue());
    }

    public function test_is_required(){
        $field = (new Field('field', ''))->required();
        $this->assertFalse($field->isValid($this->language));
        $this->assertEquals(['harus diisi.'], $field->getError());
    }

    public function test_field_multi_rules(){
        $field = (new Field('email', ''))->required()->validEmail();
        $this->assertFalse($field->isValid($this->language));
        $this->assertEquals(['harus diisi.', 'harus berisi alamat email yang valid.'], $field->getError());
    }
}
