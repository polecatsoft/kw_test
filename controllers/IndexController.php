<?php

class IndexController extends CController
{

    public function index()
    {
        $this->render('main/index', ['user' => $this->initData()]);
    }

    public function clear_data()
    {
        unset($_SESSION['data']);
        $this->redirect(Core::app()->request()->baseUrl());
    }

    public function increase_balance()
    {
        $user = $this->initData();

        $balance = Requests::getPostVar('balance', 0);

        $user->setBalance($balance);

        $this->saveData($user->toArray());

        $this->render('main/index', ['user' => $user]);
    }

    public function paid_service()
    {
        $user = $this->initData();

        $serviceId = Requests::getPostVar('service_id', 0);
        $data = ['user' => $user];

        $service = $user->getService($serviceId);

        if ($service === false) {
            $data['error'] = 'Undefined Service';
        } elseif ($user->getBalance() < $service->getAmount()) {
            $data['error'] = 'Insufficient funds!';
        } else {
            $service->setPaid(true);
            $user->setBalance($user->getBalance() - $service->getAmount());
            $this->saveData($user->toArray());
        }

        $this->render('main/index', $data);
    }

    private function saveData($data)
    {
        $_SESSION['data'] = json_encode($data);
    }

    private function initData()
    {
        if (!empty($_SESSION['data'])) {
            $data = json_decode($_SESSION['data'], true);
        } else {
            $data = [
                'user' => [
                    'id' => 1,
                    'name' => 'John Doe',
                    'balance' => 0
                ],
                'services' => [
                    [
                        'id' => 1,
                        'name' => 'Service A',
                        'amount' => 100,
                        'paid' => false
                    ],
                    [
                        'id' => 2,
                        'name' => 'Service B',
                        'amount' => 200,
                        'paid' => false
                    ]
                ]
            ];
        }

        $user = new User($data['user']);

        foreach ($data['services'] as $service) {
            $user->addService(new Service($service));
        }
        return $user;
    }
}
