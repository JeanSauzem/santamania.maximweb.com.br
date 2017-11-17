<?php

namespace Application\Service;

use Application\Entity\AbstractEntity;
use Application\Service\AbstractService;

class ProdutionService extends AbstractService
{
    protected $entity = \Application\Entity\Prodution::class;

    public function create(Array $data): AbstractEntity
    {
        if (isset($data['product']))
            $data['product'] = $this->entityManager->getReference(\Application\Entity\Products::class, $data['product']);

        $Produtions = $this->findBy(['product' => $data['product']]);
        if($Produtions){
            $nowDate = date_create(date("Y-m-d H:i:s"));
            date_timezone_set($nowDate, timezone_open('America/Sao_Paulo'));
            foreach ($Produtions as $Prodution) {
                $dateProdution = $Prodution->getCreatedAt();
                date_timezone_set($dateProdution, timezone_open('America/Sao_Paulo'));
                    if(date_format($dateProdution,"d-m-Y") == date_format($nowDate,"d-m-Y") ){
                        $data['quantity'] = $Prodution->getQuantity() + $data['quantity'];
                        return parent::update($Prodution->getId(), $data);    
                    }
            }
        }else{
           return parent::create($data);
        }  
        return parent::create($data);    
    }

    public function update(int $id, Array $data): AbstractEntity
    {
        if (isset($data['product']))
            $data['product'] = $this->entityManager->getReference(\Application\Entity\Products::class, $data['product']);
        return parent::update($id, $data);
    }

    public function findTotalProdutionToday($date){
        $quantity = 0;
        $produtions = parent::findBy([]);
        foreach($produtions as $prodution){
             $dateProdution = $prodution->getCreatedAt();
            date_timezone_set($dateProdution, timezone_open('America/Sao_Paulo'));
            if(date_format($dateProdution,"d-m-Y") == $date )
                $quantity = $quantity + $prodution->getQuantity();
        }

        return $quantity;
    }
}