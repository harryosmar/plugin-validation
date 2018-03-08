# Validation
Composer plugin for validation purpose, contains set of validation rules.

[![Latest Version](https://img.shields.io/github/release/harryosmar/plugin-validation.svg?style=flat-square)](https://github.com/harryosmar/plugin-validation/releases)
[![Build Status](https://travis-ci.org/harryosmar/plugin-validation.svg?branch=master)](https://travis-ci.org/harryosmar/plugin-validation)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/harryosmar/plugin-validation/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/harryosmar/plugin-validation/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/harryosmar/plugin-validation/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/harryosmar/plugin-validation/?branch=master)

## Features 
- Multi Language, available `en`, `id`, or use your own [custom translation](#custom-translation)
- Validation for multi `fields` and a [`field`](https://github.com/harryosmar/plugin-validation#field) can have multi [`rules`](https://github.com/harryosmar/plugin-validation#available-rules)
```
validation > fields > rules
```
![validation structure](https://github.com/harryosmar/plugin-validation/blob/master/resources/images/validation-structure.jpeg)

## Installation

Add this composer.json file

```json
{
    "require": {
        "harryosmar/plugin-validation": "^2.0"
    }
}
```

Then running
```bash
$ composer install
```

Or type
```
composer require harryosmar/plugin-validation
```
in `composer.json` root directory

## How To Use
* [1. initialize](#1-initialize)
* [2. add `fields` to `$validation` object](#2-add-fields-to-validation-object)
* [3. call the `$validation` `run` method](#3-call-the-validation-run-method)
* [4, get the errors message if `$status` is `false`](#4-get-the-errors-message-if-status-is-false)
* [validation option with `break` validation chain](#validation-with-option-break-validation-chain)

###### 1. initialize
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

###### 2. add `fields` to `$validation` object
```php
<?php
/**
 * @var \PluginSimpleValidate\Validation $validation
 * @var \PluginSimpleValidate\Field $emailField
 * @var \PluginSimpleValidate\Field $passwordField
 */
$validation->addField($emailField)->addField($passwordField); // add chain of fields to `$validation` object
```

###### 3. call the `$validation` `run` method
```php
<?php 
/** @var \PluginSimpleValidate\Validation $validation */
$status = $validation->run();
```

###### 4. get the errors message if `$status` is `false`
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

##### validation with option `break` validation chain
You can `break` the `validation chain` if there is a `field` get an error. In [`step 3`](#3-call-the-validation-run-method), when calling the method `run` of `$validation` object, add parameter `true` to enable `break the chain when error occured`
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

## 2 Types Validation
* [Validation](#validation)
* [Form Validation](#form-validation)


### Validation
see the [sample code](#initialize)

### Form Validation
```php
<?php
use PluginSimpleValidate\FormValidation;

/** @var \PluginSimpleValidate\Libraries\Language $language */
$validation = new FormValidation($language);

/**
* sample of request body
 * [
       'email' => 'abc',
       'grant_type' => '',
       'client_id' => '',
       'client_secret' => '',
       'redirect_uri' => '',
       'username' => '',
       'password' => '',
       'scope' => '',
   ]
*/


$validation->createFromPost(
    \Zend\Diactoros\ServerRequestFactory::fromGlobals(),
    [
        'email' => 'required,validEmail',
        'grant_type' => 'required',
        'client_id' => 'required,isNumber',
        'client_secret' => 'required,isAlphaOrNumeric',
        'redirect_uri' => 'required',
        'username' => 'required,lengthBetweenOrEqual:5:10',
        'password' => 'required,lengthGreaterThan:5',
        'scope' => 'required',
    ]
);

$validation->run();

if (!$validation->getStatus()) {
    $errors = $validation->getErrors();
}
```
The `$erros` will be
```php
<?php
[
    'email' => [
        'field must be a valid email address',
    ],
    'grant_type' => [
        'field is required',
    ],
    'client_id' => [
        'field is required',
        'field must be a number',
    ],
    'client_secret' => [
        'field is required',
        'field may only letters and numbers',
    ],
    'redirect_uri' => [
        'field is required',
    ],
    'username' => [
        'field is required',
        'field length must be greater or equal than 5 or less or equal than 10',
    ],
    'password' => [
        'field is required',
        'field length must be greater than 5',
    ],
    'scope' => [
        'field is required',
    ],
]
```


## Field
There are 2 type of `field` available :
- Field with single value `PluginSimpleValidate\Field`
```php
<?php
use PluginSimpleValidate\Field;
use PluginSimpleValidate\Validation;

$firstNameField = (new Field('firstname', ''))->required()->lengthGreaterOrEqualThan(4);
$lastNameField = (new Field('lastname', ''))->required()->lengthGreaterOrEqualThan(4);
$fullNameField = (new Field(
    'fullname',
    $firstNameField->getValue() . ' ' . $lastNameField->getValue()
))->lengthGreaterOrEqualThan(10);

/** @var Validation $validation  */
$validation->addField($firstNameField)->addField($lastNameField)->addField($fullNameField);

if (!$validation->run()) {
    $errors = $validation->getErrors();
}
```
The `$errors` will be
```php
<?php
[
    [
        'firstname' => [
            'field is required',
            'field length must be greater or equal than 4',
        ],
        'lastname' => [
            'field is required',
            'field length must be greater or equal than 4',
        ],
        'fullname' => [
            'field length must be greater or equal than 10',
        ],
    ]
];
```

- Field with multi values `PluginSimpleValidate\MultiValues\Field`
```php
<?php
use PluginSimpleValidate\MultiValues\Field;
use PluginSimpleValidate\Validation;

$firstName = '';
$lastName = '';

/** @var Validation $validation  */
$validation->addField((new Field('name'))
    ->isTrue($firstName !== '', 'first name required')->isTrue(strlen($firstName) >= 4, 'first name length must be at least 4')
    ->isTrue($lastName !== '', 'last name required')->isTrue(strlen($lastName) >= 4, 'last name length must be at least 4')
    ->isTrue(strlen($firstName . ' ' . $lastName) >= 10, 'full name length must be at least 10'));

if (!$validation->run()) {
    $errors = $validation->getErrors();   
}
```
The `$errors` will be
```php
<?php
[
    'name' => [
        'first name required',
        'first name length must be at least 4',
        'last name required',
        'last name length must be at least 4',
        'full name length must be at least 10',
    ]
];
```

## Available Rules
* [required](#required)
* [numeric](#numeric)
* [email](#email)
* [aplha](#aplha)
* [alpha or numeric](#alpha-or-numeric)
* [decimal](#decimal)
* [natural](#natural)
* [natural with no zero](#natural-with-no-zero)
* [equal](#equal)
* [less than](#less-than)
* [greater than](#greater-than)
* [less or equal than](#less-or-equal-than)
* [greater or equal than](#greater-or-equal-than)
* [between](#between)
* [between or equal](#between-or-equal)
* [length](#length)
* [length less than](#length-less-than)
* [length greater than](#length-greater-than)
* [length less or equal than](#length-less-or-equal-than)
* [length greater or equal than](#length-greater-or-equal-than)
* [length between](#length-between)
* [length between or equal](#length-between-or-equal)
* [`is true` for `custom rule logic`](#is-true-for-custom-rule-logic)
* [valid phone](#valid-phone)


##### `required`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->required();
```

##### `numeric`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isNumber();
```

##### `email`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->validEmail();
```

##### `aplha`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isAlpha();
```

##### `alpha or numeric`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isAlphaOrNumeric();
```

##### `decimal`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isDecimal();
```

##### `natural`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isNatural();
```

##### `natural with no zero`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isNaturalNoZero();
```

##### `equal`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->equal('old password');
```

##### `less than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lessThan(5);
```

##### `greater than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->greaterThan(5);
```

##### `less or equal than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lessOrEqualThan(5);
```

##### `greater or equal than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->greaterOrEqualThan(5);
```

##### `between`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->between(5, 10);
```

##### `between or equal`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->betweenOrEqual(5, 10);
```

##### `length`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->length(5);
```

##### `length less than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lengthLessThan(5);
```

##### `length greater than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lengthGreaterThan(5);
```

##### `length less or equal than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lengthLessOrEqualThan(5);
```

##### `length greater or equal than`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lengthGreaterOrEqualThan(5);
```

##### `length between`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lengthBetween(5, 10);
```

##### `length between or equal`
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->lengthBetweenOrEqual(5, 10);
```

##### `is true` for `custom rule logic`
```php
<?php
$field = new \PluginSimpleValidate\Field('field', someMethod());
$field->isTrue('this is for error message');

function someMethod() : bool 
{
    // add logic here
}
```

##### valid phone
```php
<?php
/**
 * @var \PluginSimpleValidate\Field $field
 */
$field->isValidPhone('ID'); // `ID` is region code for `indonesia` country
```

## Custom translation
If you want to use your own translation, when instantiate `Language` class provide the parameter `$translation` array
```php
<?php
use PluginSimpleValidate\Libraries\Language;

/** 
 * @var array $translationArray
 * $translationArray must have the same format with https://github.com/harryosmar/plugin-validation/blob/master/src/lang/en.php
 */
$language = new Language('pl', $translationArray);
```

### Submitting bugs and feature requests
Harry Osmar Sitohang - <harryosmarsitohang@gmail.com> - <https://github.com/harryosmar><br />
See also the list of [contributors](https://github.com/harryosmar/plugin-validation/contributors) which participated in this project.
