<?php
namespace tests\PluginSimpleValidate;

use PluginSimpleValidate\Field;

class FieldTest extends BaseTest {
    public function setUp(){
        parent::setUp();
    }

    public function test___construct(){
        $field = new Field('field', 'value');
        $this->assertEquals('field', $field->getLabel());
        $this->assertEquals('value', $field->getValue());
        $this->assertEquals(null, $field->getErrorMessage());
        $this->assertEquals(true, $field->isValid());
    }

    public function test_is_true_where_value_is_boolean_true(){
        $field = new Field('field', true);
        $this->assertTrue($field->is_true('error message')->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_is_true_where_value_is_boolean_false(){
        $field = new Field('field', false);
        $this->assertFalse($field->is_true('error message')->runValidation());
        $this->assertEquals('error message', $field->getErrorMessage());
    }

    public function test_is_required_true(){
        $field = new Field('field', 'value');
        $this->assertTrue($field->is_required()->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_is_required_false(){
        $field = new Field('field', '   ');
        $this->assertFalse($field->is_required()->runValidation());
        $this->assertEquals('The field field is required.', $field->getErrorMessage());
    }

    public function test_is_required_false_where_used_label(){
        $field = new Field('field', '   ', 'label');
        $this->assertFalse($field->is_required()->runValidation());
        $this->assertEquals('The label field is required.', $field->getErrorMessage());
    }

    public function test_is_required_false_with_parameter_message(){
        $field = new Field('field', '  ');
        $this->assertFalse($field->is_required('This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_is_required_false_where_used_lang_id(){
        $field = new Field('field', '   ');
        $this->assertFalse($field->is_required()->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus diisi.', $field->getErrorMessage());
    }

    public function test_is_numeric_true(){
        $field = new Field('field', 1);
        $this->assertTrue($field->is_numeric()->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_is_numeric_false(){
        $field = new Field('field', 'value');
        $this->assertFalse($field->is_numeric()->runValidation());
        $this->assertEquals("The field field must be a number.", $field->getErrorMessage());
    }

    public function test_is_numeric_false_where_used_label(){
        $field = new Field('field', 'value', 'label');
        $this->assertFalse($field->is_numeric()->runValidation());
        $this->assertEquals("The label field must be a number.", $field->getErrorMessage());
    }

    public function test_is_numeric_false_with_parameter_message(){
        $field = new Field('field', 'value');
        $this->assertFalse($field->is_numeric('This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_is_numeric_false_where_used_lang_id(){
        $field = new Field('field', 'value');
        $this->assertFalse($field->is_numeric()->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus berisi angka.', $field->getErrorMessage());
    }

    public function test_is_valid_email_true(){
        $field = new Field('field', 'harry@olx.co.id');
        $this->assertTrue($field->is_valid_email()->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_is_valid_email_false(){
        $field = new Field('field', 'value');
        $this->assertFalse($field->is_valid_email()->runValidation());
        $this->assertEquals('The field field must be a valid email address.', $field->getErrorMessage());
    }

    public function test_is_valid_email_false_where_used_label(){
        $field = new Field('field', 'value', 'label');
        $this->assertFalse($field->is_valid_email()->runValidation());
        $this->assertEquals('The label field must be a valid email address.', $field->getErrorMessage());
    }

    public function test_is_valid_email_false_with_parameter_message(){
        $field = new Field('field', 'value');
        $this->assertFalse($field->is_valid_email('This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_is_valid_email_false_where_used_lang_id(){
        $field = new Field('field', 'value');
        $this->assertFalse($field->is_valid_email()->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus berisi alamat email yang valid.', $field->getErrorMessage());
    }

    public function test_is_alpha_true(){
        $field = new Field('field', 'abcdefgh');
        $this->assertTrue($field->is_alpha()->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_is_alpha_false(){
        $field = new Field('field', 'abcd1234');
        $this->assertFalse($field->is_alpha()->runValidation());
        $this->assertEquals('The field field may only contain letters.', $field->getErrorMessage());
    }

    public function test_is_alpha_false_where_used_label(){
        $field = new Field('field', 'abcd1234', 'label');
        $this->assertFalse($field->is_alpha()->runValidation());
        $this->assertEquals('The label field may only contain letters.', $field->getErrorMessage());
    }

    public function test_is_alpha_false_with_parameter_message(){
        $field = new Field('field', 'abcd1234');
        $this->assertFalse($field->is_alpha('This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_is_alpha_false_where_used_lang_id(){
        $field = new Field('field', 'abcd1234');
        $this->assertFalse($field->is_alpha()->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field hanya dapat berisi karakter abjad.', $field->getErrorMessage());
    }

    public function test_is_alpha_numeric_true(){
        $field = new Field('field', 'abcdefgh');
        $this->assertTrue($field->is_alpha_numeric()->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_is_alpha_numeric_false(){
        $field = new Field('field', 'abcd1234!=');
        $this->assertFalse($field->is_alpha_numeric()->runValidation());
        $this->assertEquals('The field field may only letters and numbers.', $field->getErrorMessage());
    }

    public function test_is_alpha_numeric_false_where_used_label(){
        $field = new Field('field', 'abcd1234!=', 'label');
        $this->assertFalse($field->is_alpha_numeric()->runValidation());
        $this->assertEquals('The label field may only letters and numbers.', $field->getErrorMessage());
    }

    public function test_is_alpha_numeric_false_with_parameter_message(){
        $field = new Field('field', 'abcd1234!=');
        $this->assertFalse($field->is_alpha_numeric('This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_is_alpha_numeric_false_where_used_lang_id(){
        $field = new Field('field', 'abcd1234!=');
        $this->assertFalse($field->is_alpha_numeric()->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field hanya dapat berisi karakter alpha-numeric.', $field->getErrorMessage());
    }

    public function test_is_decimal_true(){
        $field = new Field('field', 10.05);
        $this->assertTrue($field->is_decimal()->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_is_decimal_false(){
        $field = new Field('field', 10);
        $this->assertFalse($field->is_decimal()->runValidation());
        $this->assertEquals('The field field may only contain decimal numbers.', $field->getErrorMessage());
    }

    public function test_is_decimal_false_where_used_label(){
        $field = new Field('field', 10, 'label');
        $this->assertFalse($field->is_decimal()->runValidation());
        $this->assertEquals('The label field may only contain decimal numbers.', $field->getErrorMessage());
    }

    public function test_is_decimal_false_with_parameter_message(){
        $field = new Field('field', 10);
        $this->assertFalse($field->is_decimal('This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_is_decimal_false_where_used_lang_id(){
        $field = new Field('field', 10);
        $this->assertFalse($field->is_decimal()->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus berisi angka desimal.', $field->getErrorMessage());
    }

    public function test_is_integer_true(){
        $field = new Field('field', 10);
        $this->assertTrue($field->is_integer()->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_is_integer_false(){
        $field = new Field('field', 10.50);
        $this->assertFalse($field->is_integer()->runValidation());
        $this->assertEquals('The field field must be an integer.', $field->getErrorMessage());
    }

    public function test_is_integer_false_where_used_label(){
        $field = new Field('field', 10.50, 'label');
        $this->assertFalse($field->is_integer()->runValidation());
        $this->assertEquals('The label field must be an integer.', $field->getErrorMessage());
    }

    public function test_is_integer_false_with_parameter_message(){
        $field = new Field('field', 10.50);
        $this->assertFalse($field->is_integer('This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_is_integer_false_where_used_lang_id(){
        $field = new Field('field', 10.50);
        $this->assertFalse($field->is_integer()->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus berisi sebuah integer.', $field->getErrorMessage());
    }

    public function test_is_natural_true(){
        $field = new Field('field', 10);
        $this->assertTrue($field->is_natural()->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_is_natural_false(){
        $field = new Field('field', -1);
        $this->assertFalse($field->is_natural()->runValidation());
        $this->assertEquals('The field field may only contain positive numbers.', $field->getErrorMessage());
    }

    public function test_is_natural_false_where_used_label(){
        $field = new Field('field', -1, 'label');
        $this->assertFalse($field->is_natural()->runValidation());
        $this->assertEquals('The label field may only contain positive numbers.', $field->getErrorMessage());
    }

    public function test_is_natural_false_with_parameter_message(){
        $field = new Field('field', -1);
        $this->assertFalse($field->is_natural('This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_is_natural_false_where_used_lang_id(){
        $field = new Field('field', -1);
        $this->assertFalse($field->is_natural()->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus berisi hanya angka positif.', $field->getErrorMessage());
    }

    public function test_is_natural_no_zero_true(){
        $field = new Field('field', 10);
        $this->assertTrue($field->is_natural_no_zero()->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_is_natural_no_zero_false(){
        $field = new Field('field', 0);
        $this->assertFalse($field->is_natural_no_zero()->runValidation());
        $this->assertEquals('The field field may only contain positive numbers greater than zero.', $field->getErrorMessage());
    }

    public function test_is_natural_no_zero_false_where_used_label(){
        $field = new Field('field', 0, 'label');
        $this->assertFalse($field->is_natural_no_zero()->runValidation());
        $this->assertEquals('The label field may only contain positive numbers greater than zero.', $field->getErrorMessage());
    }

    public function test_is_natural_no_zero_false_with_parameter_message(){
        $field = new Field('field', 0);
        $this->assertFalse($field->is_natural_no_zero('This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_is_natural_no_zero_false_where_used_lang_id(){
        $field = new Field('field', 0);
        $this->assertFalse($field->is_natural_no_zero()->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus berisi angka lebih besar dari nol.', $field->getErrorMessage());
    }

    public function test_min_true_where_value_is_number(){
        $field = new Field('field', 6);
        $this->assertTrue($field->is_numeric()->min(5)->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_min_false_where_value_is_number(){
        $field = new Field('field', 4);
        $this->assertFalse($field->is_numeric()->min(5)->runValidation());
        $this->assertEquals('The field field must be at least 5.', $field->getErrorMessage());
    }

    public function test_min_false_where_value_is_number_and_used_label(){
        $field = new Field('field', 4, 'label');
        $this->assertFalse($field->is_numeric()->min(5)->runValidation());
        $this->assertEquals('The label field must be at least 5.', $field->getErrorMessage());
    }

    public function test_min_false_where_value_is_number_with_parameter_message(){
        $field = new Field('field', 4);
        $this->assertFalse($field->is_numeric()->min(5, 'This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_min_false_where_value_is_number_and_used_lang_id(){
        $field = new Field('field', 4);
        $this->assertFalse($field->is_numeric()->min(5)->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus memiliki nilai minimal 5.', $field->getErrorMessage());
    }

    public function test_min_true_where_value_is_string(){
        $field = new Field('field', 'abcde');
        $this->assertTrue($field->min(5)->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_min_false_where_value_is_string(){
        $field = new Field('field', 'abc');
        $this->assertFalse($field->min(5)->runValidation());
        $this->assertEquals('The field field length must be at least 5.', $field->getErrorMessage());
    }

    public function test_min_false_where_value_is_string_and_used_label(){
        $field = new Field('field', 'abc', 'label');
        $this->assertFalse($field->min(5)->runValidation());
        $this->assertEquals('The label field length must be at least 5.', $field->getErrorMessage());
    }

    public function test_min_false_where_value_is_string_with_parameter_message(){
        $field = new Field('field', 'abc');
        $this->assertFalse($field->min(5, 'This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_min_false_where_value_is_string_and_used_lang_id(){
        $field = new Field('field', 'abc');
        $this->assertFalse($field->min(5)->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus memiliki panjang minimal 5.', $field->getErrorMessage());
    }

    public function test_min_true_where_value_is_array(){
        $field = new Field('field', ['a', 'b', 'c', 'd', 'e']);
        $this->assertTrue($field->min(5)->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_min_false_where_value_is_array(){
        $field = new Field('field', ['a', 'b', 'c']);
        $this->assertFalse($field->min(5)->runValidation());
        $this->assertEquals('The field field length must be at least 5.', $field->getErrorMessage());
    }

    public function test_min_false_where_value_is_array_and_used_label(){
        $field = new Field('field', ['a', 'b', 'c'], 'label');
        $this->assertFalse($field->min(5)->runValidation());
        $this->assertEquals('The label field length must be at least 5.', $field->getErrorMessage());
    }

    public function test_min_false_where_value_is_array_with_parameter_message(){
        $field = new Field('field', ['a', 'b', 'c']);
        $this->assertFalse($field->min(5, 'This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_min_false_where_value_is_array_and_used_lang_id(){
        $field = new Field('field', ['a', 'b', 'c']);
        $this->assertFalse($field->min(5)->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus memiliki jumlah index minimal 5.', $field->getErrorMessage());
    }

    public function test_max_true_where_value_is_number(){
        $field = new Field('field', 5);
        $this->assertTrue($field->is_numeric()->max(5)->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_max_false_where_value_is_number(){
        $field = new Field('field', 6);
        $this->assertFalse($field->is_numeric()->max(5)->runValidation());
        $this->assertEquals('The field field may not be greater than 5.', $field->getErrorMessage());
    }

    public function test_max_false_where_value_is_number_and_used_label(){
        $field = new Field('field', 6, 'label');
        $this->assertFalse($field->is_numeric()->max(5)->runValidation());
        $this->assertEquals('The label field may not be greater than 5.', $field->getErrorMessage());
    }

    public function test_max_false_where_value_is_number_with_parameter_message(){
        $field = new Field('field', 6);
        $this->assertFalse($field->is_numeric()->max(5, 'This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_max_false_where_value_is_number_and_used_lang_id(){
        $field = new Field('field', 6);
        $this->assertFalse($field->is_numeric()->max(5)->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus memiliki nilai maximal 5.', $field->getErrorMessage());
    }

    public function test_max_true_where_value_is_string(){
        $field = new Field('field', 'abcde');
        $this->assertTrue($field->max(5)->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_max_false_where_value_is_string(){
        $field = new Field('field', 'abcdef');
        $this->assertFalse($field->max(5)->runValidation());
        $this->assertEquals('The field field length may not be greater than 5.', $field->getErrorMessage());
    }

    public function test_max_false_where_value_is_string_and_used_label(){
        $field = new Field('field', 'abcdef', 'label');
        $this->assertFalse($field->max(5)->runValidation());
        $this->assertEquals('The label field length may not be greater than 5.', $field->getErrorMessage());
    }

    public function test_max_false_where_value_is_string_with_parameter_message(){
        $field = new Field('field', 'abcdef');
        $this->assertFalse($field->max(5, 'This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_max_false_where_value_is_string_and_used_lang_id(){
        $field = new Field('field', 'abcdef');
        $this->assertFalse($field->max(5)->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus memiliki panjang maximal 5.', $field->getErrorMessage());
    }

    public function test_max_true_where_value_is_array(){
        $field = new Field('field', ['a', 'b', 'c', 'd', 'e']);
        $this->assertTrue($field->max(5)->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_max_false_where_value_is_array(){
        $field = new Field('field', ['a', 'b', 'c', 'd', 'e', 'f']);
        $this->assertFalse($field->max(5)->runValidation());
        $this->assertEquals('The field field length may not be greater than 5.', $field->getErrorMessage());
    }

    public function test_max_false_where_value_is_array_and_used_label(){
        $field = new Field('field', ['a', 'b', 'c', 'd', 'e', 'f'], 'label');
        $this->assertFalse($field->max(5)->runValidation());
        $this->assertEquals('The label field length may not be greater than 5.', $field->getErrorMessage());
    }

    public function test_max_false_where_value_is_array_with_parameter_message(){
        $field = new Field('field', ['a', 'b', 'c', 'd', 'e', 'f']);
        $this->assertFalse($field->max(5, 'This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_max_false_where_value_is_array_and_used_lang_id(){
        $field = new Field('field', ['a', 'b', 'c', 'd', 'e', 'f']);
        $this->assertFalse($field->max(5)->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus memiliki jumlah index maximal 5.', $field->getErrorMessage());
    }

    public function test_exact_length_true_where_value_is_number(){
        $field = new Field('field', 5);
        $this->assertTrue($field->is_numeric()->exact_length(5)->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_exact_length_false_where_value_is_number(){
        $field = new Field('field', 6);
        $this->assertFalse($field->is_numeric()->exact_length(5)->runValidation());
        $this->assertEquals('The field field must be exactly 5.', $field->getErrorMessage());
    }

    public function test_exact_length_false_where_value_is_number_and_used_label(){
        $field = new Field('field', 6, 'label');
        $this->assertFalse($field->is_numeric()->exact_length(5)->runValidation());
        $this->assertEquals('The label field must be exactly 5.', $field->getErrorMessage());
    }

    public function test_exact_length_false_where_value_is_number_with_parameter_message(){
        $field = new Field('field', 6);
        $this->assertFalse($field->is_numeric()->exact_length(5, 'This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_exact_length_false_where_value_is_number_and_used_lang_id(){
        $field = new Field('field', 6);
        $this->assertFalse($field->is_numeric()->exact_length(5)->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus bernilai 5.', $field->getErrorMessage());
    }

    public function test_exact_length_true_where_value_is_string(){
        $field = new Field('field', 'abcde');
        $this->assertTrue($field->exact_length(5)->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_exact_length_false_where_value_is_string(){
        $field = new Field('field', 'abcdef');
        $this->assertFalse($field->exact_length(5)->runValidation());
        $this->assertEquals('The field field length must be exactly 5.', $field->getErrorMessage());
    }

    public function test_exact_length_false_where_value_is_string_and_used_label(){
        $field = new Field('field', 'abcdef', 'label');
        $this->assertFalse($field->exact_length(5)->runValidation());
        $this->assertEquals('The label field length must be exactly 5.', $field->getErrorMessage());
    }

    public function test_exact_length_false_where_value_is_string_with_parameter_message(){
        $field = new Field('field', 'abcdef');
        $this->assertFalse($field->exact_length(5, 'This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_exact_length_false_where_value_is_string_and_used_lang_id(){
        $field = new Field('field', 'abcdef');
        $this->assertFalse($field->exact_length(5)->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus memiliki panjang 5.', $field->getErrorMessage());
    }

    public function test_exact_length_true_where_value_is_array(){
        $field = new Field('field', ['a', 'b', 'c', 'd', 'e']);
        $this->assertTrue($field->exact_length(5)->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_exact_length_false_where_value_is_array(){
        $field = new Field('field', ['a', 'b', 'c', 'd', 'e', 'f']);
        $this->assertFalse($field->exact_length(5)->runValidation());
        $this->assertEquals('The field field length must be exactly 5.', $field->getErrorMessage());
    }

    public function test_exact_length_false_where_value_is_array_and_used_label(){
        $field = new Field('field', ['a', 'b', 'c', 'd', 'e', 'f'], 'label');
        $this->assertFalse($field->exact_length(5)->runValidation());
        $this->assertEquals('The label field length must be exactly 5.', $field->getErrorMessage());
    }

    public function test_exact_length_false_where_value_is_array_with_parameter_message(){
        $field = new Field('field', ['a', 'b', 'c', 'd', 'e', 'f']);
        $this->assertFalse($field->exact_length(5, 'This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_exact_length_false_where_value_is_array_and_used_lang_id(){
        $field = new Field('field', ['a', 'b', 'c', 'd', 'e', 'f']);
        $this->assertFalse($field->exact_length(5)->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus memiliki jumlah index 5.', $field->getErrorMessage());
    }

    public function test_equal_true(){
        $field = new Field('field', 'value');
        $this->assertTrue($field->equal('value')->runValidation());
        $this->assertNull($field->getErrorMessage());
    }

    public function test_equal_false(){
        $field = new Field('field', 'value');
        $this->assertFalse($field->equal('different value')->runValidation());
        $this->assertEquals('The field field must be equal with "different value".', $field->getErrorMessage());
    }

    public function test_equal_false_where_used_label(){
        $field = new Field('field', 'value', 'label');
        $this->assertFalse($field->equal('different value')->runValidation());
        $this->assertEquals('The label field must be equal with "different value".', $field->getErrorMessage());
    }

    public function test_equal_false_with_parameter_message(){
        $field = new Field('field', 'value');
        $this->assertFalse($field->equal('different value', 'This is a message.')->runValidation());
        $this->assertEquals('This is a message.', $field->getErrorMessage());
    }

    public function test_equal_false_where_used_lang_id(){
        $field = new Field('field', 'value');
        $this->assertFalse($field->equal('different value')->setLanguage('id')->runValidation());
        $this->assertEquals('Kolom field harus memiliki nilai yang sama dengan "different value".', $field->getErrorMessage());
    }

    public function test_check_error_in_multiple_validation(){
        $field = new Field('email', 'abcd', 'email address');
        $field->is_required()->min(5)->is_valid_email()->runValidation();
        $this->assertEquals('The email address field length must be at least 5.', $field->getErrorMessage());
    }
}
