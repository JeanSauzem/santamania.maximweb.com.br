<?php

namespace Auth\View\Helper;

use Interop\Container\ContainerInterface;

use Zend\View\Helper\AbstractHelper;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;


class UserIdentity extends AbstractHelper
{
    /**
     * @var ContainerInterface
     */
    private   $container;
    protected $authService;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getAuthService()
    {
        return $this->authService;
    }

    public function __invoke($field = null)
    {
        $sessionStorage    = new SessionStorage("UserSession");
        $this->authService = new AuthenticationService;
        $this->authService->setStorage($sessionStorage);

        if ($this->getAuthService()->hasIdentity()) {

            if (!is_null($field)) {
                $field = 'get' . ucfirst($field);

                return $this->getAuthService()->getIdentity()->$field();
            }

            return $this->getAuthService()->getIdentity();
        } else
            return false;
    }
}