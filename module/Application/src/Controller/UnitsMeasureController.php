<?php

namespace Application\Controller;

use Zend\View\Model\JsonModel;

/**
 * @method \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger flashMessenger()
 * @method \Zend\Http\Response getResponse()
 * @method \Zend\Http\Request getRequest()
 */
class UnitsMeasureController extends AbstractController
{
    protected $form    = \Application\Form\UnitsMeasureForm::class;
    protected $service = \Application\Service\UnitsMeasureService::class;
    protected $route   = 'units-measure/default';

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

                case"units-measure-save":
                   
                    $view = [
                        'success' => true,
                        'message' => 'Salvo com sucesso',
                    ];

                    return new JsonModel($view);

                    break;
                case"units-measure-save-ajax":
                
                    $newUnit = $this->service->create($data['data']);
                    $unit = [
                        'id'   => $newUnit->getId(),
                        'name' => $data['data']['name']
                    ];
            
                    $view = [
                        'units' =>  $unit,
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