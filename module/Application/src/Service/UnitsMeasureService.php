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
}