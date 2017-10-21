<?php

namespace Application\Service;

use Application\Entity\AbstractEntity;
use Application\Service\AbstractService;

class ProductStatusService extends AbstractService
{
    protected $entity = \Application\Entity\ProductStatus::class;

    public function create(Array $data): AbstractEntity
    {
        $data['account'] = $this->container->get(\Accounts\Service\UsersAccountsService::class)->getUserAccount();

        return parent::create($data);
    }

    public function update(int $id, Array $data): AbstractEntity
    {
        $data['account'] = $this->container->get(\Accounts\Service\UsersAccountsService::class)->getUserAccount();

        return parent::update($id, $data);
    }
}