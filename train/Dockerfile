FROM python:3.6.6-jessie
RUN apt-get update
RUN apt-get upgrade -y
COPY . /usr/src/app
RUN pip install --upgrade pip
RUN pip install -r /usr/src/app/requirements.txt
CMD ["python","usr/src/app/train.py"]
