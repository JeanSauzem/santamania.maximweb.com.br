<?php

namespace Auth;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

use Zend\Mvc\MvcEvent;

class Module implements ConfigProviderInterface,
    ServiceProviderInterface,
    ControllerProviderInterface,
    ViewHelperProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $container    = $e->getApplication()->getServiceManager();

        /** attach Front layout for 404 errors */
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, function (MvcEvent $event) {
            $vm = $event->getViewModel();
            $vm->setTemplate('layout/auth');
        });

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, function (MvcEvent $event) use ($container) {
            $match = $event->getRouteMatch();

            $authService = $container->get(\Zend\Authentication\AuthenticationServiceInterface::class);
            $routeName   = $match->getMatchedRouteName();

            $routes = ['login', 'logout', 'recover', 'register',
                'auth-facebook', 'register-facebook', 'create-password', 'account-success', 'activate',
                'oauth',
                'zf-apigility/ui',
            ];

            if (!$authService->getIdentity()) {
                if (!in_array($routeName, $routes)) {
                    $match->setParam('controller', Controller\IndexController::class)
                        ->setParam('action', 'login');
                }
            }

        }, 100);
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to seed
     * such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerConfig()
    {
        return include __DIR__ . '/../config/module.controller.php';
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return include __DIR__ . '/../config/module.service.php';
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig()
    {
        return include __DIR__ . '/../config/module.view.helper.php';
    }
}