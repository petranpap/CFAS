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


class SaveFB(object):
    cors = cors_allow_all

    def on_post(self, req, resp):
        resp.status = falcon.HTTP_200
        fb_url = req.params['fb_url']
        source_code = req.params['source_code']
        with MongoClient(connection_string) as client:
            db = client.encaseproxydata
            col = db.FB_Source
            if col.find({"fb_url": fb_url}).count() > 0:
                col.update({'fb_url': fb_url}, {'$set': {'source_code': source_code}})
            else:
                col.insert({"fb_url": fb_url, "source_code": source_code})

            to_return = {
                'Updated': fb_url
            }
            resp.body = dumps(to_return)


class SaveSocialMediaSettings(object):
    cors = cors_allow_all

    def on_post(self, req, resp):
        try:
            resp.status = falcon.HTTP_200
            data_input = req.stream.read().decode('utf-8')
            if data_input:
                # print(data_input)2
                # print("ACK")
                data_input = json.loads(data_input)
                # print(data_input[0]['fb_url'])
                with MongoClient(connection_string) as client:
                    db = client.encaseproxydata
                    test_col = db.social_media_settings
                    test_col.delete_many( { "fb_url" : data_input[0]['fb_url'] } )
                    test_col.insert_many(data_input)
                    resp.body = "ACK Social Media Settings"
            else:
                resp.status = falcon.HTTP_400
        except KeyError:
             resp.status = falcon.HTTP_500

class SaveChat:
    cors = cors_allow_all

    def on_post(self, req, resp):
        try:
            resp.status = falcon.HTTP_200
            data_input = req.stream.read().decode('utf-8')
            if data_input:
                #print(data_input)
                # print("ACK")
                data_input = json.loads(data_input)
                #print(data_input['case_id'])
                with MongoClient(connection_string) as client:
                    db = client.encaseproxydata
                    test_col = db.chat
                    #urllib.parse.quote(data_input)
                    chat_case_date_find = list(
                        test_col.find({"case_id": data_input['case_id'], "date_created": data_input['date_created']}))
                    if not chat_case_date_find:
                        test_col.insert_one(data_input)
                        resp.body = "ACK CHAT"
                    else:
                        test_col.update({"case_id": data_input['case_id'], "date_created": data_input['date_created']},
                                {'$set': {'text_chat': data_input['text_chat']}})
                        resp.body = "ACK Update"
            else:
                resp.status = falcon.HTTP_400
        except KeyError:
            resp.status = falcon.HTTP_500


class SaveWall:
    cors = cors_allow_all

    def on_post(self, req, resp):
        try:
            resp.status = falcon.HTTP_200
            data_input = req.stream.read().decode('utf-8')
            if data_input:
                # print(data_input)
                # print("ACK")
                data_input = json.loads(data_input)
                with MongoClient(connection_string) as client:
                    db = client.encaseproxydata
                    test_col = db.wall
                    test_col.insert_one(data_input)
                resp.body = "ACK WALL"
            else:
                resp.status = falcon.HTTP_400
        except KeyError:
            resp.status = falcon.HTTP_500


class SaveImages:
    cors = cors_allow_all

    def on_post(self, req, resp):
        try:
            resp.status = falcon.HTTP_200
            data_input = req.stream.read().decode('utf-8')
            if data_input:
                # print(data_input)
                # print("ACK")
                data_input = json.loads(data_input)
                with MongoClient(connection_string) as client:
                    db = client.encaseproxydata
                    test_col = db.images
                    test_col.insert_one(data_input)
                resp.body = "ACK IMAGES"
            else:
                resp.status = falcon.HTTP_400
        except KeyError:
            resp.status = falcon.HTTP_500


class SaveTweetID:
    cors = cors_allow_all

    def on_post(self, req, resp):
        try:
            resp.status = falcon.HTTP_200
            data_input = req.stream.read().decode('utf-8')
            if data_input:
                #print(data_input)
                # print("ACK")
                data_input = json.loads(data_input)
                print(data_input)
                with MongoClient(connection_string) as client:
                    db = client.encaseproxydata
                    test_col = db.twitter
                    test_col.insert_one(data_input)
                resp.body = "ACK IMAGES"
            else:
                resp.status = falcon.HTTP_400
        except KeyError:
            resp.status = falcon.HTTP_500

class GetSocialMediaSettingsbyFBurl:
    cors = cors_allow_all

    def on_get(self, req, resp, fb_url=None):
        if fb_url is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.social_media_settings
                blocked_sites = list(col.find({"fb_url": fb_url}))
                # print(twitter_read)
                to_return = {
                    'blocked_sites': blocked_sites
                }
                resp.body = dumps(to_return)


