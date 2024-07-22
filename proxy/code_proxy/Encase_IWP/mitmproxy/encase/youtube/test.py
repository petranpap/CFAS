"""
This script injects a Javascript to the .
"""
from mitmproxy import http
from mitmproxy import ctx
from selenium import webdriver
from bs4 import BeautifulSoup
import mysql.connector
from vars import *

def load(l):
    l.add_option("fb_url", str, " ", "A custom option")

def response(flow: http.HTTPFlow) -> None:
    if flow.request.host == "www.youtube.com":
        youtubecsr = flow.response.headers
        print(youtubecsr)
        #flow.response.headers[
        #      "Content-Security-Policy"] = "default-src * 'unsafe-inline' 'unsafe-eval' script-src * 'unsafe-inline' 'unsafe-eval' connect-src * 'unsafe-inline' img-src * data: blob: 'unsafe-inline' frame-src * style-src * 'unsafe-inline'"
        # flow.response.headers[
        #       "Content-Security-Policy"] = "default-src *  data: blob: filesystem: about: ws: wss: 'unsafe-inline' 'unsafe-eval' 'unsafe-dynamic'; script-src * data: blob: 'unsafe-inline' 'unsafe-eval'; connect-src * data: blob: 'unsafe-inline'; img-src * data: blob: 'unsafe-inline'; frame-src * data: blob: ; style-src * data: blob: 'unsafe-inline'; font-src * data: blob: 'unsafe-inline';"
        # flow.response.headers["Access-Control-Allow-Headers"] = "*"
        # reflector = b""+myreflect.encode()
        # flow.response.content = flow.response.content.replace(b"</head>", reflector)



