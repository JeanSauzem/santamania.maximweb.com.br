<?php

namespace Auth;

return [
    'router'         => require __DIR__ . '/module.routes.php',
    'view_manager'   => [
        'template_path_stack' => [
            __NAMESPACE__ => __DIR__ . '/../view',
        ],
    ],
    'module_layouts' => [
        __NAMESPACE__ => 'layout/auth',
    ],
    'asset_manager'  => [
        'resolver_configs' => [
            'paths' => [
                __NAMESPACE__ => __DIR__ . '/../public',
            ],
        ],
    ],
];
