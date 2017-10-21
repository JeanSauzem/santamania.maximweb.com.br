<?php

namespace Auth\Service;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationServiceInterface;

use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

class AuthService implements EventManagerAwareInterface
{
    /**
     * @var AuthenticationServiceInterface
     */
    private $authService;
    /**
     * @var EventManagerInterface
     */
    protected $eventManager;
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * AuthService constructor.
     * @param ContainerInterface $container
     * @param AuthenticationServiceInterface $authService
     */
    public function __construct(ContainerInterface $container, AuthenticationServiceInterface $authService)
    {
        $this->authService = $authService;
        $this->container   = $container;
    }

    public function login(Array $data)
    {
        /** @var \Application\Service\EncryptDecryptService $encryptDecryptService */
        $encryptDecryptService = $this->container->get(\Application\Service\EncryptDecryptService::class);

        /** @var \Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter $authAdapter */
        $authAdapter = $this->authService->getAdapter();
        $authAdapter->setIdentity($data['email']);
        $authAdapter->setCredential($data['password']);

        $result  = $this->authService->authenticate();
        $isValid = $result->isValid();

        if ($isValid)
            $this->getEventManager()->trigger('authentication', $this, ['data' => $this->authService->getIdentity()]);
        else
            $this->getEventManager()->trigger('authentication', $this, ['data' => $data]);

        return $isValid;
    }

    public function hasIdentity()
    {
        if (empty($this->authService->getIdentity())) {
            $this->authService->clearIdentity();
        }

        return $this->authService->hasIdentity();
    }

    public function clearIdentity()
    {
        $this->authService->clearIdentity();

        $this->getEventManager()->trigger('logout-system', $this);

        return;
    }

    public function activate($key)
    {
        /** @var \Users\Service\UsersService $userService */
        $userService = $this->container->get(\Users\Service\UsersService::class);

        /** @var \Application\Entity\Users $user */
        $user = $userService->findOneBy(['activationKey' => $key]);

        if ($user) {

            if ($userService->update($user->getId(), [
                'activation_key' => '',
                'active'         => 1,
            ])
            ) {
                $view = [
                    'success' => true,
                    'message' => "User actived successfully",
                ];
            } else {
                $view = [
                    'success' => false,
                    'message' => "Error to active user.",
                ];
            }


        } else {
            $view = [
                'success' => false,
                'message' => "User not found",
            ];
        }

        return $view;
    }

    public function getRole()
    {
        if ($this->authService->getIdentity()) {
            return $this->authService->getIdentity()->getAclRole()->getName();
        }
    }

    /**
     * Retrieve the event manager
     * Lazy-loads an EventManager instance if none registered.
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (null === $this->eventManager) {
            $this->setEventManager(new EventManager());
        }

        return $this->eventManager;
    }

    /**
     * Inject an EventManager instance
     *
     * @param  EventManagerInterface $eventManager
     * @return void
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $eventManager->setIdentifiers([
            __CLASS__,
            get_class($this),
        ]);
        $this->eventManager = $eventManager;
    }
}