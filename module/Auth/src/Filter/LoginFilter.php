<?php

namespace Auth\Filter;

use Zend\{
    Filter\StringTrim,
    Filter\StripTags,
    InputFilter\InputFilter,
    Validator\NotEmpty
};

class LoginFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name'       => 'email',
            'required'   => true,
            'validators' => [
                [
                    'name'    => NotEmpty::class,
                    'options' => [
                        'message' => [
                            NotEmpty::IS_EMPTY => "Campo Obrigatório.",
                        ],
                    ],
                ],
            ],
            'filters'    => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);

        $this->add([
            'name'       => 'password',
            'required'   => true,
            'validators' => [
                [
                    'name'    => NotEmpty::class,
                    'options' => [
                        'message' => [
                            NotEmpty::IS_EMPTY => "Campo Obrigatório.",
                        ],
                    ],
                ],
            ],
            'filters'    => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);
    }
}