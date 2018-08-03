import datetime
import requests
from flask import Flask
from flask_restful import Resource, Api
from requests.compat import urljoin, quote_plus

app = Flask(__name__)
api = Api(app)

base_url = 'https://api.wmata.com/Incidents.svc/json/Incidents'


class Train(Resource):
    def get(self):
        # Request headers
        headers = {'api_key': '88c04b279955416f8605d0b76ebc8974'}

        response = requests.get(base_url, headers=headers)
        response = response.json()

        return(response)


api.add_resource(Train, '/')
if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80, debug=True)
