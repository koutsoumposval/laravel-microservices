# API Gateway

A simple web API gateway build on Laravel Lumen.

This application is part of the `koutsoumposval/laravel-microservices` demo project

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
    # GET user/1/orders
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