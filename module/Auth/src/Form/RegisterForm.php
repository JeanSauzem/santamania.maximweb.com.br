<?php

namespace Auth\Form;

use Interop\Container\ContainerInterface;
use Zend\Form\Form;
use Zend\Form\Element;

class RegisterForm extends Form
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct('register-form');
        $this->setInputFilter($container->get(\Auth\Filter\RegisterFilter::class));

        $this->add([
            'name' => 'name',
            'type' => Element\Text::class,
        ]);

        $this->add([
            'name' => 'email',
            'type' => Element\Email::class,
        ]);

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