<?php

namespace Application\Filter;

use Zend\{
    Filter\StringTrim,
    Filter\StripTags,
    InputFilter\InputFilter,
    Validator
};

class ProductsFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name'       => 'name',
            'required'   => true,
            'validators' => [
                [
                    'name'    => Validator\NotEmpty::class,
                    'options' => [
                        'messages' => [
                            Validator\NotEmpty::IS_EMPTY => 'Campo obrigatório',
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
            'name'     => 'product_category',
            'required' => false,
        ]);

        $this->add([
            'name'     => 'units_measure',
            'required' => false,
        ]);

        $this->add([
            'name'     => 'active',
            'required' => false,
        ]);

    }
}