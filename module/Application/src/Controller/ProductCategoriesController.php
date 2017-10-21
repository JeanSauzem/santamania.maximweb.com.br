<?php

namespace Application\Controller;

use Zend\View\Model\JsonModel;

/**
 * @method \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger flashMessenger()
 * @method \Zend\Http\Response getResponse()
 * @method \Zend\Http\Request getRequest()
 */
class ProductCategoriesController extends AbstractController
{
    protected $form    = \Application\Form\ProductCategoriesForm::class;
    protected $service = \Application\Service\ProductCategoriesService::class;
    protected $route   = 'product-categories/default';

    /**
     * @return JsonModel
     */
    public function ajaxAction()
    {
        /** @var $request \Zend\Http\Request */
        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {

            $data = $request->getPost()->toArray();

            switch ($data['action']) {

                case"products-categories-save":

                    $view = [
                        'success' => true,
                        'message' => 'Salvo com sucesso',
                    ];

                    return new JsonModel($view);

                    break;

            }
        }

        $this->getResponse()->setStatusCode(404);

        return;
    }
}