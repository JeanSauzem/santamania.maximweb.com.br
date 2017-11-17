<?php

namespace Application\Controller;

use Interop\Container\ContainerInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * @method \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger flashMessenger()
 * @method \Zend\Http\Response getResponse()
 * @method \Zend\Http\Request getRequest()
 */
class IndexController extends AbstractActionController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * IndexController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function indexAction()
    {
        $nowDate = date_create(date("Y-m-d H:i:s"));
        date_timezone_set($nowDate, timezone_open('America/Sao_Paulo'));
        date_format($nowDate,"d-m-Y");

        $totalReportService = $this->container->get(\Application\Service\TotalReportService::class);
        $ProdutionService = $this->container->get(\Application\Service\ProdutionService::class);
        $checkListService = $this->container->get(\Application\Service\ChecklistService::class);

        $view['produtionToday'] = $ProdutionService->findTotalProdutionToday(date_format($nowDate,"d-m-Y"));
    
        return new ViewModel($view);
    }
}
