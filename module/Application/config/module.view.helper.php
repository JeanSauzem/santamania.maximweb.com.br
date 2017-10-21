<?php

namespace Application;

return [
    'aliases'   => [
        'getStatus' => View\Helper\Status::class,
    ],
    'factories' => [
        View\Helper\Status::class => View\Helper\Factory\StatusFactory::class,
    ],
];