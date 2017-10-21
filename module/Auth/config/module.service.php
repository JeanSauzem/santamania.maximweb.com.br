<?php

namespace Auth;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;

return [
    'aliases'   => [
        AuthenticationService::class => AuthenticationServiceInterface::class,
    ],
    'factories' => [
        Form\LoginForm::class          => Form\Factory\LoginFormFactory::class,
        Filter\LoginFilter::class      => Filter\Factory\LoginFilterFactory::class,
        Service\AuthService::class     => Service\Factory\AuthServiceFactory::class,
        // REGISTER
        Filter\RegisterFilter::class   => Filter\Factory\RegisterFilterFactory::class,
        Form\RegisterForm::class       => Form\Factory\RegisterFormFactory::class,
        Service\RegisterService::class => Service\Factory\RegisterServiceFactory::class,

        AuthenticationServiceInterface::class => Service\Factory\AuthenticationServiceFactory::class,
        // Password Create
        Filter\PasswordCreateFilter::class    => Filter\Factory\PasswordCreateFilterFactory::class,
        Form\PasswordCreateForm::class        => Form\Factory\PasswordCreateFormFactory::class,
    ],
];