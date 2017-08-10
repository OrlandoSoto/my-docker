# my-docker
My Docker Compose project

Docker Compose - PHP with Microservices
### What problem does this solve?
* Currently, many mobile transit applications display several bus/train routes travelling in different directions. This causes the mobile screen to be filled with transit information that a user may not find beneficial.

* Many mobile transit applications require the user to navigate several menu layers in order to select the specific bus/train route information.

* Many mobile transit applications display a map of the current location which may be beneficial for first time travellers but not for regular commuters. This feature takes up a significant portion of the display.

### What does this application do?

* This application calculates the local time to determine which bus/train direction to display. For example in the morning, it displays bus/train information departing Glenmont MD towards Washington DC. In the afternoon, the application displays bus/train routes travelling from Washington DC to MD.

* This application only displays the bus/train routes I use to commute to/from work resulting in a cleaner UI, as it does not include routes I don't normally travel during my daily commute.

* This application displays text information that is the most useful for regular commuters without map or transit graphics.

To run from the console 'cd' into the directory where "docker-compose.yml" resides then::
```
docker-compose up -d
```
Docker-compose stands up three separate containers. 
* Two Flask/python applications acting as microservices to serve json code
* One HTML/PHP container parses json from the other two containers and display the pertinent info

PHP Application will bes served to localhost:80

### product/api.py
Pulls next bus info for the specified bus stop
https://api.wmata.com/NextBusService.svc/json/jPredictions?
In the morning (before GMT 1600) the information is served for bus/trains leaving Glenmont and heading towards DC
In the afternoon (after GMT 1600) the bus/train information is for Noma towards Silver Spring/Glenmont, MD

### train/train.py
This code pulls train arrival info from: https://api.wmata.com/StationPrediction.svc/json/GetPrediction/B35
The Glenmont station is the final stop on the Red line train so all trains travel southbound towards Washington DC.

At the Noma train station, red line trains travel northbound towards Silver Spring/Glenmont MD and also southbound towards Shady Grove.
The PHP code is reponsible for filtering the trains heading towards Silver Spring/Glenmont MD

### website/index.php
PHP code is used to display the info pulled from product/api.py and trains/train.py

The PHP code also parses the JSON in order to extract the relevant bus/train arrival information


Grumpycat place holder for TBD graphic
