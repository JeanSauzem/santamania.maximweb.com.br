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
}