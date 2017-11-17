<?php

namespace Application\Module;

use Zend\EventManager\Event;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;

class OnBootstrap
{
    public function __construct(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $sharedEvents = $eventManager->getSharedManager();
        $container = $e->getApplication()->getServiceManager();

        $sharedEvents->attach(\Application\Service\ProductsService::class, 'deleteProduct',
            function (Event $em) use ($container) {

                //Nova  produção
                $data = $em->getParams();

                $totalReportService = $container->get(\Application\Service\TotalReportService::class);
                $ProdutionService = $container->get(\Application\Service\ProdutionService::class);
                $checkListService = $container->get(\Application\Service\ChecklistService::class);
                /** @var \Application\Service\ProductCheckService $productService */
                $productService = $container->get(\Application\Service\ProductCheckService::class);

                $checklists = $checkListService->findBy(['product' => $data['entity']->getId()]);

                foreach ($checklists as $checklist) {
                    $checkListService->delete(['id' => $checklist->getId()]);
                }

                $produtions = $ProdutionService->findBy(['product' => $data['entity']->getId()]);

                foreach ($produtions as $prodution) {
                    $ProdutionService->delete(['id' => $prodution->getId()]);
                }

                $totalReports = $totalReportService->findBy(['product' => $data['entity']->getId()]);

                foreach ($totalReports as $totalReport) {
                    $totalReportService->delete(['id' => $totalReport->getId()]);
                }

                $totalProductChecks = $productService->findBy(['idProduct' => $data['entity']->getId()]);

                foreach ($totalProductChecks as $totalProductCheck){
                    $productService->delete(['id' => $totalProductCheck->getId()]);
                }

            }, 100);

        $sharedEvents->attach(\Application\Service\WarehousesService::class, 'deleteWarehouse',
            function (Event $em) use ($container) {
                $data = $em->getParams();

                $checkListService = $container->get(\Application\Service\ChecklistService::class);

                $checklists = $checkListService->findby(['warehouse' => $data['entity']->getId()]);

                foreach ($checklists as $checklist) {
                    $checkListService->delete(['id' => $checklist->getId()]);
                }

            }, 100);
        $sharedEvents->attach(\Application\Service\CounterService::class, 'createProductCheck',
            function (Event $em) use ($container) {
                $data = $em->getParams();
                /** $productService @var \Application\Service\ProductsService */
                $productService = $container->get(\Application\Service\ProductsService::class);
                /** \Application\Service\ProductCheckService @var $productCheckService */
                $productCheckService = $container->get(\Application\Service\ProductCheckService::class);
                /** @var \Application\Entity\Products $products */
                $products = $productService->findBy([]);

                foreach ($products as $product) {

                    $data1 = [
                        'idProduct' => $product->getId(),
                        'idCounter' => $data['entity']->getId(),
                        'total' => 0,
                        'checked' => 0
                    ];
                    $productCheckService->create($data1);

                }


            }, 100);
        $sharedEvents->attach(\Application\Service\QuantityWarehouseService::class, 'updateProductCheck',
            function (Event $em) use ($container) {
                $data = $em->getParams();
                /** @var \Application\Service\ProductCheckService $productCheckService */
                $productCheckService = $container->get(\Application\Service\ProductCheckService::class);
                /** @var \Application\Service\QuantityWarehouseService $quantityWarehouseService */
                $quantityWarehouseService = $container->get(\Application\Service\QuantityWarehouseService::class);

                $quantityWarehouses = $quantityWarehouseService->findBy(['idProductChecked' => $data['entity']->getIdProductChecked()->getId()]);
                $quantity = 0;
                /** @var \Application\Entity\QuantityWarehouse $quantityWarehouse */
                foreach ($quantityWarehouses as $quantityWarehouse){
                    $quantity = $quantity + $quantityWarehouse->getQuantity();
                }
                if($quantity > 0) {
                    $data1 = [
                        'total' => $quantity,
                        'checked' => 1
                    ];
                }else{
                    $data1 = [
                        'total' => $quantity,
                        'checked' => 0
                    ];
                }
                $productCheckService->update($data['entity']-> getIdProductChecked()->getId(), $data1);
            }, 100);
        $sharedEvents->attach(\Application\Service\CounterService::class, 'deleteProductCheck',
            function (Event $em) use ($container) {
                $data = $em->getParams();
                /** @var \Application\Service\ProductCheckService $serviceProductCheck */
                $serviceProductCheck = $container->get(\Application\Service\ProductCheckService::class);
                /** @var \Application\Service\QuantityWarehouseService $serviceQuantityWarehouse */
                $serviceQuantityWarehouse = $container->get(\Application\Service\QuantityWarehouseService::class);
                $productChecks = $serviceProductCheck->findBy(['idCounter' => $data['entity']->getId() ]);
                foreach ($productChecks as $productCheck){
                    $quantityWarehouses = $serviceQuantityWarehouse->findBy(['idProductChecked' => $productCheck->getId() ]);
                    if($quantityWarehouses){
                        foreach($quantityWarehouses as $quantityWarehouse){
                            $serviceQuantityWarehouse->delete(['id' => $quantityWarehouse->getId()]);
                        }
                    }
                    $serviceProductCheck->delete(['id' => $productCheck->getId()]);
                }

            }, 100);
    }
}
