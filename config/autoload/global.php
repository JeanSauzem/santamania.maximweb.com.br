<?php
return [
    include 'doctrine.global.php',
    'zf-content-negotiation' => [
        'selectors' => [],
    ],
    'db'                       => [
        'adapters' => [
            'DbAdapter' => [
                'database' => 'maximweb_santamania',
                'driver'   => 'PDO_Mysql',
                'username' => 'root',
                'password' => '',
                'dsn'      => 'mysql:host=localhost;dbname=maximweb_santamania',
            ],
        ],
    ],
    'key' => 'MaximWebSantaMania',
    'router' => [
        'routes' => [
            'oauth' => [
                'options' => [
                    'spec' => '%oauth%',
                    'regex' => '(?P<oauth>(/oauth))',
                ],
                'type' => 'regex',
            ],
        ],
    ],
];
