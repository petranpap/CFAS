"""
Here we get the url from Twitter and send it to the API and get the results we need for the classifiers
"""
from mitmproxy import http
import tweepy
import json
import requests
from bs4 import BeautifulSoup

consumer_key = 'WVDb9oTz6cj4VuklxoBlvt1Mu'
consumer_secret = 'RA15eTzDraU3c1EkBPTO5tkGMg31IqNBX45XbBdk3ZVWl0DfMg'
access_token = '734323901166157824-f3u52d9BvLvbKsa3GJ5xVd06LmYLogO'
access_token_secret = 'ocNgsuWBt5i5NNeYU1e3cy2uflMPiHYluOnOt9BXp7H4V'

# OAuth process, using the keys and tokens
auth = tweepy.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_token_secret)
# Creation of the actual interface, using authentication
api = tweepy.API(auth)
print(api)

def response(flow: http.HTTPFlow) -> None:
    # pretty_url takes the "Host" header of the request into account, which
    # is useful in transparent mode where we usually only have the IP otherwise.
   # print(flow.request.pretty_url)
   # if "https://twitter.com/home" in flow.request.pretty_url:
        #soup = BeautifulSoup(flow.response.content,"html.parser")
        #print(soup.prettify());
        #element = soup.find("script")
        #print(element.attrs[""])
        #for a in soup.findAll("a", {"aria-label": "Profile"}, href=True):
            #child_twitter = a['href'].replace('/', '')
        #    print("sssssss sss s s s   "+child_twitter)
        #    with open('/opt/mitmproxy/encase/twitter/twitter_json_user_timeline/' + child_twitter + '.twittername',
        #              "w") as f:
        #        f.write("")
                # print(child_twitter)
        #    with open('/opt/mitmproxy/encase/twitter/twitter_json_get_show_user/' + child_twitter + '.twittername',
        #              "w") as f:
        #        f.write("")

    if flow.request.host == "twitter.com":
#       print('123456789     ---->>>   '+flow.response.headers["Content-Security-Policy"])
       if "/i/" not in flow.request.pretty_url:
            if not flow.request.pretty_url.endswith('.js'):
                if not flow.request.pretty_url.endswith('.json'):
                    urls = flow.request.pretty_url.split("?p", maxsplit=1)[0]
                    urls = urls.replace('https://twitter.com/', '')
#                    print("PAPAPAPA   ---->"+urls)
                    user_timeline = api.user_timeline(screen_name=urls)
                    get_show_user = api.get_user(screen_name=urls)

                    with open(
                            '/home/cut/proxy/Encase_IWP/mitmproxy/encase/twitter/twitter_json_user_timeline/user_timeline_' + urls + '.json',
                            'w') as f_timeline:
                        print('1')
                        for item in user_timeline:
                            f_timeline.write("%s\n" % item._json)
#                            print('2')
                    with open(
                            '/home/cut/proxy/Encase_IWP/mitmproxy/encase/twitter/twitter_json_get_show_user/get_show_user_' + urls + '.json',
                            'w') as f_user:
                        f_user.write("%s\n" % get_show_user._json)

