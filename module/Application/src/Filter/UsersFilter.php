<?php

namespace Application\Filter;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator;

use DoctrineModule\Validator as DoctrineValidator;

class UsersFilter extends InputFilter
{
    public function __construct(ContainerInterface $container, EntityManager $entityManager)
    {
        $this->add([
            'name'       => 'firstname',
            'required'   => true,
            'filters'    => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
            ],
        ]);

        $this->add([
            'name'     => 'lastname',
            'required' => false,
            'filters'  => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
        ]);

        $this->add([
            'name'       => 'email',
            'required'   => true,
            'filters'    => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
                [
                    'name'    => Validator\Regex::class,
                    'options' => [
                        'pattern'  => "/^[a-zA-Z0-9.!#$%&'*+\\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\\.[a-zA-Z0-9-]+)*$/",
                        'messages' => [
                            Validator\Regex::INVALID => "Invalid Format",
                        ],
                    ],
                ],
                [
                    'name'    => DoctrineValidator\UniqueObject::class,
                    'options' => [
                        'use_context'       => true,
                        'object_repository' => $entityManager->getRepository(\Application\Entity\Users::class),
                        'object_manager'    => $entityManager,
                        'fields'            => 'email',
                    ],
                ],
            ],
        ]);

        $this->add([
            'name'       => 'password',
            'required'   => isset($_POST['id']) ? false : true,
            'filters'    => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
            ],
        ]);
    }
}