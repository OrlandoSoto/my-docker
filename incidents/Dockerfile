FROM python:3.7-alpine
RUN apk update && apk upgrade
COPY . /usr/src/app
RUN pip install --upgrade pip
RUN pip install -r /usr/src/app/requirements.txt
CMD ["python","/usr/src/app/incident.py"]
