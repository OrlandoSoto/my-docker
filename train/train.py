import datetime
import requests
from flask import Flask
from flask_restful import Resource, Api
from requests.compat import urljoin, quote_plus

app = Flask(__name__)
api = Api(app)

base_url = 'https://api.wmata.com/StationPrediction.svc/json/GetPrediction/'


class Train(Resource):
    def get(self):
        # Request headers
        headers = {'api_key': '88c04b279955416f8605d0b76ebc8974'}
        currentHour = datetime.datetime.now().strftime("%H")

        # If before 12 noon DC time
        if(int(datetime.datetime.now().strftime("%H")) <= 16):
            station_1 = 'B11'  # Glenmont station
            url_1 = urljoin(base_url, quote_plus(station_1))
            train_1 = requests.get(url_1, headers=headers)
            train_1 = train_1.json()

            station_2 = "A13"  # Twinbrook
            url_2 = urljoin(base_url, quote_plus(station_2))
            train_2 = requests.get(url_2, headers=headers)
            train_2 = train_2.json()

            station_3 = "A12"  # White Flint
            url_3 = urljoin(base_url, quote_plus(station_3))
            train_3 = requests.get(url_3, headers=headers)
            train_3 = train_3.json()

            finalObj = {'0': train_1, '1': train_2, '2': train_3}
            return(finalObj)

        else:
            station_1 = 'A02'  # Farragut North
            url_1 = urljoin(base_url, quote_plus(station_1))
            train_1 = requests.get(url_1, headers=headers)
            train_1 = train_1.json()
            finalObj = {'pm_train': train_1}
            return(finalObj)


api.add_resource(Train, '/')
if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80, debug=True)
