<?php

namespace App\Http\Factories;

use App\Http\Clients\InventoryHttpClient;
use App\Http\Clients\OrderHttpClient;
use App\Http\Clients\UserHttpClient;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class OrderFactory
 * @package App\Http\Factories
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class OrderFactory
{
    /**
     * @var UserHttpClient
     */
    private $userClient;

    /**
     * @var OrderHttpClient
     */
    private $orderClient;

    /**
     * @var InventoryHttpClient
     */
    private $inventoryClient;

    /**
     * OrderFactory constructor.
     */
    public function __construct()
    {
        $this->userClient = new UserHttpClient();
        $this->orderClient = new OrderHttpClient();
        $this->inventoryClient = new InventoryHttpClient();
    }

    /**
     * @param string $userId
     * @return Collection
     */
    public function retrieveUserOrders(string $userId): Collection
    {
        try {
            $data = [];

            $user=[];
            $user["id"] = $userId;
            $user["name"] = $this->userClient->getUser($userId);
            $data["user"] = $user;

            // lot of optimization can be done here
            // this is just a simple example
            $res = [];
            foreach ($this->orderClient->getUserOrders($userId) as $orderId => $order) {
                if (array_key_exists("products", $order)) {
                    $res[$orderId] = $this->inventoryClient->getProducts($order["products"])->toArray();
                };
            }
            $data["orders"] = $res;

        }catch (HttpException $exception) {
            throw new HttpException($exception->getStatusCode(), $exception->getMessage());
        }

        return new Collection($data);
    }
}