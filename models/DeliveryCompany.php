<?php

namespace models;

class DeliveryCompany
{
    public array $deliveryCompany = [];
    const STATUS_ACTIVE = 1;

    protected $deliveryCompanyDB = [
        [
            'id'=>1,
            'name'=> 'Mtransline',
            'status'=>1,
        ],
        [
            'id'=>2,
            'name'=> 'Sdec',
            'status'=>1,
        ],
        [
            'id'=>3,
            'name'=> 'DelovieLinii',
            'status'=>0,
        ],
    ];

    public function getDeliveryCompanyActive(): array
    {
        foreach ($this->deliveryCompanyDB as $deliveryCompany){
            if ($deliveryCompany['status'] == self::STATUS_ACTIVE ){
                $this->deliveryCompany[] = ['id'=>$deliveryCompany['id'],'name'=>$deliveryCompany['name']];
            }
        }
        return $this->deliveryCompany;
    }

}