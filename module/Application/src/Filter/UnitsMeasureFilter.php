<?php

namespace Application\Filter;

use Interop\Container\ContainerInterface;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class UnitsMeasureFilter extends InputFilter
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
            'name'       => 'symbol',
            'required'   => true,
            'filters'    => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => NotEmpty::class],
            ],
        ]);
    }
}