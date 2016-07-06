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
        $validation->addField(new Field('label1', 'value1'))->addField(new Field('label2', 'value2'));
        $this->assertCount(2, $validation->getFields());
        $this->assertContainsOnly('PluginApiClient\libraries\validate\Field', $validation->getFields());
        $this->assertEquals([
            'label1' => new Field('label1', 'value1'),
            'label2' => new Field('label2', 'value2')
        ], $validation->getFields());
    }

    public function test_addFields_reinitialize_true(){
        $validation = new Validation();
        $validation->addField(new Field('label1', 'value1'))->addField(new Field('label2', 'value2'), true);
        $this->assertCount(1, $validation->getFields());
        $this->assertContainsOnly('PluginApiClient\libraries\validate\Field', $validation->getFields());
        $this->assertEquals([
            'label2' => new Field('label2', 'value2')
        ], $validation->getFields());
    }

    public function test_run_break_when_error_false(){
        $validation = new Validation();
        $validation->addField((new Field('email', 'xxx.com'))->is_required('required')->is_valid_email('must be a valid email'))
            ->addField((new Field('password', 'abc'))->is_required('required')->min_length(5, "min length 5"))
            ->addField((new Field('confirm password', 'abx'))->is_required('required')->is_matches('abc', 'confirm password must match with password'));


        $this->assertFalse($validation->run());
        $this->assertCount(3, $validation->getFields());
        $this->assertCount(3, $validation->getErrors());
        $this->assertEquals([
            'email' => 'must be a valid email',
            'password' => 'min length 5',
            'confirm password' => 'confirm password must match with password',
        ], $validation->getErrors());
    }

    public function test_run_break_when_error_true(){
        $validation = new Validation();

        $validation->addField((new Field('email', 'xxx.com'))->is_required('required')->is_valid_email('must be a valid email'))
            ->addField((new Field('password', 'abc'))->is_required('required')->min_length(5, "min length 5"))
            ->addField((new Field('confirm password', 'abx'))->is_required('required')->is_matches('abc', 'confirm password must match with password'));


        $this->assertFalse($validation->run(true));
        $this->assertCount(3, $validation->getFields());
        $this->assertCount(1, $validation->getErrors());
        $this->assertEquals([
            'email' => 'must be a valid email'
        ], $validation->getErrors());
    }

}
