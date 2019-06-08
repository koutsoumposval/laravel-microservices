# Simple inventory web service

A simple inventory web service build on Laravel Lumen.

This web service is part of the `koutsoumposval/laravel-microservices` demo project

Setup
-----------
#### Install vendor dependencies with Composer
Navigate to service's root directory:
```bash
cd inventory/
```

To install all composer dependencies, run the following command:
```bash
docker run --rm -v $(PWD):/app -v $($HOME)/.composer:/composer --user $(id -u):$(id -g) composer install --optimize-autoloader --no-interaction --no-progress --no-scripts
```


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
   GET http://inventory.lm.local/product 
   
   # Returns spesific product by id
   # or returns 404 'Product not found'
   # if product does not exist
   GET http://inventory.lm.local/product/{id}
```