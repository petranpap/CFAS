from mitmproxy import http
from mitmproxy import ctx
import requests
import json

def load(l):
    l.add_option("fb_url", str, " ", "A custom option")

def response(flow: http.HTTPFlow) -> None:
    customfb = ctx.options.fb_url
    customfb = "https:--www.facebook.com-"+customfb
    if flow.request.host == "www.youtube.com":
        if "https://www.youtube.com/watch?v=" in flow.request.pretty_url:
                txt = flow.request.pretty_url
                x=txt.replace("https://www.youtube.com/watch?v=", "")
                youtubeid=x.replace("&pbj=1", "")
                url = "http://api.disturbedyoutubeforkids.xyz/disturbed_youtube_videos_detection?video_id="+youtubeid
                url_post = "https://proxyencase.cut.ac.cy:18082/dal/SaveYoutubePred"
                payload = {}
                headers= {}
                response = requests.request("GET", url, headers=headers, data = payload)
                my_json = '{"fb_url":"'+ customfb+'","read":0}'
                my_json = json.loads(my_json)
                myresponse = response.text.encode('utf8')
                data = json.loads(myresponse)
                new_data = json.dumps(data)+json.dumps(my_json)
                new_post = new_data.replace("}{", ",")
                headers = {
                  'Content-Type': 'application/json'
                          }

                response_post = requests.request("POST", url_post, headers=headers, data = new_post, verify=False)
                print(response_post.text.encode('utf8'))
