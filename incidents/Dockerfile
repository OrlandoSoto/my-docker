FROM python:3.7-alpine
RUN apk update && apk upgrade
WORKDIR /usr/src/app
COPY . .
RUN pip install --upgrade pip && pip install -r requirements.txt
CMD ["python","incident.py"]
