<?php

namespace Application\Service;

use Application\Entity\AbstractEntity;
use Application\Service\AbstractService;

class ProductsService extends AbstractService
{
    protected $entity = \Application\Entity\Products::class;

    public function create(Array $data): AbstractEntity
    {
        if (isset($data['product_category']))
            $data['product_category'] = $this->entityManager->getReference(\Application\Entity\ProductCategories::class, $data['product_category']);

        if (isset($data['units_measure']))
            $data['units_measure'] = $this->entityManager->getReference(\Application\Entity\UnitsMeasure::class, $data['units_measure']);

        return parent::create($data);
    }

    public function update(int $id, Array $data): AbstractEntity
    {
        if (isset($data['product_category']))
            $data['product_category'] = $this->entityManager->getReference(\Application\Entity\ProductCategories::class, $data['product_category']);

        if (isset($data['units_measure']))
            $data['units_measure'] = $this->entityManager->getReference(\Application\Entity\UnitsMeasure::class, $data['units_measure']);

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