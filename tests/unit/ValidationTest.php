<?php

namespace PluginSimpleValidate\Tests\unit;

use PluginSimpleValidate\Field;
use PluginSimpleValidate\Libraries\Language;
use PluginSimpleValidate\Validation;

class ValidationTest extends Base
{

    /**
     * @var Language
     */
    private $language;

    /**
     * @var Validation
     */
    private $validation;

    public function setUp()
    {
        parent::setUp();
        $this->language = new Language('id');
        $this->validation = new Validation($this->language);
    }

    public function test_run()
    {
        $this->validation->addField((new Field('email', ''))->required()->validEmail())
            ->addField((new Field('password', ''))->required());

        $this->assertFalse($this->validation->run());

        $this->assertEquals(array (
                'email' =>
                    array (
                        'harus diisi.',
                        'harus berisi alamat email yang valid.',
                    ),
                'password' =>
                    array (
                        'harus diisi.',
                    ),
            ),
            $this->validation->getErrors()
        );
    }
}
