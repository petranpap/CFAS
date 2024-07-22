from requests import get

ip = get('https://api.ipify.org').text
print('IP: {}'.format(ip))

import requests

url = "https://backendencase.cut.ac.cy:18085/dal/SaveProxyIP"

payload="{'fb_url': 'https:--www.facebook.com-peter.encase','ip':format(ip)}"
headers = {
  'Content-Type': 'application/json'
}

response = requests.request("POST", url, headers=headers, data=payload,verify = False)

print(response.text)

