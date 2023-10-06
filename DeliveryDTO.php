<?php

class DeliveryDTO
{
    public string $from;
    public string $to;
    public int $weight;



    public function validate(): bool
    {
        if (empty($this->from)) {
            throw new Exception('Не указан город отправления');
        }

        if (empty($this->to)) {
            throw new Exception('Не указан город назначения');
        }

        if (empty($this->weight)) {
            throw new Exception('Не указан вес');
        }

        return true;
    }

    public function load($request): void
    {
        if (!isset($request->from)) {
            throw new Exception('Отсутствует параметр from');
        }
        if (!isset($request->to)) {
            throw new Exception('Отсутствует параметр to');
        }
        if (!isset($request->weight)) {
            throw new Exception('Отсутствует параметр weight');
        }
        $this->from = $request->from;
        $this->to = $request->to;
        $this->weight = $request->weight;
    }
}