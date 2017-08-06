# my micro-service
import datetime
import requests
import json
import http.client, base64
from flask import Flask
from flask_restful import Resource, Api

app = Flask(__name__)
api = Api(app)

class Product(Resource):
	
	def get(self):
		# If before noon DC time
                if(int(datetime.datetime.now().strftime("%H")) <= 16):
                    my_stop = '2000684' #Randolph and Bluhill
                else:
                    my_stop = '2001185' # Glenmont station
                # Request headers
                headers = {'api_key': '88c04b279955416f8605d0b76ebc8974'}
		
		# Request parameters
                payload = {'StopID': my_stop}

                r = requests.get('https://api.wmata.com/NextBusService.svc/json/jPredictions?', params=payload, headers=headers)
                return(r.json())

api.add_resource(Product, '/')
if __name__=='__main__':
	app.run(host='0.0.0.0', port=80, debug=True)
