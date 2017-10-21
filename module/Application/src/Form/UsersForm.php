<?php

namespace Application\Form;

use Interop\Container\ContainerInterface;
use Zend\Form\Element;
use Zend\Form\Form;

class UsersForm extends Form
{
    protected $objectManager;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct('users-form');
        $this->setInputFilter($container->get(\Application\Filter\UsersFilter::class));

        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
        ]);

        $this->add([
            'name' => 'firstname',
            'type' => Element\Text::class,
        ]);

        $this->add([
            'name' => 'lastname',
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
            'name'       => 'level',
            'type'       => Element\Select::class,
            'attributes' => [
                'options' => [
                    '1' => 'Admin',
                    '2' => 'Gerente',
                    '3' => 'Funcionário',
                ],
            ],
            'options'    => [
                'disable_inarray_validator' => true,
            ],
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