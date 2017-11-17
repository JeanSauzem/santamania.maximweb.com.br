<?php

namespace Application\Service;

use Application\Entity\AbstractEntity;
use Application\Service\AbstractService;


class ProductCheckService extends AbstractService
{
    protected $entity = \Application\Entity\ProductCheck::class;

    public function create(Array $data): AbstractEntity
    {
        $data['idProduct'] = $this->entityManager->getReference(\Application\Entity\Products::class, $data['idProduct']);
        $data['idCounter'] = $this->entityManager->getReference(\Application\Entity\Counter::class, $data['idCounter']);
        return parent::create($data);
    }

    public function update(int $id, Array $data): AbstractEntity
    {
        return parent::update($id, $data);
    }
}
