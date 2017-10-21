<?php

namespace Application\Controller;

/**
 * @method \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger flashMessenger()
 * @method \Zend\Http\Response getResponse()
 * @method \Zend\Http\Request getRequest()
 */
class UsersController extends AbstractController
{
    protected $service = \Application\Service\UsersService::class;
    protected $form    = \Application\Form\UsersForm::class;
    protected $route   = 'users/default';
}