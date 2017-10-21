<?php

namespace Application;

return [
    'factories' => [
        Service\EncryptDecryptService::class    => Service\Factory\EncryptDecryptServiceFactory::class,
        Menu\Menu::class                        => Menu\Factory\MenuFactory::class,
        // USERS
        Filter\UsersFilter::class               => Filter\Factory\UsersFilterFactory::class,
        Form\UsersForm::class                   => Form\Factory\UsersFormFactory::class,
        Service\UsersService::class             => Service\Factory\UsersServiceFactory::class,
        // PRODUCTS
        Filter\ProductsFilter::class            => Filter\Factory\ProductsFilterFactory::class,
        Form\ProductsForm::class                => Form\Factory\ProductsFormFactory::class,
        Service\ProductsService::class          => Service\Factory\ProductsServiceFactory::class,

        // PRODUCT CATEGORIES
        Filter\ProductCategoriesFilter::class   => Filter\Factory\ProductCategoriesFilterFactory::class,
        Form\ProductCategoriesForm::class       => Form\Factory\ProductCategoriesFormFactory::class,
        Service\ProductCategoriesService::class => Service\Factory\ProductCategoriesServiceFactory::class,

        // PRODUCT STATUS
        Filter\ProductStatusFilter::class       => Filter\Factory\ProductStatusFilterFactory::class,
        Form\ProductStatusForm::class           => Form\Factory\ProductStatusFormFactory::class,
        Service\ProductStatusService::class     => Service\Factory\ProductStatusServiceFactory::class,

        // UNITS MEASURE
        Filter\UnitsMeasureFilter::class        => Filter\Factory\UnitsMeasureFilterFactory::class,
        Form\UnitsMeasureForm::class            => Form\Factory\UnitsMeasureFormFactory::class,
        Service\UnitsMeasureService::class      => Service\Factory\UnitsMeasureServiceFactory::class,

        // WAREHOUSES
        Filter\WarehousesFilter::class          => Filter\Factory\WarehousesFilterFactory::class,
        Form\WarehousesForm::class              => Form\Factory\WarehousesFormFactory::class,
        Service\WarehousesService::class        => Service\Factory\WarehousesServiceFactory::class,
    ],
];