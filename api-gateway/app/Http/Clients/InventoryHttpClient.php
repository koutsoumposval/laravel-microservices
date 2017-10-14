<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class InventoryHttpClient
 * @package App\Http\Clients
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class InventoryHttpClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * UserHttpClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'inventory/']);
    }

    /**
     * @param array $products
     * @return Collection
     */
    public function getProducts(array $products): Collection
    {
        try {
            $res = [];
            foreach ($products as $product){
              $res[$product] = json_decode($this->client->get(sprintf('product/%d', $product))
                  ->getBody()
                  ->getContents());
            }
        } catch (BadResponseException $exception) {
            throw new HttpException(
                $exception->getCode(),
                json_decode($exception->getResponse()->getBody()->getContents())
            );
        }

        return new Collection($res);
    }
}