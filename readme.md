# Laravel Microservices

A simple laravel microservices demo project.

This project consists of three web services `user`, `product` & `order` and 
one API gateway `api-gateway`.

The webservices are containerised with Docker and are accessible within a
Traefik proxy interface. 

`traefik` image is used for the proxy container and `php:7.1-apache` is used and extended
for the web services containers & the API gateway

The `api` is using the Guzzle API Client in order to maintain connection with the web services.

Set up
------------
Create a docker-machine *
```
    docker-machine create laravel-microservices
    eval $(docker-machine env laravel-microservices)
```

Build
```
    docker-compose -f docker/docker-compose.yml up -d --build
```

Teardown
```
    docker-compose -f docker/docker-compose.yml down --volumes --remove-orphans
```

Create the external network
```
    docker network create traefik_webgateway
```

Update the your hosts
```
    # Get the ip of the VMachine
    docker-machine ip laravel-microservices
    
    # Update /etc/hosts file
    192.168.99.100 lm.dev user.lm.dev inventory.lm.dev order.lm.dev api.lm.dev
```

Scale
```
    # DEPRECATED
    docker-compose -f docker/docker-compose.yml scale ${container-name}
```

Access
------------
You can access the applications from:
```
    #user
    user.lm.dev
    
    #inventory
    inventory.lm.dev
    
    #order
    order.lm.dev
    
    #api gateway
    api.dev
```

You can access Traefik interface from:
```
    lm.dev:8080
```

Isolate Web Services
------------
Removing the `traefik.frontend.rule` from the Web services will make
them accesible only from the API gateway (traefik backend network)

