<?php
namespace tests\PluginSimpleValidate\libraries\validate;

use tests\PluginSimpleValidate\BaseTest;
use PluginSimpleValidate\Validation;
use PluginSimpleValidate\Field;


class ValidationTest extends BaseTest {

    public function setUp(){
        parent::setUp();
    }

    public function test_addFields(){
        $validation = new Validation();
        $validation->addField(new Field('field1', 'value1', 'label1'))->addField(new Field('field2', 'value2', 'label2'));
        $this->assertCount(2, $validation->getFields());
        $this->assertContainsOnly('PluginSimpleValidate\Field', $validation->getFields());
        $this->assertEquals([
            'field1' => new Field('field1', 'value1', 'label1'),
            'field2' => new Field('field2', 'value2', 'label2')
        ], $validation->getFields());
    }

    public function test_addFields_reinitialize_true(){
        $validation = new Validation();
        $validation->addField(new Field('field1', 'value1', 'label1'))->addField(new Field('field2', 'value2', 'label2'), true);
        $this->assertCount(1, $validation->getFields());
        $this->assertContainsOnly('PluginSimpleValidate\Field', $validation->getFields());
        $this->assertEquals([
            'field2' => new Field('field2', 'value2', 'label2')
        ], $validation->getFields());
    }

    public function test_run_break_when_error_false(){
        $validation = new Validation();
        $validation->addField((new Field('email', 'xxx.com', 'email address'))->is_required()->is_valid_email())
            ->addField((new Field('password', 'abc', 'password'))->is_required()->min(5))
            ->addField((new Field('confirm password', 'abx', 'password confirmation'))->is_required()->is_matches('abc'));

        $this->assertFalse($validation->run());
        $this->assertCount(3, $validation->getFields());
        $this->assertCount(3, $validation->getErrors());

        $this->assertEquals([
            'email' => 'The email address field must be a valid email address.',
            'password' => 'The password field length must be at least 5.',
            'confirm password' => 'The password confirmation field is not matches with "abc".',
        ], $validation->getErrors());
    }

    public function test_run_break_when_error_true(){
        $validation = new Validation();

        $validation->addField((new Field('email', 'xxx.com'))->is_required('required')->is_valid_email('must be a valid email'))
            ->addField((new Field('password', 'abc'))->is_required('required')->min(5, "min length 5"))
            ->addField((new Field('confirm password', 'abx'))->is_required('required')->is_matches('abc', 'confirm password must match with password'));


        $this->assertFalse($validation->run(true));
        $this->assertCount(3, $validation->getFields());
        $this->assertCount(1, $validation->getErrors());
        $this->assertEquals([
            'email' => 'must be a valid email'
        ], $validation->getErrors());
    }

}
