<?php

use DeliveryCompany\DeliveryCompany;

class DeliveryService
{

    private $deliveryCompanyList;

    private $basePrice = 150;


    public function __construct(array $deliveryCompanyList)
    {
        foreach ($deliveryCompanyList as $deliveryCompany) {

            $nameSpaseHelper = '\deliveryCompany\\' . $deliveryCompany['name'];
            $newClass = new $nameSpaseHelper;
            $newClass->setId($deliveryCompany['id']);

            if ($newClass instanceof DeliveryCompany) {
                $this->deliveryCompanyList[] = $newClass;
            }
        }
        if (empty($this->deliveryCompanyList)) {
            throw new Exception('Нет активных компаний');
        }
    }


    public function fastDelivery(string $from, string $to, int $weight): array
    {
        $result = [];
        foreach ($this->deliveryCompanyList as $deliveryCompany) {
            $jsonData = $deliveryCompany->fastDelivery($from, $to, $weight);
            $data = json_decode($jsonData, true);
            $date = new DateTime();
            $date->add(DateInterval::createFromDateString("{$data['period']} day"));
            if (!empty($data['error'])) {
                $result[] = [
                    'price'=>0.0,
                    'date'=>0,
                    'error'=>$data['error']
                ];
                continue;
            }

            $result[] = [
                'price'=>$data['price'],
                'date'=>$data['period'],
                'error'=>$data['error']
            ];
        }

        return $result;
    }


    public function slowDelivery(string $from, string $to, int $weight): array
    {
        $result = [];
        foreach ($this->deliveryCompanyList as $deliveryCompany) {
            $jsonData = $deliveryCompany->slowDelivery($from, $to, $weight);
            $data = json_decode($jsonData, true);
            if (!empty($data['error'])) {
                $result[] = [
                    'price'=>0.0,
                    'date'=>0,
                    'error'=>$data['error'],
                ];
                continue;
            }
            $result[] = [
                'price'=>$data['coefficient'] * $this->basePrice,
                'date'=>$data['date'],
                'error'=>$data['error']
            ];
        }
        return $result;
    }
}