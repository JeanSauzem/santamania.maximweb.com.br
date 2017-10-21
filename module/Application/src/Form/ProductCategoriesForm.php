<?php

namespace Application\Form;

use Interop\Container\ContainerInterface;
use Zend\Form\Form;
use Zend\Form\Element;

class ProductCategoriesForm extends Form
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct('product-categories-form');
        $this->setInputFilter($container->get(\Application\Filter\ProductsFilter::class));

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