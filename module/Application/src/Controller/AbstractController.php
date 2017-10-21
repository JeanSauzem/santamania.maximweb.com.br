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
abstract class AbstractController extends AbstractActionController
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    protected $service;
    protected $form;
    protected $route;

    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->service   = $container->get($this->service);
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $page         = $this->params()->fromRoute('page');
        $view['page'] = $page;
        $view['data'] = $this->service->fetchAll($page);

        ($this->flashMessenger()->hasSuccessMessages()) ? $view['success'] = $this->flashMessenger()->getSuccessMessages() : null;
        ($this->flashMessenger()->hasErrorMessages()) ? $view['error'] = $this->flashMessenger()->getErrorMessages() : null;

        return new ViewModel($view);
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function newAction()
    {
        $form = $this->container->get($this->form);

        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {

                if ($this->service->create($form->getData())) {
                    $this->flashMessenger()->addSuccessMessage('Criado com sucesso');

                    return $this->redirect()->toRoute($this->route);
                } else {
                    $this->flashMessenger()->addErrorMessage('Erro ao criar');
                }
            }
//            else {
//                echo "<pre>";
//                print_r($form->getMessages());
//                echo "</pre>";
//                exit();
//            }
        }

        $view['form'] = $form;

        ($this->flashMessenger()->hasSuccessMessages()) ? $view['success'] = $this->flashMessenger()->getSuccessMessages() : null;
        ($this->flashMessenger()->hasErrorMessages()) ? $view['error'] = $this->flashMessenger()->getErrorMessages() : null;

        return new ViewModel($view);
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function editAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id)
            return $this->redirect()->toRoute($this->route, ['action' => 'new']);

        $data = $this->service->find($id);

        $form = $this->container->get($this->form);

        $form->setData($data->toArray());

        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {

                if ($this->service->update($form->getData()['id'], $form->getData())) {
                    $this->flashMessenger()->addSuccessMessage('Atualizado com sucesso');

                    return $this->redirect()->toRoute($this->route);
                } else {
                    $this->flashMessenger()->addErrorMessage('Erro ao atualizar');
                }
            }
        }

        $view['data'] = $data;
        $view['form'] = $form;

        ($this->flashMessenger()->hasSuccessMessages()) ? $view['success'] = $this->flashMessenger()->getSuccessMessages() : null;
        ($this->flashMessenger()->hasErrorMessages()) ? $view['error'] = $this->flashMessenger()->getErrorMessages() : null;

        return new ViewModel($view);
    }

    /**
     * @return \Zend\Http\Response
     */
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id', 0);

        if ($id === 0)
            return $this->redirect()->toRoute($this->route);

        if ($this->service->delete(['id' => $id])) {
            $this->flashMessenger()->addSuccessMessage('Removido com sucesso');
        } else {
            $this->flashMessenger()->addErrorMessage('Erro ao deletar');
        }

        return $this->redirect()->toRoute($this->route);
    }
}