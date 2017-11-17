<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\{
    Hydrator\ClassMethods,
    Paginator\Adapter\ArrayAdapter,
    Paginator\Paginator
};

/**
 * @method \Zend\Mvc\Plugin\FlashMessenger\FlashMessenger flashMessenger()
 * @method \Zend\Http\Response getResponse()
 * @method \Zend\Http\Request getRequest()
 */
class ChecklistController extends AbstractController
{
    protected $form = \Application\Form\ChecklistForm::class;
    protected $service = \Application\Service\ChecklistService::class;
    protected $route = 'checklist/default';

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $ChecklistService = $this->container->get(\Application\Service\ChecklistService::class);
        $counterService = $this->container->get(\Application\Service\CounterService::class);

        $page = $this->params()->fromRoute('page');
        $paginator = $counterService->fetchAll($page);

        $view['page'] = $page;
        $view['data'] = $paginator;

        ($this->flashMessenger()->hasSuccessMessages()) ? $view['success'] = $this->flashMessenger()->getSuccessMessages() : null;
        ($this->flashMessenger()->hasErrorMessages()) ? $view['error'] = $this->flashMessenger()->getErrorMessages() : null;

        return new ViewModel($view);
    }

    /**
     * @return ViewModel
     */
    public function checkProductAction()
    {
        $id = $this->params()->fromRoute('id');
        $page = $this->params()->fromRoute('page');

        /** @var \Application\Service\ProductsService $productService */
        $productService = $this->container->get(\Application\Service\ProductsService::class);
        /** @var \Application\Service\ProductCheckService $productCheckService */
        $productCheckService = $this->container->get(\Application\Service\ProductCheckService::class);
        /** @var \Application\Service\CounterService $counterService */
        $counterService = $this->container->get(\Application\Service\CounterService::class);
        /** @var \Application\Entity\Counter $dateChecklist */
        $dateChecklist = $counterService->find($id);
        $view['date'] = $dateChecklist->getDate();

        $products = $productService->findBy([]);
        /** @var \Application\Entity\Products $product */
        foreach ($products as $product) {
            /** @var \Application\Entity\ProductCheck $checkProdution */
            $checkProdution = $productCheckService->findBy(['idProduct' => $product->getId(), 'idCounter' => $dateChecklist->getId()]);
            if (count($checkProdution)) {
                if ($checkProdution[0]->getChecked() == 1) {
                    $view['productsCheck'][] = [
                        'product' => $checkProdution[0]->getIdProduct(),
                        'quantity' => $checkProdution[0]->getTotal(),
                        'checked' => 1,
                        'idCheck' => $checkProdution[0]->getId(),
                        'dateChecked' => $dateChecklist->getDate()
                    ];
                } else {
                    $view['productsCheck'][] = [
                        'product' => $checkProdution[0]->getIdProduct(),
                        'quantity' => $checkProdution[0]->getTotal(),
                        'checked' => 0,
                        'idCheck' => $checkProdution[0]->getId(),
                        'dateChecked' => $dateChecklist->getDate()
                    ];
                }
            }
        }
        $paginator = new Paginator(new ArrayAdapter($view['productsCheck']));
        $paginator->setCurrentPageNumber($page)->setDefaultItemCountPerPage(20);
        $view['paginator'] = $paginator;
        return new ViewModel($view);
    }

    /**
     * @return ViewModel
     */
    public function checkedAction()
    {
        $id = $this->params()->fromRoute('id');

        $view['productCheck'] = $id;

        /** @var \Application\Service\QuantityWarehouseService $quantityWarehouseService */
        $quantityWarehouseService = $this->container->get(\Application\Service\QuantityWarehouseService::class);
        /** @var \Application\Service\WarehousesService $warehouseService */
        $warehouseService = $this->container->get(\Application\Service\WarehousesService::class);
        /** @var \Application\Entity\QuantityWarehouse $checks */
        $checks = $quantityWarehouseService->findBy(['idProductChecked' => $id]);
        /** @var  \Application\Entity\Warehouses $warehouses */
        $warehouses = $warehouseService->findBy([]);
        if ($this->request->isPost()) {
            $data = $this->request->getPost()->toArray();
            $check = $quantityWarehouseService->validNumber($data);
            if($check == false){
                $this->flashMessenger()->addSuccessMessage('Erro ao Cadastrar');
            }
            if (!isset($data['hidden'])) {
                /** @var \Application\Entity\QuantityWarehouse $entity */
                if ($entity = $quantityWarehouseService->create($data)) {
                    $this->flashMessenger()->addSuccessMessage('Cadastrado com sucesso');

                    return $this->redirect()->toRoute("checklist/default", ["action" => "check-product", "id" => $entity->getIdProductChecked()->getIdCounter()->getId()]);
                } else {
                    $this->flashMessenger()->addSuccessMessage('Erro ao Cadastrar');
                }
            } else {
                /** @var \Application\Entity\QuantityWarehouse $entity */
                if ($entity = $quantityWarehouseService->update1($data)) {
                    $this->flashMessenger()->addSuccessMessage('Cadastrado com sucesso');
                    return $this->redirect()->toRoute("checklist/default", ["action" => "check-product", "id" => $entity->getIdProductChecked()->getIdCounter()->getId()]);
                } else {
                    $this->flashMessenger()->addSuccessMessage('Erro ao Cadastrar');
                }
            }
        } else {
            if ($checks) {
                foreach ($checks as $check) {

                    $view['quantity'][] = [
                        'warehouse' => $check->getIdWarehouses(),
                        'quantity' => (int)$check->getQuantity(),
                        'id' => $check->getId()
                    ];
                }
            } else {
                foreach ($warehouses as $warehouse) {
                    $view['quantity'][] = [
                        'warehouse' => $warehouse,
                        'quantity' => ''
                    ];
                }
            }
        }
        return new ViewModel($view);
    }

    /**
     * @return ViewModel
     */
    public function deleteAction()
    {
        $serviceCounter = $this->container->get(\Application\Service\CounterService::class);

        $id = $this->params()->fromRoute('id', 0);

        if ($id === 0)
            return $this->redirect()->toRoute($this->route);

        if ($serviceCounter->delete(['id' => $id])) {
            $this->flashMessenger()->addSuccessMessage('Removido com sucesso');
        } else {
            $this->flashMessenger()->addErrorMessage('Erro ao deletar');
        }

        return $this->redirect()->toRoute($this->route);
    }

    public
    function ajaxAction()
    {
        /** @var $request \Zend\Http\Request */
        $request = $this->getRequest();
        /** @var \Application\Service\CounterService $counterService */
        $counterService = $this->container->get(\Application\Service\CounterService::class);

        if ($request->isXmlHttpRequest()) {

            $data = $request->getPost()->toArray();

            switch ($data['action']) {
                case"counter-save-ajax":
                    $checked = $counterService->checkDate($data['data']['date']);
                    if ($checked == false) {
                        return new JsonModel([
                            'success' => false
                        ]);
                    }
                    $data = new \DateTime(implode('-', array_reverse(explode('/', $data['data']['date']))));
                    $valid = $counterService->check($data);
                    if ($valid == false) {
                        return new JsonModel([
                            'success' => false
                        ]);
                    }
                    $entity = $counterService->create(['date' => $data]);
                    return new  JsonModel([
                        'success' => true,
                        'counter' => [
                            'id' => $entity->getId(),
                            'data' => date_format($entity->getDate(), "d-m-Y")
                        ]
                    ]);
                    break;

            }
        }

        $this->getResponse()->setStatusCode(404);

        return;
    }
}