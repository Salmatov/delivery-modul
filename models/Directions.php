<?php

namespace models;

class Directions
{
    public array $direction = [];

    protected $directionsDB = [
        [
            'deliveryCompanyId'=>1,
            'from'=>'Москва',
            'to'=>'Санкт-Петербург',
            'price'=>200,
            'coefficient'=>1.1,
            'daysToDelivery'=>1
        ],
        [
            'deliveryCompanyId'=>1,
            'from'=>'Москва',
            'to'=>'Архангельск',
            'price'=>210,
            'coefficient'=>1.2,
            'daysToDelivery'=>2
        ],
        [
            'deliveryCompanyId'=>1,
            'from'=>'Москва',
            'to'=>'Краснодар',
            'price'=>220,
            'coefficient'=>1.3,
            'daysToDelivery'=>3
        ],
        [
            'deliveryCompanyId'=>1,
            'from'=>'Москва',
            'to'=>'Волгоград',
            'price'=>230,
            'coefficient'=>1.4,
            'daysToDelivery'=>4
        ],
        [
            'deliveryCompanyId'=>1,
            'from'=>'Москва',
            'to'=>'Сочи',
            'price'=>240,
            'coefficient'=>1.5,
            'daysToDelivery'=>5
        ],
        [
            'deliveryCompanyId'=>2,
            'from'=>'Москва',
            'to'=>'Санкт-Петербург',
            'price'=>200,
            'coefficient'=>1.1,
            'daysToDelivery'=>1
        ],
        [
            'deliveryCompanyId'=>2,
            'from'=>'Москва',
            'to'=>'Архангельск',
            'price'=>270,
            'coefficient'=>1.5,
            'daysToDelivery'=>5
        ],
        [
            'deliveryCompanyId'=>2,
            'from'=>'Москва',
            'to'=>'Краснодар',
            'price'=>220,
            'coefficient'=>1.3,
            'daysToDelivery'=>3
        ],
        [
            'deliveryCompanyId'=>2,
            'from'=>'Москва',
            'to'=>'Волгоград',
            'price'=>230,
            'coefficient'=>1.4,
            'daysToDelivery'=>4
        ],
        [
            'deliveryCompanyId'=>2,
            'from'=>'Москва',
            'to'=>'Сочи',
            'price'=>240,
            'coefficient'=>1.5,
            'daysToDelivery'=>5
        ],
        [
            'deliveryCompanyId'=>3,
            'from'=>'Москва',
            'to'=>'Сочи',
            'price'=>240,
            'coefficient'=>1.5,
            'daysToDelivery'=>5
        ],
    ];


    public function getDirectionByFromAndToAndDeliveryCompanyId(string $from, string $to, int $deliveryCompanyId): array
    {
        foreach ($this->directionsDB as $direction) {
            if ($direction['from'] == $from && $direction['to'] == $to && $direction['deliveryCompanyId'] == $deliveryCompanyId) {
                $this->direction = $direction;
            }
        }
        return $this->direction;

    }
}