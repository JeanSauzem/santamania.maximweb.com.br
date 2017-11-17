<?php

namespace Application\Service;


use Application\Entity\AbstractEntity;
use Application\Service\AbstractService;

class QuantityWarehouseService extends AbstractService
{
    protected $entity = \Application\Entity\QuantityWarehouse::class;

    public function create(Array $data): AbstractEntity
    {

        foreach ($data['name'] as $key => $value) {
            $info = [
                'idWarehouses' => $this->entityManager->getReference(\Application\Entity\Warehouses::class, $key),
                'quantity' => $value,
                'idProductChecked' => $this->entityManager->getReference(\Application\Entity\ProductCheck::class, $data['productCheck'])
            ];
            $entity = parent::create($info);
        }
        $this->getEventManager()->trigger('updateProductCheck', $this, ['entity' => $entity]);
        return $entity;
    }

    public function update1(Array $data): AbstractEntity
    {
        foreach ($data['name'] as $key => $value) {
            $info = [
                'idWarehouses' => $this->entityManager->getReference(\Application\Entity\Warehouses::class, $key),
                'quantity' => $value,
                'idProductChecked' => $this->entityManager->getReference(\Application\Entity\ProductCheck::class, $data['productCheck'])
            ];
            $entity = parent::update((int)$data['hidden'][$key], $info);
        }
        $this->getEventManager()->trigger('updateProductCheck', $this, ['entity' => $entity]);
        return $entity;
    }

    public function validNumber($data)
    {
        foreach ($data['name'] as $key => $value) {
            if (!is_null($value) && ctype_digit($value)) {
                print_r('numero');
            } else {
                return true;
            }
        }
       return true;
    }
}