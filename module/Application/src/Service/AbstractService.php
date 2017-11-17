<?php

namespace Application\Service;

use Application\Entity\AbstractEntity;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

use Zend\{
    Hydrator\ClassMethods,
    Paginator\Adapter\ArrayAdapter,
    Paginator\Paginator
};

use Zend\EventManager\{
    EventManager,
    EventManagerAwareInterface,
    EventManagerInterface
};

abstract class AbstractService implements EventManagerAwareInterface
{
    /**
     * @var EventManagerInterface
     */
    protected $eventManager;
    /**
     * @var ContainerInterface
     */
    protected $container;
    /**
     * @var EntityManager
     */
    protected $entityManager;

    protected $entity;

    protected $account = false;

    /**
     * AbstractService constructor.
     * @param ContainerInterface $container
     * @param EntityManager $entityManager
     */
    public function __construct(ContainerInterface $container, EntityManager $entityManager)
    {
        $this->container     = $container;
        $this->entityManager = $entityManager;
    }


    /**
     * Retornar todos os registros com paginação.
     *
     * @param null $page
     * @param array $params
     * @return mixed
     */
    public function fetchAll($page = null, Array $params = [], Array $orderBy = null, $limit = null, $offset = null)
    {
        if ($this->account)
            $params = array_merge($params, ['account' => $this->container->get(\Accounts\Service\UsersAccountsService::class)->getUserAccount()]);

        $list      = $this->entityManager->getRepository($this->entity)->findBy($params, $orderBy, $limit, $offset);
        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)->setDefaultItemCountPerPage(20);

        return $paginator;
    }

    /**
     * Criar os registros no Banco de Dados.
     *
     * @return mixed
     */
    public function create(Array $data): AbstractEntity
    {
        $entity = new $this->entity($data);      
        if (method_exists($entity, 'setCode'))
            $entity->setCode($this->getCodeHash());

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        $this->getEventManager()->trigger('create', $this, ['entity' => $entity, 'module' => $this->entity]);

        return $entity;
    }

    public function update(int $id, Array $data): AbstractEntity
    {
        $entity = $this->entityManager->getReference($this->entity, $id);

        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $entity);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        $this->getEventManager()->trigger('update', $this, ['entity' => $entity, 'module' => $this->entity]);

        return $entity;
    }

    /**
     * Retornar registro pelo ID.
     *
     * @param $id
     * @return mixed
     */
    public function find(int $id): AbstractEntity
    {
        $id = (int)$id;

        $row = $this->entityManager->getRepository($this->entity)->find($id);

        if (!$row)
            return false;

        return $row;
    }

    /**
     * Retornar todos os registros sem paginação.
     *
     * @param array $params
     * @return mixed
     */
    public function findBy(Array $params = [], Array $orderBy = null, $limit = null)
    {
        if ($this->account)
            $params = array_merge($params, ['account' => $this->container->get(\Accounts\Service\UsersAccountsService::class)->getUserAccount()]);

        return $this->entityManager->getRepository($this->entity)->findBy($params, $orderBy, $limit);
    }

    /**
     * Retornar somente um registro.
     *
     * @param array $params
     * @return mixed
     */
    public function findOneBy(Array $params = [])
    {
        return $this->entityManager->getRepository($this->entity)->findOneBy($params);
    }

    /**
     * Deletar um registro no Banco de Dados
     *
     * @param array $data
     * @return mixed
     */
    public function delete(Array $data): AbstractEntity
    {
        $entity = $this->entityManager->getRepository($this->entity)->findOneBy($data);
        if ($entity) {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            $this->getEventManager()->trigger('delete', $this, ['entity' => $entity]);

            return $entity;
        }

        return false;
    }

    /**
     * Retornar os registros em pares array.
     *
     * @param $object
     * @param $columnKey
     * @param $columnValue
     * @return mixed
     */
    public function findPairs($object, $columnKey, $columnValue)
    {
        $separateKey = explode('_', strtolower($columnKey));
        $columnKey   = 'get' . implode('', array_map('ucfirst', $separateKey));

        if (is_string($columnValue)) {
            $separateValue = explode('_', strtolower($columnValue));
            $columnValue   = 'get' . implode('', array_map('ucfirst', $separateValue));
        }
        if (is_array($columnValue)) {

            $tempValue = [];
            foreach ($columnValue as $value) {
                $separate    = explode('_', strtolower($value));
                $tempValue[] = 'get' . implode('', array_map('ucfirst', $separate));
            }

            $columnValue = $tempValue;
        }

        $data = [];
        if ($object) {
            foreach ($object as $item) {

                $values = '';

                if (is_string($columnValue)) {
                    $values = $item->$columnValue();
                }

                if (is_array($columnValue)) {

                    $values = [];
                    foreach ($columnValue as $value) {
                        $values[] = $item->$value();
                    }

                    $values = implode(' ', $values);
                }

                $data[$item->$columnKey()] = $values;
            }
        }

        return $data;
    }

    public function getCodeHash()
    {
        $bytes = \Zend\Math\Rand::getBytes(32);

        return substr(md5($bytes), 0, 15);
    }

//    public function getUserAccout()
//    {
//        /** @var \Auth\Service\AuthService $authService */
//        $authService = $this->container->get(\Auth\Service\AuthService::class);
//        /** @var \Application\Entity\Users $user */
//        $user = $authService->getIdentity();
//
//        $this->container->get
//
//        echo "<pre>";
//        print_r($user->getId());
//        echo "</pre>";
//        exit();
//    }

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