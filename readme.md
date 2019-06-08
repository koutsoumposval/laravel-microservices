# Laravel Microservices

A simple laravel pseudo-microservices demo project.
This is NOT a real "microservices" setup or at least something that is production ready!
It is only here to point out the separation of concerns between each service and get you started
with a containerized local environment using docker with a reverse proxy on top.

This project consists of three web services `user`, `product` & `order` and 
one API gateway `api-gateway`.

The webservices are containerised with Docker and are accessible within a
Traefik proxy interface. 

`traefik` image is used for the proxy container and `php:7.1-apache` is used and extended
for the web services containers & the API gateway

The `api` is using the Guzzle API Client in order to maintain connection with the web services.

Lumen was preferred since it is an easy way to expose APIs.

Set up
------------

#### Install Docker
The current Docker environment is based on Docker Toolbox. 
If you don't have Docker Toolbox installed, you can download it [here](https://www.docker.com/products/docker-toolbox).


#### Create a docker-machine *
```
    docker-machine create laravel-microservices
    eval $(docker-machine env laravel-microservices)
```

#### Mount volumes as NFS
To prevent permission problems we leverage Docker-Machine-NFS to mount volumes as NFS.
First, [install docker-machine-nfs](https://github.com/adlogix/docker-machine-nfs) and then run the following command:
```bash
docker-machine-nfs laravel-microservices --nfs-config="-alldirs -maproot=0" --mount-opts="noacl,async,nolock,vers=3,udp,noatime,actimeo=1"
```

#### Create the external network
```
    docker network create traefik_webgateway
```

#### Update the your hosts file
```
    # Get the ip of the VMachine
    docker-machine ip laravel-microservices
    
    # Update /etc/hosts file
    192.168.99.100 lm.local user.lm.local inventory.lm.local order.lm.local api.lm.local
```

Setup all services
------------
In order to get up and running, you need to setup each
individual service.

- [user](user/readme.md)
- [order](order/readme.md)
- [inventory](user/readme.md)
- [api gateway](api-gateway/readme.md)

Once you set all services, you are ready to use them.

Build & Run
------------
```
    docker-compose -f docker/docker-compose.yml up -d --build
```

Access
------------
You can access the applications from:
```
    #user
    http://user.lm.local
    
    #inventory
    http://inventory.lm.local
    
    #order
    http://order.lm.local
    
    #api gateway
    http://api.lm.local
```

#### Reverse proxies
You can access Traefik interface from:
```
    http://lm.local:8080
```

Teardown and "Scale"
------------
#### Teardown
```
    docker-compose -f docker/docker-compose.yml down --volumes --remove-orphans
```

#### Scale
```
    # DEPRECATED
    docker-compose -f docker/docker-compose.yml scale ${container-name}
```

Isolate Web Services
------------
Removing the `traefik.frontend.rule` from the Web services will make
them accessible only from the API gateway (traefik backend network)

Your Next Steps
------------
Once you get started, you need to consider some of the following:

- Use databases to store data. You can add new docker `mysql` containers in `docker/docker-compose.yml` and apply 
proxy configuration in order to be able to access them.
- Each service must be accessible from a unique entry point, in our case the APIs.
This should be the only way for communication between services.
- Communication between the services should not be direct. One service should not be aware of the other!
This type of communication can be achieved by using messaging or events.
- Tests are essential part of software development. Functionality of each service should be
unit tested. Functionality of the whole flow should be functionally tested.
- This is a setup that is using older versions of Docker, Laravel/Lumen. Update them in order to be able to
use their latest features.