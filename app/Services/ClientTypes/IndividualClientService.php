<?php


namespace App\Services\ClientTypes;


use App\Services\ClientService;
use App\Services\Interfaces\BankPaymentInterface;
use App\Services\Interfaces\CashPaymentInterface;

class IndividualClientService extends ClientService implements CashPaymentInterface, BankPaymentInterface
{
    public function getOrdersSum(array $timestampsPeriod = []): int
    {
        // getting orders for single clients

        $result = 15;

        return $result;
    }

    public function payCash()
    {
        // TODO: Implement payCash() method.
    }

    public function payCashCOD()
    {
        // TODO: Implement payCashCOD() method.
    }

    public function payBank()
    {
        // TODO: Implement payBank() method.
    }
}