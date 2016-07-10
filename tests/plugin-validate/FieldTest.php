<?php
namespace tests\PluginSimpleValidate;

use PluginSimpleValidate\Field;

class FieldTest extends BaseTest {
    public function setUp(){
        parent::setUp();
    }

    public function test___construct(){
        $field = new Field('label', 'value');
        $this->assertEquals('label', $field->getLabel());
        $this->assertEquals('value', $field->getValue());
        $this->assertEquals(null, $field->getErrorMessage());
        $this->assertEquals(true, $field->isValid());
    }

    public function test_is_true_where_parameter_condition_is_true(){
        $field = new Field('label', 'value');
        $this->assertNull($field->is_true(true, 'error message')->getErrorMessage());
    }

    public function test_is_true_where_parameter_condition_is_false(){
        $field = new Field('label', 'value');
        $this->assertEquals('error message', $field->is_true(false, 'error message')->getErrorMessage());
    }

    public function test_is_required_false(){
        $field = new Field('label', '   ');
        $this->assertEquals('The label field is required.', $field->is_required()->getErrorMessage());
    }

    public function test_is_required_true(){
        $field = new Field('label', 'value');
        $this->assertNull($field->is_required()->getErrorMessage());
    }

    public function test_is_matches_false(){
        $field = new Field('label', 'value1');
        $this->assertEquals('The label field is not matches with "value2".', $field->is_matches('value2')->getErrorMessage());
    }

    public function test_is_matches_true(){
        $field = new Field('label', 'value');
        $this->assertNull($field->is_matches('value')->getErrorMessage());
    }

    public function test_is_numeric_false(){
        $field = new Field('label', 'value');
        $this->assertEquals("The label field must be a number.", $field->is_numeric()->getErrorMessage());
    }

    public function test_is_numeric_true(){
        $field = new Field('label', 1);
        $this->assertNull($field->is_numeric()->getErrorMessage());
    }

    public function test_is_valid_email_false(){
        $field = new Field('label', 'value');
        $this->assertEquals("The label field must be a valid email address.", $field->is_valid_email()->getErrorMessage());
    }

    public function test_is_valid_email_true(){
        $field = new Field('label', 'harry@olx.co.id');
        $this->assertNull($field->is_valid_email()->getErrorMessage());
    }

    public function test_is_alpha_false(){
        $field = new Field('label', 'abcd1234');
        $this->assertEquals("The label field may only contain letters.", $field->is_alpha()->getErrorMessage());
    }

    public function test_is_alpha_true(){
        $field = new Field('label', 'abcdefgh');
        $this->assertNull($field->is_alpha()->getErrorMessage());
    }

    public function test_is_alpha_numeric_false(){
        $field = new Field('label', 'abcdefgh?#');
        $this->assertEquals("The label field may only letters and numbers.", $field->is_alpha_numeric()->getErrorMessage());
    }

    public function test_is_alpha_numeric_true(){
        $field = new Field('label', 'abcd1234');
        $this->assertNull($field->is_alpha_numeric()->getErrorMessage());
    }

    public function test_is_decimal_false(){
        $field = new Field('label', 3);
        $this->assertEquals("The label field may only contain decimal numbers.", $field->is_decimal()->getErrorMessage());
    }

    public function test_is_decimal_true(){
        $field = new Field('label', 10.5);
        $this->assertNull($field->is_decimal()->getErrorMessage());
    }

    public function test_is_integer_false(){
        $field = new Field('label', 3.5);
        $this->assertEquals("The label field must be an integer.", $field->is_integer()->getErrorMessage());
    }

    public function test_is_integer_true(){
        $field = new Field('label', +10);
        $this->assertNull($field->is_integer()->getErrorMessage());
    }

    public function test_is_natural_false(){
        $field = new Field('label', -1);
        $this->assertEquals('The label field may only contain positive numbers.', $field->is_natural()->getErrorMessage());
    }

    public function test_is_natural_true(){
        $field = new Field('label', 0);
        $this->assertNull($field->is_natural()->getErrorMessage());
    }

    public function test_is_natural_no_zero_false(){
        $field = new Field('label', 0);
        $this->assertEquals('The label field may only contain positive numbers greater than zero.', $field->is_natural_no_zero()->getErrorMessage());
    }

    public function test_is_natural_no_zero_true(){
        $field = new Field('label', 1);
        $this->assertNull($field->is_natural_no_zero()->getErrorMessage());
    }

    public function test_min_string_length_false(){
        $field = new Field('label', 'a');
        $this->assertEquals('The label field length must be at least 2.', $field->min(2)->getErrorMessage());
    }

    public function test_min_string_length_true(){
        $field = new Field('label', 'abc');
        $this->assertNull($field->min(2)->getErrorMessage());
    }

    public function test_min_number_false(){
        $field = new Field('label', 1);
        $this->assertEquals('The label field must be at least 2.', $field->is_integer()->min(2)->getErrorMessage());
    }

    public function test_min_number_true(){
        $field = new Field('label', 2);
        $this->assertNull($field->is_integer()->min(2)->getErrorMessage());
    }

    public function test_min_array_false(){
        $field = new Field('label', [1]);
        $this->assertEquals('The label field length must be at least 2.', $field->min(2)->getErrorMessage());
    }

    public function test_min_array_true(){
        $field = new Field('label', [1,2]);
        $this->assertNull($field->min(2)->getErrorMessage());
    }

    public function test_max_string_length_false(){
        $field = new Field('label', 'abc');
        $this->assertEquals('The label field length may not be greater than 2.', $field->max(2)->getErrorMessage());
    }

    public function test_max_string_length_true(){
        $field = new Field('label', 'ab');
        $this->assertNull($field->max(2)->getErrorMessage());
    }

    public function test_max_number_false(){
        $field = new Field('label', 3);
        $this->assertEquals('The label field may not be greater than 2.', $field->is_integer()->max(2)->getErrorMessage());
    }

    public function test_max_number_true(){
        $field = new Field('label', 2);
        $this->assertNull($field->is_integer()->max(2)->getErrorMessage());
    }

    public function test_max_array_false(){
        $field = new Field('label', [1,2,3]);
        $this->assertEquals('The label field length may not be greater than 2.', $field->max(2)->getErrorMessage());
    }

    public function test_max_array_true(){
        $field = new Field('label', [1,2]);
        $this->assertNull($field->max(2)->getErrorMessage());
    }

    public function test_exact_length_false(){
        $field = new Field('label', 'abc');
        $this->assertEquals("The label field length must be exactly 2.", $field->exact_length(2)->getErrorMessage());
    }

    public function test_exact_length_true(){
        $field = new Field('label', 'ab');
        $this->assertNull($field->exact_length(2)->getErrorMessage());
    }

    public function test_check_error_in_multiple_validation(){
        $field = new Field('email', 'abcd', 'email address');
        $field->is_required()->min(5)->is_valid_email();
        $this->assertEquals('The email address field length must be at least 5.', $field->getErrorMessage());
    }
}
