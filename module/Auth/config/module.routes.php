<?php

namespace Auth;

use Zend\Router\Http;

return [
    'routes' => [
        'login'           => [
            'type'    => Http\Literal::class,
            'options' => [
                'route'    => '/login',
                'defaults' => [
                    'controller' => Controller\IndexController::class,
                    'action'     => 'login',
                ],
            ],
        ],
        'logout'          => [
            'type'    => Http\Literal::class,
            'options' => [
                'route'    => '/logout',
                'defaults' => [
                    'controller' => Controller\IndexController::class,
                    'action'     => 'logout',
                ],
            ],
        ],
        'recover'         => [
            'type'    => Http\Literal::class,
            'options' => [
                'route'    => '/recover',
                'defaults' => [
                    'controller' => Controller\IndexController::class,
                    'action'     => 'recover',
                ],
            ],
        ],
        'register'        => [
            'type'    => Http\Literal::class,
            'options' => [
                'route'    => '/register',
                'defaults' => [
                    'controller' => Controller\IndexController::class,
                    'action'     => 'register',
                ],
            ],
        ],
        'create-password' => [
            'type'    => Http\Segment::class,
            'options' => [
                'route'       => '/create-password/:social-network',
                'defaults'    => [
                    'controller' => Controller\IndexController::class,
                    'action'     => 'create-password',
                ],
                'constraints' => [
                    'action'         => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'social-network' => '[a-zA-Z][a-zA-Z0-9_-]*',
                ],
            ],
        ],
        'account-success' => [
            'type'    => Http\Segment::class,
            'options' => [
                'route'       => '/account-success/:user',
                'defaults'    => [
                    'controller' => Controller\IndexController::class,
                    'action'     => 'account-success',
                ],
                'constraints' => [
                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'user'   => '[a-zA-Z0-9][a-zA-Z0-9_-]*',
                ],
            ],
        ],
        'activate'        => [
            'type'    => Http\Segment::class,
            'options' => [
                'route'    => '/activate[/:key]',
                'defaults' => [
                    'controller' => Controller\IndexController::class,
                    'action'     => 'activate',
                ],
            ],
        ],
    ],
];