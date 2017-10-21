<?php

namespace Application;

return [
    'router'         => require_once __DIR__ . '/module.routes.php',
    'view_manager'   => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => [
            'layout/layout'           => __DIR__ . '/../view/layout/main.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack'      => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine'       => [
        'driver'                   => [
            __NAMESPACE__ . '_driver' => [
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity',
                ],
            ],
            'orm_default'             => [
                'drivers' => [
                    __NAMESPACE__ . '\\Entity' => __NAMESPACE__ . '_driver',
                ],
            ],
        ],
        'fixtures'                 => [
            __NAMESPACE__ . '_fixture' => __DIR__ . '/../src/Fixture',
        ],
        'migrations_configuration' => [
            'orm_default' => [
                'directory' => __DIR__ . '/../src/Migrations',
                'namespace' => __NAMESPACE__ . '\Migrations',
                'table'     => 'migrations',
            ],
        ],
    ],
    'asset_manager'  => [
        'resolver_configs' => [
            'paths' => [
                __NAMESPACE__ => __DIR__ . '/../public',
            ],
        ],
    ],
    'module_layouts' => [
        __NAMESPACE__ => 'layout/main',
    ],
];
