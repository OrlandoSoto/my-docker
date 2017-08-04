# my micro-service
import requests
import json
import http.client, urllib.parse, urllib.error, base64
from flask import Flask
from flask_restful import Resource, Api

app = Flask(__name__)
api = Api(app)

class Product(Resource):
	
	def get(self):
		# Request headers
		headers = {'api_key': '88c04b279955416f8605d0b76ebc8974'}
		
		# Request parameters
		payload = {'StopID': '2000684'}

		r = requests.get('https://api.wmata.com/NextBusService.svc/json/jPredictions?', params=payload, headers=headers)
		return(r.json())

api.add_resource(Product, '/')
if __name__=='__main__':
	app.run(host='0.0.0.0', port=80, debug=True)
