import datetime
import urllib.parse
import requests

url = "https://encase-proxy.socialcomputing.eu:18082/dal/ObtainData/chat"
url_post_cyber = "http://35.205.100.70:8032/early_cyberbullying_detection"
url_post_sexual = "http://35.205.100.70:8032/sexual_predator_detection"

headers = {
    'cache-control': "no-cache",
    'postman-token': "e83f8900-71a3-09f8-3315-ba14a75d0779"
}
headers_not = {
    'cache-control': "no-cache",
    'postman-token': "793b61d2-9251-c2ac-b953-acee9ff8661b"
}

response = requests.request("GET", url, headers=headers, verify=False)
data = response.json()
items = data["Chat"]
#print(items)
for item in items:
    # print(item)
    if item['date_created'] == datetime.datetime.today().strftime('%d-%m-%Y'):
    #if item['date_created'] == '22-03-2019':
        post_data = 'https://encase-proxy.socialcomputing.eu:18082/dal/ObtainData/chat/date_created/' + item['date_created'] + '/' + item[
            'case_id']
        payload = "CHAT_DATA_URL=" + post_data
        #print(payload)
        headers = {
            'content-type': "application/x-www-form-urlencoded",
            'postman-token': "98294b3a-fafa-4f44-fe64-a0e84624a86a",
            'cache-control': "no-cache"
        }

        response = requests.request("POST", url_post_sexual, data=payload, headers=headers, verify=False)
        data_frompost = response.json()
#        print(data_frompost)
        if data_frompost["predictions"]['predator'] > '60%':
            predator_prediction = data_frompost["predictions"]['predator']
            url_update = 'https://encase-proxy.socialcomputing.eu:18082/dal/Update/chat/case_id_sexual/' + item[
                'case_id'] + '/' + item['date_created'] + '/' + data_frompost["predictions"]['predator']
            parent_notify_sex_enc = 'Sexual Predator detected! Confidence: ' + predator_prediction + '. CFAS analyzed the chat the child had with "' + item[ 'fb_sender_name'] + '" on Facebook at '+ item['date_created'] +' and it shows signs of sexual grooming at ' + predator_prediction
            parent_notify_sexua = 'https://encase-proxy.socialcomputing.eu:8090/api/public/notifications/' + urllib.parse.quote(parent_notify_sex_enc) +'/'+item['fb_url']
            response_parent_nottify = requests.request("POST", parent_notify_sexua, headers=headers_not, verify=False)
            response = requests.request("PUT", url_update, headers=headers, verify=False)
            #print(url_update)

        # print(parent_notify_sexua)
        # print('http://35.205.100.70:18082/dal/ObtainData/chat/date_created/' + item['date_created'] + '/' + item[
        #     'case_id'])

        #send chat to analyse for angry/frustreated/sad text detection
	post_data = 'https://encase-proxy.socialcomputing.eu:18082/dal/ObtainData/chat/date_created/' + item['date_created'] + '/' + item[
            'case_id']
        payload = "CHAT_DATA_URL=" + post_data
#        print(payload)
        headers = {
            'content-type': "application/x-www-form-urlencoded",
            'postman-token': "98294b3a-fafa-4f44-fe64-a0e84624a86a",
            'cache-control': "no-cache"
        }

        response_cyber = requests.request("POST", url_post_cyber, data=payload, headers=headers, verify=False)
        data_frompost_cyber = response_cyber.json()
        #print(data_frompost_cyber)
        predator_angry = data_frompost_cyber["predictions"]["angry"]
        predator_frustrated = data_frompost_cyber["predictions"]["frustrated"]
        predator_sad = data_frompost_cyber["predictions"]["sad"]

        url_update_cyber = 'https://encase-proxy.socialcomputing.eu:18082/dal/Update/chat/case_id_cyber/' + item[
            'case_id'] + '/' + item['date_created'] + '/' + data_frompost_cyber["predictions"]["angry"] + '/' + \
                           data_frompost_cyber["predictions"]["frustrated"] + '/' + data_frompost_cyber["predictions"][
                               "sad"]
        #print('a   '+url_update_cyber)
        parent_cyber_enc = "The emotional state of the child  based on the messages with "+item['fb_sender_name']+"on "+item['date_created']+ " are : Angry : " + predator_angry + ' Frustrated : ' + predator_frustrated + ' Sad : ' + predator_sad
        parent_notify_cyber = 'https://encase-proxy.socialcomputing.eu:8090/api/public/notifications/' + urllib.parse.quote(parent_cyber_enc) + '/' + item['fb_url']

        response_parent_nottify_cyber = requests.request("POST", parent_notify_cyber, headers=headers_not, verify=False)
        response = requests.request("PUT", url_update_cyber, headers=headers, verify=False)
        # print(parent_notify_cyber)

        # print(data_frompost_cyber["predictions"]["angry"]+data_frompost_cyber["predictions"]["frustrated"]+data_frompost_cyber["predictions"]["sad"])

