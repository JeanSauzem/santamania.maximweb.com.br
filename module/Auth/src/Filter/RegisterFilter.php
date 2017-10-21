<?php

namespace Auth\Filter;

use Interop\Container\ContainerInterface;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Identical;
use Zend\Validator\NotEmpty;

class RegisterFilter extends InputFilter
{
    public function __construct(ContainerInterface $container)
    {
        $this->add([
            'name'       => 'name',
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
            'name'       => 'email',
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