<?php

namespace Application\Controller;

/**
 * @method \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger flashMessenger()
 * @method \Zend\Http\Response getResponse()
 * @method \Zend\Http\Request getRequest()
 */
class ProdutionController extends AbstractController
{
    protected $form    = \Application\Form\ProdutionForm::class;
    protected $service = \Application\Service\ProdutionService::class;
    protected $route   = 'prodution/default';


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

                case"close-day":
                   $totalReportService = $this->container->get(\Application\Service\TotalReportService::class);
                   $totalReportService->create($data);
                 
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
