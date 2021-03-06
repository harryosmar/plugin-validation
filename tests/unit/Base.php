<?php

namespace PluginSimpleValidate\Tests\unit;

use PHPUnit\Framework\TestCase;
use PluginSimpleValidate\Libraries\Language;

class Base extends TestCase
{
    const LANGUAGE = 'en';

    /**
     * @var Language
     */
    protected $language;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->language = new Language(self::LANGUAGE);
    }

    protected function tearDown()
    {
        \Mockery::close();
        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}
