import json  # To properly encode event data
import requests

"""Usual login"""
auth = {'user': "root", 'password': "amivroot"}
r = requests.post('https://amiv-apidev.vsos.ethz.ch/sessions', verify=False, data=auth)
token = r.json()['token']
session = requests.Session()
session.auth = (token, '')

"""Some data without language relevant content"""
data = {'time_start': '2015-01-12T12:00:00Z',
        'time_end': '2015-01-12T13:00:00Z',
        'time_register_start': '2015-01-11T12:00:00Z',
        'time_register_end': '2015-01-11T13:00:00Z',
        'location': 'Flums, Tannenberg',
        'title_de': 'Wat',
        'description_de': 'Wat',
        'show_announce': True,
        'spots': 10,
        'catchphrase_de': "Wat?",
        'is_public': True}

payload = json.dumps(data)

session.headers['Content-Type'] = 'application/json'
response = session.post('https://amiv-apidev.vsos.ethz.ch/events', verify=False,
                             data=payload)
print response.json()
del(session.headers['Content-Type']) # Header not needed anymore