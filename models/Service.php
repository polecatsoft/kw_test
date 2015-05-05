<?php

class Service {
    private $id;
    private $paid;
    private $name;
    private $amount;

    public function __construct($attributes) {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->amount = $attributes['amount'];
        $this->paid = $attributes['paid'];
    }

    public function getName() {
        return $this->name;
    }

    public function getPaid() {
        return $this->paid;
    }

    public function setPaid($paid) {
        $this->paid = $paid;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getId()
    {
        return $this->id;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'amount' => $this->amount,
            'paid' => $this->paid
        ];
    }
}