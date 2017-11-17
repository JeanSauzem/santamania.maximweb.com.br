<?php

namespace Application\Service;

use Application\Entity\AbstractEntity;
use Application\Service\AbstractService;


class CounterService extends AbstractService
{
    protected $entity = \Application\Entity\Counter::class;

    public function create(Array $data): AbstractEntity
    {

        $entity = parent::create($data);
        $this->getEventManager()->trigger('createProductCheck', $this, ['entity' => $entity]);
        return $entity;
    }
    public function check( $data): bool
    {
        $dates = parent::findBy([]);
        foreach ($dates as $date){
            if(date_format($date->getDate(),"d-m-Y")== date_format($data,"d-m-Y")){
                return false;
            }
        }

        return true;
    }
    public function delete(Array $data): AbstractEntity
    {
        $entity = $this->entityManager->getRepository($this->entity)->findOneBy($data);
        if ($entity) {
            $this->entityManager->getConnection()->beginTransaction();
            $this->getEventManager()->trigger('deleteProductCheck', $this, ['entity' => $entity]);
            $entity = parent::delete(['id' => $entity->getId() ]);
            $this->entityManager->getConnection()->commit();
        }

        return $entity;
    }
    public function checkDate($date){
        $date1 = explode('/',$date);
        return checkdate((int)$date[1],(int)$date1[0],(int)$date1[2]);
    }
    public function update(int $id, Array $data): AbstractEntity
    {
        return parent::update($id, $data);
    }
}
