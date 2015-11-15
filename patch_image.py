import json  # To properly encode event data
import requests

"""Usual login"""
auth = {'user': "root", 'password': "amivroot"}
r = requests.post('https://amiv-apidev.vsos.ethz.ch/sessions', verify=False, data=auth)
token = r.json()['token']
session = requests.Session()
session.auth = (token, '')

"""Some data without language relevant content"""

path = "./sushi.jpg"
with open(path, 'rb') as f:
    get = session.get('https://amiv-apidev.vsos.ethz.ch/events/30',verify=False);
    etag = get.json()['_etag']
    response = session.patch('https://amiv-apidev.vsos.ethz.ch/events/30', files={"img_thumbnail": f}, verify=False, headers={"If-Match": etag})

print response.json()
    
