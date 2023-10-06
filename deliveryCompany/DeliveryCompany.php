<?php

namespace DeliveryCompany;

abstract class DeliveryCompany
{
    public $id;
    protected $startWorkTime;
    protected $endWorkTime;
    protected $direction;

    abstract public function fastDelivery(string $from, string $to, int $weight): string;
    abstract public function slowDelivery(string $from, string $to, int $weight): string;


    public function isWorkTime(): bool
    {
        if (date('H') > $this->endWorkTime || date('H') < $this->startWorkTime) {
            return false;
        }
        return true;
    }


    public function setWorkTime(int $startWorkTime, int $endWorkTime): void
    {
        $this->startWorkTime = $startWorkTime;
        $this->endWorkTime = $endWorkTime;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

}
