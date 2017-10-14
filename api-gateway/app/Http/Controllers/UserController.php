<?php
namespace App\Http\Controllers;

use App\Http\Factories\OrderFactory;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    /**
     * @param string $user
     * @return JsonResponse
     * @internal param string $order
     * @internal param Request $request
     */
    public function orders(string $user): JsonResponse
    {
        try {
            $data = (new OrderFactory())->retrieveUserOrders($user);
        }catch (HttpException $exception) {
            return new JsonResponse(
                $exception->getMessage(),
                $exception->getStatusCode()
            );
        }

        return new JsonResponse($data, 200);
    }

}
