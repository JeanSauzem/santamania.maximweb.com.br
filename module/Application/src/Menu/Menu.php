<?php

namespace Application\Menu;

use Interop\Container\ContainerInterface;
use Zend\Navigation\Service\DefaultNavigationFactory;

class Menu extends DefaultNavigationFactory
{
    public function array_remove_empty($haystack)
    {
        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $haystack[$key] = $this->array_remove_empty($haystack[$key]);
            }

            if (empty($haystack[$key])) {
                unset($haystack[$key]);
            }
        }

        return $haystack;
    }

    protected function getPages(ContainerInterface $container)
    {
        /** @var $application \Zend\Mvc\Application */
//        $application = $container->get('Application');
//        $controller  = $application->getMvcEvent()->getRouteMatch()->getParam('controller');
//        $action = $application->getMvcEvent()->getRouteMatch()->getParam('action');
//        $id     = $application->getMvcEvent()->getRouteMatch()->getParam('id');
//        $app    = $application->getMvcEvent()->getRouteMatch()->getParam('application');
//        $route  = $application->getMvcEvent()->getRouteMatch()->getMatchedRouteName();


        $navigation = [];

        if (null === $this->pages) {

            $navigation[] = [
                'label' => 'Home',
                'route' => 'home',
                'icon'  => 'fa fa-home',
            ];

            $navigation[] = [
                'label' => 'Usuários',
                'route' => 'users/default',
                'icon'  => 'md md-account-child',
            ];

            $navigation[] = [
                'label' => 'Produtos',
                'route' => 'products/default',
                'icon'  => 'glyphicon glyphicon-list',
            ];

            $navigation[] = [
                'label' => 'Configurações',
                'route' => 'home',
                'icon'  => 'glyphicon glyphicon-cog',
                'pages' => [
                    [
                        'label' => 'Categorias de Produtos',
                        'route' => 'product-categories/default',
                    ],
                    [
                        'label' => 'Unidades de Medida',
                        'route' => 'units-measure/default',
                    ],
                    [
                        'label' => 'Local de Armazenamento',
                        'route' => 'warehouses/default',
                    ],
                ],
            ];

            $mvcEvent    = $container->get('Application')->getMvcEvent();
            $routeMatch  = $mvcEvent->getRouteMatch();
            $router      = $mvcEvent->getRouter();
            $pages       = $this->getPagesFromConfig($this->array_remove_empty($navigation));
            $this->pages = $this->injectComponents($pages, $routeMatch, $router);
        }

        return $this->pages;
    }
}