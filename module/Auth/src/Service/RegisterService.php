<?php

namespace Auth\Service;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

use Zend\EventManager\{
    EventManager,
    EventManagerAwareInterface,
    EventManagerInterface
};

class RegisterService implements EventManagerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * RegisterService constructor.
     * @param ContainerInterface $container
     * @param EntityManager $entityManager
     */
    public function __construct(ContainerInterface $container, EntityManager $entityManager)
    {
        $this->container     = $container;
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     * @return \Application\Entity\Users
     */
    public function register(Array $data)
    {
        /** @var \Accounts\Service\AccountsService $accountService */
        $accountService = $this->container->get(\Accounts\Service\AccountsService::class);
        /** @var \Application\Entity\Accounts $account */
        $account = $accountService->create([
            'name'           => $data['name'],
            'type'           => 1,
            'account_status' => 1,
            'language'       => 1,

        ]);

        /** @var \Users\Service\UsersService $userService */
        $userService = $this->container->get(\Users\Service\UsersService::class);
        /** @var \Application\Entity\Users $user */
        $user = $userService->create([
            'last_accessed_account' => $account->getId(),
            'firstname'             => $data['name'],
            'lastname'              => isset($data['lastname']) ? $data['lastname'] : null,
            'email'                 => $data['email'],
            'password'              => $data['password'],
            'acl_role'              => 3,
            'active'                => 0,
            'language'              => 1,
            'activation_key'        => $userService->getCodeHash(),
        ]);

        /** @var \Accounts\Service\UsersAccountsService $userAccountService */
        $userAccountService = $this->container->get(\Accounts\Service\UsersAccountsService::class);
        $userAccountService->create([
            'user'    => $user->getId(),
            'account' => $account->getId(),
        ]);

        $this->getEventManager()->trigger('account-create', $this, ['account' => $account, 'user' => $user]);

        return $user;
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