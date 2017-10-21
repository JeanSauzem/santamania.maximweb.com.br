<?php

namespace Application;

return [
    'factories' => [
        Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
        Controller\UsersController::class => Controller\Factory\UsersControllerFactory::class,

        Controller\ProductCategoriesController::class => Controller\Factory\ProductCategoriesControllerFactory::class,
        Controller\ProductStatusController::class     => Controller\Factory\ProductStatusControllerFactory::class,
        Controller\ProductsController::class          => Controller\Factory\ProductsControllerFactory::class,
        Controller\UnitsMeasureController::class      => Controller\Factory\UnitsMeasureControllerFactory::class,
        Controller\WarehousesController::class => Controller\Factory\WarehousesControllerFactory::class,
    ],
];