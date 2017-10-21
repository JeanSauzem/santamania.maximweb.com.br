<?php

namespace Application\Form;

use Interop\Container\ContainerInterface;
use Zend\Form\Element;
use Zend\Form\Form;

class WarehousesForm extends Form
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct('warehouses-form');
        $this->setInputFilter($container->get(\Application\Filter\WarehousesFilter::class));

        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
        ]);

        $this->add([
            'name' => 'name',
            'type' => Element\Text::class,
        ]);

        $this->add([
            'name' => 'active',
            'type' => Element\Checkbox::class,
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Element\Submit::class,
        ]);
    }
}