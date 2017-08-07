# my-docker
My Docker Compose project

Docker Compose - PHP with Microservices

To run from the console 'cd' into the directory where "docker-compose.yml" resides then::
```
docker-compose up -d
```
Docker-compose stands up three separate containers. 
* Two Flask/python apps serve up straight json code
* One HTML/PHP container parses json from the other containers and display the pertinent info

PHP Application will bes served to localhost:80

### product/api.py
Pulls next bus info for the specified bus stop
https://api.wmata.com/NextBusService.svc/json/jPredictions?
In the morning (before GMT 1600) the information is served for bus/trains leaving Glenmont and heading towards DC
In the afternoon (after GMT 1600) the bus/train information is for Noma towards Silver Spring/Glenmont, MD

### train/train.py
Pulls train info from: https://api.wmata.com/StationPrediction.svc/json/GetPrediction/B35

### website/index.php
PHP code to display the info pulled from product/api.pi
Grumpycat place holder for TBD graphic
