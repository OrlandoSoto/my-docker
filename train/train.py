import datetime
import requests
from flask import Flask
from flask_restful import Resource, Api

app = Flask(__name__)
api = Api(app)

class Train(Resource):	
	def get(self):
                currentHour = datetime.datetime.now().strftime("%H")
                print(currentHour)
                if(int(datetime.datetime.now().strftime("%H")) >= 16):
                    print("greater")
                else:
                    print("less than")

                url = 'https://api.wmata.com/StationPrediction.svc/json/GetPrediction/B35'
		# If before noon DC time
                if(int(datetime.datetime.now().strftime("%H")) <= 16):
                    my_stop = 'B35' #Noma
                else:
                    my_stop = 'B11' # Glenmont station
                # Request headers
                headers = {'api_key': '88c04b279955416f8605d0b76ebc8974'}
		
		# Request parameters
                payload = {'StopID': my_stop}
                
                r = requests.get(url, headers=headers) 
                print(r.json())         
                return(r.json())

api.add_resource(Train, '/')
if __name__=='__main__':
	app.run(host='0.0.0.0', port=80, debug=True)
