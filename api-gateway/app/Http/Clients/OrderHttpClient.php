<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class OrderHttpClient
 * @package App\Http\Clients
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class OrderHttpClient
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
        $this->client = new Client(['base_uri' => 'order/']);
    }

    /**
     * @param string $user
     * @return Collection
     */
    public function getUserOrders(string $user): Collection
    {
        try {
            $res = $this->client->get(sprintf('order/user/%d', $user));
        } catch (BadResponseException $exception) {
            throw new HttpException(
                $exception->getCode(),
                json_decode($exception->getResponse()->getBody()->getContents())
            );
        }

        return new Collection(json_decode($res->getBody()->getContents(), true));
    }
}