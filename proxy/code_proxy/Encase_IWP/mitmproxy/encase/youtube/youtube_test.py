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
                if youtubeid in "tPEQUfszEkk":
                    print("ssssssssssssss____:     ")
                    print(youtubeid)
                    url_post = "https://proxyencase.cut.ac.cy:18082/dal/SaveYoutubePred"
                    new_data = '{ "prediction": "inappropriate", "confidence_score": "97%", "video_id": "tPEQUfszEkk", "fb_url": "https:--www.facebook.com-peter.encase", "read": 0 }'
                    headers = {
                      'Content-Type': 'application/json'
                              }

                    response_post = requests.request("POST", url_post, headers=headers, data = new_data, verify=False)
                    print(response_post.text.encode('utf8'))
                
