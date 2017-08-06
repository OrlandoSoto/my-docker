# my-docker
My Docker Compose project

Docker Compose - PHP with Microservices

To run from the console 'cd' into the directory where "docker-compose.yml" resides then::
```
docker-compose up -d
```
PHP Application will bes served to localhost:80

### product/api.py
Pulls next bus info for the specified bus stop
https://api.wmata.com/NextBusService.svc/json/jPredictions?

### website/index.php
PHP code to display the info pulled from product/api.pi
