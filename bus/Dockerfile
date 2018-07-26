FROM python:3-onbuild
COPY . /usr/src/app
RUN pip install --upgrade pip
RUN pip install requests
RUn pip install simplejson
CMD ["python","api.py"]
