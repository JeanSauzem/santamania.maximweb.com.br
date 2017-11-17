<?php

namespace Application\Service;

use Application\Entity\AbstractEntity;
use Application\Service\AbstractService;

class TotalReportService extends AbstractService
{
    protected $entity = \Application\Entity\TotalReport::class;

    public function create(Array $data): AbstractEntity
    {
        $ProductService = $this->container->get(\Application\Service\ProductsService::class);
        $ProdutionService =  $this->container->get(\Application\Service\ProdutionService::class);
        $checkListService =  $this->container->get(\Application\Service\ChecklistService::class);

       $nowDate = date_create(date("Y-m-d H:i:s"));
       date_timezone_set($nowDate, timezone_open('America/Sao_Paulo'));
       $nowDate =  date_format($nowDate,"d-m-Y");


       $dateBefore = date_create($nowDate);
       date_timezone_set($dateBefore, timezone_open('America/Sao_Paulo'));
       date_modify($dateBefore,'-1 day');
       $dateBefore = date_format($dateBefore,"d-m-Y");


        $checklists =  $checkListService->findBy([]);
       
        $ArraychecklistQtd = [];
        $ArraychecklistQtdBefore = [];

        foreach($checklists as $checklist){
            $dateChecklistList = $checklist->getCreatedAt();
            $dateChecklistList = date_format( $dateChecklistList,"d-m-Y");
                if($dateChecklistList == $nowDate){
                   $ArraychecklistQtd[]=[
                        'quantity'=> $checklist->getQuantity(),
                        'product' => $checklist->getProduct()->getId()
                   ];
                }
                if($dateChecklistList == $dateBefore){
                    $ArraychecklistQtdBefore[]=[
                        'quantity'=> $checklist->getQuantity(),
                        'product' => $checklist->getProduct()->getId()
                    ];
                }
         }
  
        //pega quantidade anterior da produção referente a data anterior e produto
        $produtions = $ProdutionService->findBy([]);

       $produtionArray=[];
        foreach($produtions as $prodution){
            $dateProdutionList = $prodution->getCreatedAt();
            $dateProdutionList = date_format( $dateProdutionList,"d-m-Y");
            if($dateProdutionList == $nowDate){
                $produtionArray []= [
                    'quantity' => $prodution->getQuantity(),
                    'product' => $prodution->getProduct()->getId()
                ];
            }

        }

        $Products = $ProductService->findBy([]);
        $produtionQtd = 0;
        $checklistQtdValue = 0;
        $checklistQtdBeforeValue = 0;
        foreach ($Products as $Product) {
            foreach ($produtionArray as $prod) {
                if($prod['product'] == $Product->getId()){
                    $produtionQtd = $produtionQtd + $prod['quantity'];
                }
            }
            foreach ($ArraychecklistQtd as $checklistqtd) {
                if($checklistqtd['product'] == $Product->getId()){
                    $checklistQtdValue = $checklistQtdValue + $checklistqtd['quantity'];
                }
            }
            foreach ($ArraychecklistQtdBefore as $checklistQtdBefore) {
                if($checklistQtdBefore['product'] == $Product->getId()){
                    $checklistQtdBeforeValue= $checklistQtdBeforeValue+$checklistQtdBefore['quantity'];
                }
            }
            $total = $produtionQtd+$checklistQtdValue;
            $different = $checklistQtdBeforeValue - $checklistQtdValue + $produtionQtd;

            $total = [
                'total' => $total,
                'different' =>$different,
                'subTotal' => $checklistQtdValue,
                'product' =>$this->entityManager->getReference(\Application\Entity\Products::class, $Product->getId())
            ];
           $entity = parent::create($total);
           $produtionQtd =0;
           $checklistQtdValue = 0;
           $checklistQtdBeforeValue = 0;
           $total = 0;
           $different =0;
        }

        return $entity;
    }

    public function update(int $id, Array $data): AbstractEntity
    {
        if (isset($data['product']))
            $data['product'] = $this->entityManager->getReference(\Application\Entity\Products::class, $data['product']);
        return parent::update($id, $data);
    }
}