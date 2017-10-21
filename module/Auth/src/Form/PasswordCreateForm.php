<?php

namespace Auth\Form;

use Interop\Container\ContainerInterface;
use Zend\Form\{
    Form, Element
};

class PasswordCreateForm extends Form
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct('social-networks-password-form');
        $this->setInputFilter($container->get(\Auth\Filter\PasswordCreateFilter::class));

        $this->add([
            'name' => 'password',
            'type' => Element\Password::class,
        ]);

        $this->add([
            'name' => 'password-confirm',
            'type' => Element\Password::class,
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Element\Button::class,
        ]);
    }
}