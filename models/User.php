<?php
class User {
    private $id;
    private $name;
    private $balance;
    /**
     * @var Service[]
     */
    private $services = [];

    public function __construct($attributes) {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->balance = $attributes['balance'];
    }

    public function getName() {
        return $this->name;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function setBalance($balance) {
        $this->balance = (int)$balance;
    }

    public function getServices() {
        return $this->services;
    }

    /**
     * @param Service $service
     */
    public function addService($service) {
        $this->services[$service->getId()] = $service;
    }

    public function getService($id) {
        if (isset($this->services[$id])) {
            return $this->services[$id];
        }
        return false;
    }

    public function toArray() {
        $data = [
            'user' => [
                'id' => $this->id,
                'name' =>  $this->name ,
                'balance' => $this->balance
            ],
            'services' => []
        ];
        foreach ($this->services as $service) {
            $data['services'][] = $service->toArray();
        }

        return $data;
    }
}