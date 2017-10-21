<?php

namespace Application\Form;

use Interop\Container\ContainerInterface;
use Zend\Form\{
    Form, Element
};

class UnitsMeasureForm extends Form
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct('units-measure-form');

        $this->setInputFilter($container->get(\Application\Filter\UnitsMeasureFilter::class));

        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
        ]);
        $this->add([
            'name' => 'name',
            'type' => Element\Text::class,
        ]);
        $this->add([
            'name' => 'symbol',
            'type' => Element\Text::class,
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Element\Submit::class,
        ]);
    }
}