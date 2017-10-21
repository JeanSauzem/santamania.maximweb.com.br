<?php

namespace Auth\Filter;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Identical;
use Zend\Validator\NotEmpty;

class PasswordCreateFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name'       => 'password',
            'required'   => true,
            'filters'    => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => NotEmpty::class],
            ],
        ]);

        $this->add([
            'name'       => 'password-confirm',
            'required'   => true,
            'filters'    => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => NotEmpty::class],
                [
                    'name'    => Identical::class,
                    'options' => [
                        'token' => 'password',
                    ],
                ],
            ],
        ]);
    }
}