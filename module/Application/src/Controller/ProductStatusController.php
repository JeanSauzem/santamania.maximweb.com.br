<?php

namespace Application\Controller;

/**
 * @method \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger flashMessenger()
 * @method \Zend\Http\Response getResponse()
 * @method \Zend\Http\Request getRequest()
 */
class ProductStatusController extends AbstractController
{
    protected $form    = \Application\Form\ProductStatusForm::class;
    protected $service = \Application\Service\ProductStatusService::class;
    protected $route   = 'product-status/default';
}