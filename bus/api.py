# my micro-service
import datetime
import requests
import json
import simplejson
from flask import Flask
from flask_restful import Resource, Api

app = Flask(__name__)
api = Api(app)
url = 'https://api.wmata.com/NextBusService.svc/json/jPredictions?'


class Bus(Resource):

    def get(self):
        # Request headers
        headers = {'api_key': '88c04b279955416f8605d0b76ebc8974'}

        # If before noon DC time
        # select the bus route from home towards train station
        if(int(datetime.datetime.now().strftime("%H")) <= 16):
            stop_1 = '2000684'  # Randolph and Bluhill East bound
            stop_2 = '2000688'  # Randolph and Bluhill West bound
        # Else select bus route from train station to home
        else:
            stop_1 = '2001176'  # White Flint
            stop_2 = '2001159'  # Twinbrook station Bay A

        # Request parameters
        payload_1 = {'StopID': stop_1}
        payload_2 = {'StopID': stop_2}

        # Request the bus arrival data
        bus_1 = requests.get(url, params=payload_1, headers=headers)
        bus_2 = requests.get(url, params=payload_2, headers=headers)

        bus_1 = bus_1.json()
        bus_2 = bus_2.json()

        finalObj = {'bus_1': bus_1, 'bus_2': bus_2}

        # Return the enitre JSON and the PHP code will parse it
        return(finalObj)


api.add_resource(Bus, '/')
if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80, debug=True)
