<?php

namespace Auth\Controller;

use Auth\Form\LoginForm;
use Auth\Service\AuthService;
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

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function loginAction()
    {
        /** @var \Auth\Service\AuthService $service */
        $service = $this->container->get(AuthService::class);

        if ($service->hasIdentity())
            return $this->redirect()->toRoute('home');

        /** @var \Auth\Form\LoginForm $form */
        $form         = $this->container->get(LoginForm::class);
        $view['form'] = $form;
        /** @var \Zend\Http\Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {

                if ($service->login($form->getData())) {

                    return $this->redirect()->toRoute('home');
                } else {
                    $this->flashMessenger()->addErrorMessage('Email ou Senha Incorretos');

                    return $this->redirect()->toRoute('login');
                }
            }
        }

        ($this->flashMessenger()->hasErrorMessages()) ? $view['error'] = $this->flashMessenger()->getErrorMessages() : null;
        ($this->flashMessenger()->hasSuccessMessages()) ? $view['success'] = $this->flashMessenger()->getSuccessMessages() : null;

        return new ViewModel($view);
    }

    public function logoutAction()
    {
        /** @var \Auth\Service\AuthService $service */
        $service = $this->container->get(AuthService::class);
        $service->clearIdentity();

        return $this->redirect()->toRoute('home');
    }

    public function recoverAction()
    {
        return new ViewModel();
    }

    public function activateAction()
    {
        $activationKey = $this->params()->fromRoute('key');

        /** @var \Auth\Service\AuthService $userService */
        $userService = $this->container->get(\Auth\Service\AuthService::class);
        $result      = $userService->activate($activationKey);

        if ($result['success'] == true) {
            $this->flashMessenger()->addSuccessMessage($result['message']);
        } else {
            $this->flashMessenger()->addErrorMessage($result['message']);
        }

        return $this->redirect()->toRoute('login');
    }
}