class GetTweetNameByRead:
    cors = cors_allow_all

    def on_get(self, req, resp, read=None):
        if read is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.twitter
                twitter_read = list(col.find({"read": read}))
                # print(twitter_read)
                to_return = {
                    'Twitter_Names': twitter_read
                }
                resp.body = dumps(to_return)


class UpdateTwitterRead:
    cors = cors_allow_all

    def on_put(self, req, resp, _id=None):
        if _id is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.twitter
                twitter_read = list(col.find({"_id": ObjectId(_id)}))
                # twitter_read_update = col.update("_id":ObjectId(_id)},{"$set":{'read':'1'}})
                twitter_read_update = col.update({'_id': ObjectId(_id)}, {'$set': {'read': '1'}})
                # twitter_read_update = list(col.save({"_id": ObjectId(_id), "read": "1"}))
                # print(_id)
                to_return = {
                    'Updated': _id
                }
                resp.body = dumps(to_return)


class GetTweetNameByFakeRead:
    cors = cors_allow_all

    def on_get(self, req, resp, read_fake=None):
        if read_fake is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.twitter
                twitter_read = list(col.find({"read_fake": read_fake}))
                # print(twitter_read)
                to_return = {
                    'Twitter_Names': twitter_read
                }
                resp.body = dumps(to_return)


class UpdateTwitterFakeAccounts:
    cors = cors_allow_all

    def on_put(self, req, resp, _id=None):
        if _id is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.twitter
                twitter_read = list(col.find({"_id": ObjectId(_id)}))
                twitter_read_update = col.update({'_id': ObjectId(_id)}, {'$set': {'read_fake': '1'}})
                # print(_id)
                to_return = {
                    'Updated': _id
                }
                resp.body = dumps(to_return)


class GetChatByfb_url:
    cors = cors_allow_all

    def on_get(self, req, resp, fb_url=None):
        if fb_url is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.chat
                chat_fb_url = list(col.find({"fb_url": fb_url}).sort('Index', 1))
                # print(chat_fb_url)
                to_return = {
                    'Chat Logs': chat_fb_url
                }
                resp.body = dumps(to_return)


class GetChatByDateCreated:
    cors = cors_allow_all

    def on_get(self, req, resp, date_created=None, case_id=None):
        if date_created is None or case_id is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.chat
                chat_date_created = list(col.find({"date_created": date_created, "case_id": case_id}).sort('Index', 1))
                # print(date_created)
                to_return = {
                    'Chat Logs': chat_date_created
                }
                resp.body = dumps(to_return)


class GetChatByDate:
    cors = cors_allow_all

    def on_get(self, req, resp, from_date=None, to_date=None, case_id=None):
        if case_id or from_date is None:
            # print(case_id, from_date, to_date)
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.chat
                chat = list(col.find({"case_id": case_id, "from_date": from_date, "to_date": to_date}).sort('Index', 1))
                to_return = {
                    'Chat Logs': chat
                }
                resp.body = dumps(to_return)

class GetSexualChatread:
    cors = cors_allow_all

    def on_get(self, req, resp, read_sexual=None):
        if read_sexual is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.chat
                chat_read_sexual = list(col.find({"read_sexual": read_sexual}))
                print(read_sexual)
                to_return = {
                    'Chat_Logs': chat_read_sexual
                }
                resp.body = dumps(to_return)


class GetCyberChatRead:
    cors = cors_allow_all

    def on_get(self, req, resp, read_cyber=None):
        if read_cyber is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.chat
                chat_cyber_read = list(col.find({"read_cyberbull": read_cyber}))
                # print(twitter_read)
                to_return = {
                    'Chat_Logs': chat_cyber_read
                }
                resp.body = dumps(to_return)


class SaveChatSexualPredatorDetection:
    cors = cors_allow_all

    def on_put(self, req, resp, date_created=None, case_id=None, sexual_detection_percent=None):
        if sexual_detection_percent is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.chat
                sexyalchat = col.update({"case_id": case_id, "date_created": date_created},
                                        {'$set': {'sexual_detection_percent': sexual_detection_percent,
                                                  'read_sexual': '0'}})
                # print(sexyalchat)
                to_return = {
                    'Updated': case_id,
                    "date_created": date_created,
                    'sexual_detection_percent': sexual_detection_percent

                }
                resp.body = dumps(to_return)


