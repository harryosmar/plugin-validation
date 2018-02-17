# Validation
Composer plugin for validation purpose, contains set of validation rules.

[![Latest Version](https://img.shields.io/github/release/harryosmar/plugin-validation.svg?style=flat-square)](https://github.com/harryosmar/plugin-validation/releases)
[![Build Status](https://travis-ci.org/harryosmar/plugin-validation.svg?branch=master)](https://travis-ci.org/harryosmar/plugin-validation)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/harryosmar/plugin-validation/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/harryosmar/plugin-validation/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/harryosmar/plugin-validation/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/harryosmar/plugin-validation/?branch=master)

## Features 
- Multi Language, available `en`, `id`
- Validation for multi `fields` and a `field` can have multi `rules`
```
validation > fields > rules
```

## Installation

Add this composer.json file

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:harryosmar/plugin-validation.git"
        }
    ],
    "require": {
        "harryosmar/plugin-validation": "^2.0"
    }
}
```

Then running
```bash
$ composer install
```

## How To Use
1. initialize
```php
<?php
use PluginSimpleValidate\Validation;
use PluginSimpleValidate\Field;
use PluginSimpleValidate\Libraries\Language;

$language = new Language('en');
$validation = new Validation($this->language);
$emailField = (new Field('email', ''))->required()->validEmail();
$passwordField = (new Field('password', ''))->required()->isAlphaOrNumeric()->lengthGreaterThan(5); // add chain of rules to the `field`
```
2. add `fields` to `$validation` object
```php
<?php
/**
 * @var \PluginSimpleValidate\Validation $validation
 * @var \PluginSimpleValidate\Field $emailField
 * @var \PluginSimpleValidate\Field $passwordField
 */
$validation->addField($emailField)->addField($passwordField); // add chain of fields to `$validation` object
```
3. call the `$validation` `run` method
```php
<?php 
/** @var \PluginSimpleValidate\Validation $validation */
$status = $validation->run();
```
4. get the errors message if `$status` is `false`
```php
<?php
/** 
 * @var \PluginSimpleValidate\Validation $validation 
 * @var bool $status
 */
if (!$status) {
    $errors = $validation->getErrors(); // return array of errors message
}
```
`$erros` values
```php
<?php
[
    'email' => [
        'field is required',
        'field must be a valid email address'
    ],
    'password' => [
        'field is required',
        'field may only letters and numbers',
        'field length must be greater than 5'
    ],
];
```
You can `break` the `validation chain` if there is a `field` get an error. In `step 3`, when calling the method `run` of `$validation` object, add parameter `true` to enable `break the chain when error occured`
```php
<?php 
/**
 * @var \PluginSimpleValidate\Validation $validation
 * @var bool $status
 */
$status = $validation->run(true);

if (!$status) {
    $errors = $validation->getErrors(); // return array of errors message
}
```
then `$erros` values will be
```php
<?php
[
    'email' => [
        'field is required',
        'field must be a valid email address'
    ]
];
```

## Available Rules
- `required`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->required();
```
- `numeric`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isNumber();
```
- `email`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->validEmail();
```
- `aplha`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isAlpha();
```
- `alpha or numeric`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isAlphaOrNumeric();
```
- `decimal`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isDecimal();
```
- `natural`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isNatural();
```
- `natural with no zero`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isNaturalNoZero();
```
- `equal`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->equal('old password');
```
- `less than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lessThan(5);
```
- `greater than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->greaterThan(5);
```
- `less or equal than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lessOrEqualThan(5);
```
- `greater or equal than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->greaterOrEqualThan(5);
```
- `between`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->between(5, 10);
```
- `between or equal`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->betweenOrEqual(5, 10);
```
- `length`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->length(5);
```
- `length less than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lengthLessThan(5);
```
- `length greater than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lengthGreaterThan(5);
```
- `length less or equal than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lengthLessOrEqualThan(5);
```
- `length greater or equal than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lengthGreaterOrEqualThan(5);
```
- `length between`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lengthBetween(5, 10);
```
- `length between or equal`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lengthBetweenOrEqual(5, 10);
```
- `is true`
This is used for validation `custom rule logic`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isTrue(someMethod());

function someMethod() : bool 
{
    // add logic here
}
```

### Submitting bugs and feature requests
Harry Osmar Sitohang - <harryosmarsitohang@gmail.com> - <https://github.com/harryosmar><br />
See also the list of [contributors](https://github.com/harryosmar/plugin-validation/contributors) which participated in this project.
