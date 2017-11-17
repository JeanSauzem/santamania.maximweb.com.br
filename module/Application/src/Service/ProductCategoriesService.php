<?php

namespace Application\Service;

use Application\Entity\AbstractEntity;

class ProductCategoriesService extends AbstractService
{
    protected $entity = \Application\Entity\ProductCategories::class;

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