class SaveChatCyberBullyDetection:
    cors = cors_allow_all

    def on_put(self, req, resp, date_created=None, case_id=None, angry=None, frustrated=None, sad=None):
        if angry is None or frustrated is None or sad is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.chat
                cyberbullingchat = col.update({"case_id": case_id, "date_created": date_created},
                                              {'$set': {'angry': angry, 'frustrated': frustrated, 'sad': sad,
                                                        'read_cyberbull': '0'}})
                # print(cyberbullingchat)
                to_return = {
                    'Updated': case_id,
                    "date_created": date_created,
                    'angry': angry,
                    'frustrated': frustrated,
                    'sad': sad

                }
                resp.body = dumps(to_return)


class UpdateChatSexualRead:
    cors = cors_allow_all

    def on_put(self, req, resp, _id=None):
        if _id is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.chat
                chat_sexual_read = list(col.find({"_id": ObjectId(_id)}))
                chat_sexual_read_update = col.update({'_id': ObjectId(_id)}, {'$set': {'read_sexual': '1'}})
                # print(_id)
                to_return = {
                    'Updated_chat_sexual': _id
                }
                resp.body = dumps(to_return)


class UpdateChatCyberBullRead:
    cors = cors_allow_all

    def on_put(self, req, resp, _id=None):
        if _id is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.chat
                chat_cyberbull_read = list(col.find({"_id": ObjectId(_id)}))
                chat_cyberbull_read_update = col.update({'_id': ObjectId(_id)}, {'$set': {'read_cyberbull': '1'}})
                # print(_id)
                to_return = {
                    'Updated_chat_cyberbulliing': _id
                }
                resp.body = dumps(to_return)


class ObtainDataChat:
    cors = cors_allow_all

    def on_get(self, req, resp):
        try:
            resp.status = falcon.HTTP_200
            # print(connection_string)
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.chat
                chatall = list(col.find({}))
            content = {
                # "Cases": test_case
                "Chat": chatall
            }
            resp.body = dumps(content)
        except Exception:
            resp.status = falcon.HTTP_500
            resp.body = "Internal Server Error. Contact administrator"


class ObtainDataWall:
    cors = cors_allow_all

    def on_get(self, req, resp):
        try:
            resp.status = falcon.HTTP_200
            # print(connection_string)
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.wall
                wallall = list(col.find({}))
            content = {
                # "Cases": test_case
                "Wall": wallall
            }
            resp.body = dumps(content)
        except Exception:
            resp.status = falcon.HTTP_500
            resp.body = "Internal Server Error. Contact administrator"


class ObtainDataImages:
    cors = cors_allow_all

    def on_get(self, req, resp):
        try:
            resp.status = falcon.HTTP_200
            # print(connection_string)
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.images
                images = list(col.find({}))
            content = {
                # "Cases": test_case
                "Wall": images
            }
            resp.body = dumps(content)
        except Exception:
            resp.status = falcon.HTTP_500
            resp.body = "Internal Server Error. Contact administrator"


class GetImageLocByDataId:
    cors = cors_allow_all

    def on_get(self, req, resp, data_id=None):
        if data_id is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.images
                imageloc_dataid = list(col.find({"data_id": data_id}).sort('Index', 1))
                to_return = {
                    'Images': imageloc_dataid
                }
                resp.body = dumps(to_return)


class GetChildGroups:
    cors = cors_allow_all

    def on_get(self, req, resp, fb_url=None):
        if fb_url is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
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
                #print(data_input[0]['fb_url'])
                with MongoClient(connection_string) as client:
                    db = client.encaseproxydata
                    test_col = db.child_img_groups
                    print(test_col)
                    test_col.delete_many({"fb_url" : data_input[0]['fb_url']})
                    test_col.insert_many(data_input)
                    resp.body = "ACK Groupd Image Settings"
            else:
                resp.status = falcon.HTTP_400
        except KeyError:
             resp.status = falcon.HTTP_500

class SaveYoutubePred:
    cors = cors_allow_all

    def on_post(self, req, resp):
        try:
            resp.status = falcon.HTTP_200
            data_input = req.stream.read().decode('utf-8')
            if data_input:
                # print(data_input)
                # print("ACK")
                data_input = json.loads(data_input)
                with MongoClient(connection_string) as client:
                    db = client.encaseproxydata
                    test_col = db.youtube
                    test_col.insert_one(data_input)
                resp.body = "ACK Youtube"
            else:
                resp.status = falcon.HTTP_400
        except KeyError:
            resp.status = falcon.HTTP_500

