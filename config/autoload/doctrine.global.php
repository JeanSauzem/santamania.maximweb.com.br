<?php

return [
    'doctrine_factories' => [
        'authenticationadapter' => \Auth\Adapter\Factory\AdapterFactory::class,
    ],
    'doctrine'           => [
        'connection'     => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params'      => [
                    'port'          => '3306',
                    'driverOptions' => [
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
                    ],
                ],
            ],
        ],
        'authentication' => [
            'orm_default' => [
                'object_manager'      => \Doctrine\ORM\EntityManager::class,
                'identity_class'      => \Application\Entity\Users::class,
                'identity_property'   => 'email',
                'credential_property' => 'password',
                'credential_callable' => function (\Application\Entity\Users $user, $passwordSent) {
                    if (!$user->getActive())
                        return false;

                    return password_verify($passwordSent, $user->getPassword());
                },
            ],
        ],
    ],
];