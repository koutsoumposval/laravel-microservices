# API Gateway

A simple web API gateway build on Laravel Lumen.

This application is part of the `koutsoumposval/laravel-microservices` demo project

Setup
-----------
#### Install vendor dependencies with Composer
Navigate to service's root directory:
```bash
cd api-gateway/
```

To install all composer dependencies, run the following command:
```bash
docker run --rm -v $(PWD):/app -v $($HOME)/.composer:/composer --user $(id -u):$(id -g) composer install --optimize-autoloader --no-interaction --no-progress --no-scripts
```

Endpoints
-----------
There is 1 endpoint which is returning JSON Responses.

```
   # Returns all orders by a user id
   # or returns 404 'User not found'
   # or returns 404 'No orders found for this user'
   GET user/{id}/orders
```

Example Response
-----------
```
    # GET http://api.lm.local/user/1/orders
    {
        "user": {
            "id": "1",
            "name": "User 1"
        },
        "orders": {
            "1": {
                "1": "Product 1",
                "2": "Product 2"
            },
            "2": {
                "3": "Product 3"
            }
        }
    }
```