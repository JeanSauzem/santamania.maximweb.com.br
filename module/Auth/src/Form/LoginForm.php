<?php

namespace Auth\Form;

use Auth\Filter\LoginFilter;
use Interop\Container\ContainerInterface;
use Zend\Form\Element;
use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct('login-form');
        $this->setInputFilter($container->get(LoginFilter::class));

        $this->add([
            'name'    => 'email',
            'type'    => Element\Email::class,
            'options' => [
                'label' => 'Email',
            ],
        ]);

        $this->add([
            'name'    => 'password',
            'type'    => Element\Password::class,
            'options' => [
                'label' => 'Senha',
            ],
        ]);

        $this->add([
            'name'    => 'submit',
            'type'    => Element\Submit::class,
            'options' => [
                'label' => 'Acessar',
            ],
        ]);
    }

}