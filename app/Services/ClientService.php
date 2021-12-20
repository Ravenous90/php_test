<?php


namespace App\Services;


use App\Models\Client;
use App\Services\Interfaces\ClientSourceTypeInterface;
use App\Services\Interfaces\LoggerInterface;


class ClientService
{
    private $logger;
    private $clientSource;

    public function __construct(LoggerInterface $logger, ClientSourceTypeInterface $clientSource)
    {
        $this->logger = $logger;
        $this->clientSource = $clientSource;
    }

    public function saveClient(): bool
    {
        $name = $this->clientSource->getName();

        $firstName = $this->getFirstName($name);
        $lastName = $this->getLastName($name);
        $shopId = $this->getShopId();

        if ($firstName !== '' && $lastName !== '' && $shopId !== 0) {
            $client = new Client();
            $client->first_name = $firstName;
            $client->last_name = $lastName;
            $client->shop_id = $shopId;
            $client->save();

            if ($client->id !== 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getFirstName(string $name = ''): string
    {
        $searchIndex = strpos($name, ' ');

        if ($searchIndex === false) return '';

        $firstName = substr($name, 0, $searchIndex);

        return $firstName;
    }

    public function getLastName(string $name = ''): string
    {
        $searchIndex = strpos($name, ' ');

        if ($searchIndex === false) return '';

        $lastName = substr($name, $searchIndex + 1);

        return $lastName;
    }

    public function getShopId(): int
    {
        $shopId = random_int(0, 5000);

        if (!$this->isExistsShopId($shopId)) {
            return $shopId;
        } else {
            return 0;
        }

    }

    protected function isExistsShopId(int $shopId = 0)
    {
        $result = false;

        Client::all()->pluck('shop_id')->map(function ($item) use ($shopId, &$result) {
            if ($shopId === $item) {
                $result = true;

                return false;
            } else {
                return true;
            }
        });

        return $result;
    }

    public function getOrdersSum(array $timestampsPeriod = []): int
    {
        // getting sum of orders

        $result = 25;

        return $result;
    }

}