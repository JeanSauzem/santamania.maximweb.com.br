<?php

namespace Application;

use Zend\Router\Http;

return [
    'routes' => [
        'home'               => [
            'type'    => Http\Literal::class,
            'options' => [
                'route'    => '/',
                'defaults' => [
                    'controller' => Controller\IndexController::class,
                    'action'     => 'index',
                ],
            ],
        ],
        'users'              => [
            'type'          => Http\Literal::class,
            'options'       => [
                'route'    => '/users',
                'defaults' => [
                    'controller' => Controller\UsersController::class,
                    'action'     => 'index',
                ],
            ],
            'may_terminate' => true,
            'child_routes'  => [
                'default'   => [
                    'type'    => Http\Segment::class,
                    'options' => [
                        'route'       => '[/:action][/:id]',
                        'constraints' => [
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'id'     => '\d+',
                        ],
                        'defaults'    => [],
                    ],
                ],
                'paginator' => [
                    'type'    => Http\Segment::class,
                    'options' => [
                        'route'       => '[/page/:page]',
                        'constraints' => [
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'page'   => '\d+',
                        ],
                        'defaults'    => [
                            'action' => 'index',
                            'page'   => 1,
                        ],
                    ],
                ],
            ],
        ],
        'profile'            => [
            'type'          => Http\Literal::class,
            'options'       => [
                'route'    => '/profile',
                'defaults' => [
                    'controller' => Controller\UsersController::class,
                    'action'     => 'profile',
                ],
            ],
            'may_terminate' => true,
            'child_routes'  => [],
        ],
        'products'           => [
            'type'          => Http\Literal::class,
            'options'       => [
                'route'    => '/products',
                'defaults' => [
                    'controller' => Controller\ProductsController::class,
                    'action'     => 'index',
                ],
            ],
            'may_terminate' => true,
            'child_routes'  => [
                'default'   => [
                    'type'    => Http\Segment::class,
                    'options' => [
                        'route'       => '[/:action][/:id]',
                        'constraints' => [
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'id'     => '\d+',
                        ],
                        'defaults'    => [],
                    ],
                ],
                'paginator' => [
                    'type'    => Http\Segment::class,
                    'options' => [
                        'route'       => '[/page/:page]',
                        'constraints' => [
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'page'   => '\d+',
                        ],
                        'defaults'    => [
                            'action' => 'index',
                            'page'   => 1,
                        ],
                    ],
                ],
            ],
        ],
        'product-categories' => [
            'type'          => Http\Literal::class,
            'options'       => [
                'route'    => '/product-categories',
                'defaults' => [
                    'controller' => Controller\ProductCategoriesController::class,
                    'action'     => 'index',
                ],
            ],
            'may_terminate' => true,
            'child_routes'  => [
                'default'   => [
                    'type'    => Http\Segment::class,
                    'options' => [
                        'route'       => '[/:action][/:id]',
                        'constraints' => [
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'id'     => '\d+',
                        ],
                        'defaults'    => [],
                    ],
                ],
                'paginator' => [
                    'type'    => Http\Segment::class,
                    'options' => [
                        'route'       => '[/page/:page]',
                        'constraints' => [
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'page'   => '\d+',
                        ],
                        'defaults'    => [
                            'action' => 'index',
                            'page'   => 1,
                        ],
                    ],
                ],
            ],
        ],
        'product-status'     => [
            'type'          => Http\Literal::class,
            'options'       => [
                'route'    => '/product-status',
                'defaults' => [
                    'controller' => Controller\ProductStatusController::class,
                    'action'     => 'index',
                ],
            ],
            'may_terminate' => true,
            'child_routes'  => [
                'default'   => [
                    'type'    => Http\Segment::class,
                    'options' => [
                        'route'       => '[/:action][/:code]',
                        'constraints' => [
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'code'   => '[a-zA-Z0-9][a-zA-Z0-9_-]*',
                        ],
                        'defaults'    => [],
                    ],
                ],
                'paginator' => [
                    'type'    => Http\Segment::class,
                    'options' => [
                        'route'       => '[/page/:page]',
                        'constraints' => [
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'page'   => '\d+',
                        ],
                        'defaults'    => [
                            'action' => 'index',
                            'page'   => 1,
                        ],
                    ],
                ],
            ],
        ],
        'units-measure'      => [
            'type'          => Http\Literal::class,
            'options'       => [
                'route'    => '/units-measure',
                'defaults' => [
                    'controller' => Controller\UnitsMeasureController::class,
                    'action'     => 'index',
                ],
            ],
            'may_terminate' => true,
            'child_routes'  => [
                'default'   => [
                    'type'    => Http\Segment::class,
                    'options' => [
                        'route'       => '[/:action][/:id]',
                        'constraints' => [
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'id'     => '\d+',
                        ],
                        'defaults'    => [],
                    ],
                ],
                'paginator' => [
                    'type'    => Http\Segment::class,
                    'options' => [
                        'route'       => '[/page/:page]',
                        'constraints' => [
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'page'   => '\d+',
                        ],
                        'defaults'    => [
                            'action' => 'index',
                            'page'   => 1,
                        ],
                    ],
                ],
            ],
        ],
        'warehouses'         => [
            'type'          => Http\Literal::class,
            'options'       => [
                'route'    => '/warehouses',
                'defaults' => [
                    'controller' => Controller\WarehousesController::class,
                    'action'     => 'index',
                ],
            ],
            'may_terminate' => true,
            'child_routes'  => [
                'default'   => [
                    'type'    => Http\Segment::class,
                    'options' => [
                        'route'       => '[/:action][/:id]',
                        'constraints' => [
                            'action' => '[a-zA-Z0-9][a-zA-Z0-9_-]*',
                            'id'     => '\d+',
                        ],
                        'defaults'    => [],
                    ],
                ],
                'paginator' => [
                    'type'    => Http\Segment::class,
                    'options' => [
                        'route'       => '[/page/:page]',
                        'constraints' => [
                            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'page'   => '\d+',
                        ],
                        'defaults'    => [
                            'action' => 'index',
                            'page'   => 1,
                        ],
                    ],
                ],
            ],
        ],
    ],
];