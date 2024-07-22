# -*- coding: utf-8 -*-
"""
Created on Fri Oct  5 13:08:57 2018

@author: Petran Pap
"""
import json
import urllib.parse

import falcon
import initConfig
from bson.json_util import dumps
from bson.objectid import ObjectId
from falcon_cors import CORS
from pymongo import MongoClient
from falcon_require_https import RequireHTTPS

app_config = initConfig.ConfigSectionInit("AppConfig.ini")
connection_string = initConfig.ConfigSectionValue(app_config, "MongoDBConfig", "ConnectionString")
cors_allow_all = CORS(allow_all_origins=True,
                      allow_all_headers=True,
                      allow_all_methods=True,
		      allow_credentials_all_origins=True)

class GetChildGroups:
    cors = cors_allow_all

    def on_get(self, req, resp, fb_url=None):
        if fb_url is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encasebackend
                col = db.child_img_groups
                child_img_groups = list(col.find({"fb_url": fb_url}))
                to_return = {
                    'child_img_groups': child_img_groups
                }
                resp.body = dumps(to_return)


class SaveChildGroups:
    cors = cors_allow_all

    def on_post(self, req, resp):
        try:
            resp.status = falcon.HTTP_200
            data_input = req.stream.read().decode('utf-8')
            if data_input:
                #print(data_input)
                # print("ACK")
                data_input = json.loads(data_input)
#                print(data_input['fb_url'])
                with MongoClient(connection_string) as client:
                    db = client.encasebackend
                    test_col = db.child_img_groups
                    # print(test_col)
                    check_ = list(test_col.find({"fb_url": data_input['fb_url']}))
                    myquery = { "fb_url": data_input['fb_url'] }
                    test_col.delete_one(myquery)
                    test_col.insert_one(data_input)
                    # print(check_)
                    # if check_:
                    # 	test_col.deleteOne({"fb_url" : data_input['fb_url']})
                    # 	test_col.insert(data_input)
                    # else:
                    # 	test_col.insert(data_input)

                    resp.body = "ACK Groupd Image Settings"
            # else:
            #     resp.status = falcon.HTTP_400
        except KeyError:
             resp.status = falcon.HTTP_500

class GetProxyIP:
    cors = cors_allow_all

    def on_get(self, req, resp, fb_url=None):
        if fb_url is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encasebackend
                col = db.proxies_ip
                child_img_groups = list(col.find({"fb_url": fb_url}))
                to_return = {
                    'Proxy Ip:': child_img_groups
                }
                resp.body = dumps(to_return)




class SaveProxyIP:
    cors = cors_allow_all

    def on_post(self, req, resp):
        try:
            resp.status = falcon.HTTP_200
            data_input = req.stream.read().decode('utf-8')
            if data_input:
                #print(data_input)
                # print("ACK")
                data_input = json.loads(data_input)
#                print(data_input['fb_url'])
                with MongoClient(connection_string) as client:
                    db = client.encasebackend
                    test_col = db.proxies_ip
                    # print(test_col)
                    check_ = list(test_col.find({"fb_url": data_input['fb_url']}))
                    myquery = { "fb_url": data_input['fb_url'] }
                    test_col.delete_one(myquery)
                    test_col.insert_one(data_input)
                    # print(check_)
                    # if check_:
                    #   test_col.deleteOne({"fb_url" : data_input['fb_url']})
                    #   test_col.insert(data_input)
                    # else:
                    #   test_col.insert(data_input)

                    resp.body = "ACK IP proxy"
            # else:
            #     resp.status = falcon.HTTP_400
        except KeyError:
             resp.status = falcon.HTTP_500


dal = falcon.API(middleware=[cors_allow_all.middleware])
	#  ----------Options---------  #
dal.add_route('/dal/GetChildGroups/{fb_url}', GetChildGroups())
dal.add_route('/dal/SaveChildGroups',SaveChildGroups())
dal.add_route('/dal/SaveProxyIP',SaveProxyIP())
dal.add_route('/dal/GetProxyIP/{fb_url}', GetProxyIP())