class GetYoutubeByFburl:
    cors = cors_allow_all

    def on_get(self, req, resp, fb_url=None):
        if fb_url is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.youtube
                twitter_read = list(col.find({"fb_url": fb_url}))
                # print(twitter_read)
                to_return = {
                    'youtube': twitter_read
                }
                resp.body = dumps(to_return)


class UpdateYoutubeRead:
    cors = cors_allow_all

    def on_put(self, req, resp, _id=None):
        if _id is None:
            resp.status = falcon.HTTP_404
            resp.body = json.dumps({})
        else:
            resp.status = falcon.HTTP_200
            with MongoClient(connection_string) as client:
                db = client.encaseproxydata
                col = db.youtube
                youtube_read = list(col.find({"_id": ObjectId(_id)}))
                youtube_read_update = col.update({'$set': {'read': '1'}})
                resp.body = dumps('OK')




dal = falcon.API(middleware=[cors_allow_all.middleware])

#  ------------------------------------Facebook-----------------------------  #
#  ----------Save All FB Source code---------  #
dal.add_route('/dal/SaveFB/{fb_url}', SaveFB())
dal.add_route('/dal/SaveSettings',SaveSocialMediaSettings())
dal.add_route('/dal/GetSettings/{fb_url}',GetSocialMediaSettingsbyFBurl())
#  ----------CHAT---------  #
#  ----------CHAT GET---------  #
dal.add_route('/dal/ObtainData/chat', ObtainDataChat())
dal.add_route('/dal/ObtainData/chat/sexualread/{read_sexual}', GetSexualChatread())
dal.add_route('/dal/ObtainData/chat/cyberread/{read_cyber}', GetCyberChatRead())
dal.add_route('/dal/ObtainData/chat/fb_url/{fb_url}', GetChatByfb_url())
dal.add_route('/dal/ObtainData/chat/date_created/{date_created}/{case_id}', GetChatByDateCreated())
dal.add_route('/dal/ObtainData/chat/case_id_from_to/{case_id}/{from_date}/{to_date}', GetChatByDate())
#  ----------CHAT SAVE---------  #
dal.add_route('/dal/SaveChat', SaveChat())
#  ----------CHAT UPDATE---------  #
dal.add_route('/dal/Update/chat/case_id_sexual/{case_id}/{date_created}/{sexual_detection_percent}',
              SaveChatSexualPredatorDetection())
dal.add_route('/dal/Update/chat/case_id_cyber/{case_id}/{date_created}/{angry}/{frustrated}/{sad}',
              SaveChatCyberBullyDetection())
dal.add_route('/dal/UpdateChatSexualRead/{_id}', UpdateChatSexualRead())
dal.add_route('/dal/UpdateChatCyberRead/{_id}', UpdateChatCyberBullRead())
#  ----------WALL---------  #
#  ----------WALL GET---------  #
dal.add_route('/dal/ObtainData/wall', ObtainDataWall())
#  ----------WALL SAVE---------  #
dal.add_route('/dal/SaveWall', SaveWall())
#  ----------IMAGES---------  #
#  ----------IMAGES GET---------  #
dal.add_route('/dal/ObtainData/images', ObtainDataImages())
#  ----------IMAGES SAVE---------  #
dal.add_route('/dal/SaveImages', SaveImages())
#  --------------------------------------------TWITTER-----------------------------------------  #
#  ----------TWITTER GET---------  #
dal.add_route('/dal/SaveTweetID', SaveTweetID())
dal.add_route('/dal/ObtainImagesLoc/{data_id}', GetImageLocByDataId())
dal.add_route('/dal/ObtainData/twitter/{read}', GetTweetNameByRead())
dal.add_route('/dal/ObtainData/twitter_fakeaccounts/{read_fake}', GetTweetNameByFakeRead())
#  ----------TWITTER UPDATE---------  #
dal.add_route('/dal/UpdateTwitterRead/{_id}', UpdateTwitterRead())
dal.add_route('/dal/UpdateTwitterFakeRead/{_id}', UpdateTwitterFakeAccounts())
#-------------Youtube----------------#
dal.add_route('/dal/SaveYoutubePred', SaveYoutubePred())
dal.add_route('/dal/youtube/{fb_url}',GetYoutubeByFburl())
#dal.add_route('/dal/UpdateYoutubeRead/{_id}',UpdateYoutubeRead())
#  ----------Browser Add-on---------  #
dal.add_route('/dal/GetChildGroups/{fb_url}', GetChildGroups())
dal.add_route('/dal/SaveChildGroups',SaveChildGroups())

