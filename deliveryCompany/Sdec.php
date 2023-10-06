<?php

namespace DeliveryCompany;

use DateInterval;
use DateTime;
use models\Directions;

class Sdec extends DeliveryCompany
{


    public function fastDelivery(string $from, string $to, int $weight):string
    {

        if ($this->isWorkTime()) {
            $result = [
                'price' => 0.0,
                'period' => 0,
                'error' => 'Доставку возможно оформить только с 9:00 до 18:00'
            ];
            return json_encode($result);
        }

        $direction = (new Directions)->getDirectionByFromAndToAndDeliveryCompanyId($from, $to, $this->id);

        if (empty($direction)) {
            $result = [
                'price' => 0.0,
                'period' => 0,
                'error' => 'Направление не найдено'
            ];
            return json_encode($result);

        }

        $result = [
            'price' => (float)$direction['price'],
            'period' => $direction['daysToDelivery'],
            'error' => ''
        ];

        return json_encode($result);
    }



    public function slowDelivery(string $from, string $to, int $weight):string
    {
        $result = [];

        $direction = (new Directions)->getDirectionByFromAndToAndDeliveryCompanyId($from, $to, $this->id);

        if (empty($direction)) {
            $result = [
                'coefficient'=>0.0,
                'date'=>0,
                'error'=>'Направление не найдено'
            ];
            return json_encode($result);

        }

        $date = new DateTime();
        $date->add(DateInterval::createFromDateString("{$direction['daysToDelivery']} day"));
        $result = [
            'coefficient'=>$direction['coefficient'],
            'date' => $date->format('Y-m-d'),
            'error' => ''
        ];
        return json_encode($result);
    }

}