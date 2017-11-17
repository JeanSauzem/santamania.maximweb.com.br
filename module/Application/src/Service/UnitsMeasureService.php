<?php

namespace Application\Service;

use Application\Service\AbstractService;
use Application\Entity\AbstractEntity;

class UnitsMeasureService extends AbstractService
{
    protected $entity = \Application\Entity\UnitsMeasure::class;

    public function create(Array $data): AbstractEntity
    {
        return parent::create($data);
    }

    public function update(int $id, Array $data): AbstractEntity
    {
        return parent::update($id, $data);
    }

    public function delete(Array $data): AbstractEntity
    {   
        $entity = $this->entityManager->getRepository($this->entity)->findOneBy($data);
        if ($entity) {
            $this->entityManager->getConnection()->beginTransaction();
            $this->getEventManager()->trigger('deleteProduct', $this, ['entity' => $entity]);
            $entity = parent::delete(['id' => $entity->getId() ]);
            $this->entityManager->getConnection()->commit();
        }
        return $entity;
    }
}