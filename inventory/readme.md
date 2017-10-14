# Simple inventory web service

A simple inventory web service build on Laravel Lumen.

This web service is part of the `koutsoumposval/laravel-microservices` demo project

Data
-----------
It holds 3 products hardcoded in the `ProductController`:
```php
    [
        "1" => "Product 1",
        "2" => "Product 2",
        "3" => "Product 3",
    ]
```

Endpoints
-----------
There are 2 API endpoints which are returning JSON Responses.

```
   # Returns all products
   GET /product 
   
   # Returns spesific product by id
   # or returns 404 'Product not found'
   # if product does not exist
   GET /product/{id}
```