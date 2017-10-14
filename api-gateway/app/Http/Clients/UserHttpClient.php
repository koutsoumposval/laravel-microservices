<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class UserHttpClient
 * @package App\Http\Clients
 * @author Chrysovalantis Koutsoumpos <chrysovalantis.koutsoumpos@devmob.com>
 */
class UserHttpClient
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
        $this->client = new Client(['base_uri' => 'user/']);
    }

    /**
     * @param string $user
     * @return string
     */
    public function getUser(string $user): string
    {
        try {
            $res = $this->client->get(sprintf('user/%d', $user));
        } catch (BadResponseException $exception) {
            throw new HttpException(
                $exception->getCode(),
                json_decode($exception->getResponse()->getBody()->getContents())
            );
        }

        return json_decode($res->getBody()->getContents());
    }
}