<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class OrderController extends Controller
{
    /**
     * @var $products Collection
     */
    private $orders;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->orders = new Collection([
            "1" => ["user" => "1", "products" => ["1", "2"]],
            "2" => ["user" => "1", "products" => ["3"] ],
            "3" => ["user" => "2", "products" => ["1", "3"]],
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse($this->orders->toArray(), 200);
    }

    /**
     * @param string $order
     * @return JsonResponse
     * @internal param Request $request
     */
    public function show(string $order): JsonResponse
    {
        if (! $this->orders->get($order)){
            return new JsonResponse(
                'Order not found',
                404
            );
        }

        return new JsonResponse($this->orders->get($order), 200);
    }

    /**
     * @param string $user
     * @return JsonResponse
     * @internal param Request $request
     */
    public function showByUser(string $user): JsonResponse
    {
        $results = array_filter($this->orders->toArray(), function($order) use ($user) {
            return (is_array($order) && $order['user'] == $user);
        });

        if (empty($results)){
            return new JsonResponse(
                'No orders found for this user',
                404
            );
        }

        return new JsonResponse($results, 200);
    }

}
