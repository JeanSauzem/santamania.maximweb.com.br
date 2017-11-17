<?php

namespace Application\Filter;

use Zend\{
    Filter\StringTrim,
    Filter\StripTags,
    InputFilter\InputFilter,
    Validator\NotEmpty
};

class ProdutionFilter extends InputFilter
{
    public function __construct()
    {
     /*   $this->add([
            'name'       => 'name',
            'required'   => true,
            'validators' => [
                ['name' => NotEmpty::class],
            ],
            'filters'    => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);*/
    }
}