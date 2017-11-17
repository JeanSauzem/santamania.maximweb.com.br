<?php

namespace Application\Service;

use Application\Entity\AbstractEntity;
use Application\Service\AbstractService;

class ChecklistService extends AbstractService
{
    protected $entity = \Application\Entity\Checklist::class;

    public function create(Array $data): AbstractEntity
    {
        if (isset($data['product']))
            $data['product'] = $this->entityManager->getReference(\Application\Entity\Products::class, $data['product']);

        if (isset($data['warehouse']))
            $data['warehouse'] = $this->entityManager->getReference(\Application\Entity\Warehouses::class, $data['warehouse']);

        $Checklists = $this->findBy(['product' => $data['product'], 'warehouse' => $data['warehouse'] ]);
        if($Checklists)
        {
            $nowDate =date_create(date("Y-m-d H:i:s"));
            date_timezone_set($nowDate, timezone_open('America/Sao_Paulo'));
            foreach ($Checklists as $Checklist) {
                $DateCheckList = $Checklist->getCreatedAt();
                date_timezone_set($DateCheckList, timezone_open('America/Sao_Paulo'));
                    if(date_format($DateCheckList,"d-m-Y") == date_format($nowDate,"d-m-Y") ){
                        $data['quantity'] = $Checklist->getQuantity() + $data['quantity'];
                        return parent::update($Checklist->getId(), $data);
                    }
            }
        } else{
            return parent::create($data);
        }
         
        return parent::create($data);
    }

    public function update(int $id, Array $data): AbstractEntity
    {
        if (isset($data['product']))
            $data['product'] = $this->entityManager->getReference(\Application\Entity\Products::class, $data['product']);

        if (isset($data['warehouse']))
            $data['warehouse'] = $this->entityManager->getReference(\Application\Entity\Warehouses::class, $data['warehouse']);

        return parent::update($id, $data);
    }
}