<?php


namespace App\Services\ClientTypes;


use App\Services\ClientService;
use App\Services\Interfaces\BankPaymentInterface;
use App\Services\Interfaces\CashPaymentInterface;
use App\Services\Interfaces\InvoicePaymentInterface;

class OrganizationClientService extends ClientService implements CashPaymentInterface, BankPaymentInterface, InvoicePaymentInterface
{
    public function getOrdersSum(array $timestampsPeriod = []): int
    {
        // getting sum of orders for organizations

        $result = 20;

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

    public function payInvoice()
    {
        // TODO: Implement payInvoice() method.
    }

}