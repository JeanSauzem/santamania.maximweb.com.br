<?php

namespace Application\Controller;

/**
 * @method \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger flashMessenger()
 * @method \Zend\Http\Response getResponse()
 * @method \Zend\Http\Request getRequest()
 */
class WarehousesController extends AbstractController
{
    protected $form    = \Application\Form\WarehousesForm::class;
    protected $service = \Application\Service\WarehousesService::class;
    protected $route   = 'warehouses/default';
}