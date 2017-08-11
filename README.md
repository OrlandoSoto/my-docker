# my-docker

Docker Compose - PHP with Python Microservices

## What problem does this solve?
* Many existing mobile transit applications display several bus/train routes travelling in many different directions. This causes the mobile screen to be filled with transit information that a regular commuter may not find beneficial. A regular commuter is typically insterested in one or two bus/train routes to travel to/from work

* Many existing mobile transit applications require the user to navigate several menu layers in order to view the desired bus/train route information. 

* Many existing mobile transit applications display a map of the current location which may be beneficial for first time travellers but not for regular commuters who are typically familiar with the routes they travel daily. This feature takes up a significant portion of the display.

## What does this application do?

* This application calculates the local Washington DC time to determine which bus/train direction to display. For example in the morning, when I commute to work, the application displays bus/train information departing Glenmont MD towards Washington DC. In the afternoon, when I commute from work the application displays bus/train routes travelling from Washington DC to MD.

* This application only displays the bus/train routes I use to commute to/from work resulting in a cleaner display, as it does not include routes I do not normally travel during my daily commute.

* This application displays text information that is the most useful for regular commuters without unecessary map or transit graphics.

## How to build and run this application
From the console 'cd' into the directory where "docker-compose.yml" resides and use this command to build and run the three containers:
```
docker-compose up -d
```
Docker-compose stands up three separate containers. 
* Two Flask/python applications acting as microservices to serve json code
* One HTML/PHP container parses json from the other two containers and display the pertinent info

PHP Application will be served to localhost:80

## What code is under the hood?

### website/index.php
PHP code is used to display the info pulled from bus/api.py and trains/train.py
JSON is parsed to extract and display the desired bus/train arrival information 

### bus/api.py
Python code pulls next bus arrival info for the specified bus stop
https://api.wmata.com/NextBusService.svc/json/jPredictions?
In the morning (before GMT 1600) the information is served for the bus arriving near my home and heading towards the Glenmont station
In the afternoon (after GMT 1600) the bus information is for the next bus leaving the Glenmont station heading home 

### train/train.py
This python code pulls train arrival info from: https://api.wmata.com/StationPrediction.svc/json/GetPrediction/

The Glenmont station is the final stop on the Red line train so all trains travel southbound towards Washington DC. No filtering is needed.

At the Noma train station, red line trains travel northbound towards Silver Spring/Glenmont MD and also southbound towards Shady Grove.
The PHP code is reponsible for filtering the trains heading towards Silver Spring/Glenmont MD

Grumpycat place holder for TBD graphic
