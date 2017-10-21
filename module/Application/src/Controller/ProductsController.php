<?php

namespace Application\Controller;

/**
 * @method \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger flashMessenger()
 * @method \Zend\Http\Response getResponse()
 * @method \Zend\Http\Request getRequest()
 */
class ProductsController extends AbstractController
{
    protected $form    = \Application\Form\ProductsForm::class;
    protected $service = \Application\Service\ProductsService::class;
    protected $route   = 'products/default';
}
