FROM arm32v7/python:3.5-alpine
RUN apk update && apk upgrade
WORKDIR /usr/src/app
COPY . .
RUN pip install --upgrade pip && pip install -r requirements.txt
CMD ["python","api.py"]
