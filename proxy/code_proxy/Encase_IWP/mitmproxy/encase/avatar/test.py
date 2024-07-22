#!/usr/bin/env python3

import mysql.connector

customfb = "https:--www.facebook.com-peter.encase"
mydb = mysql.connector.connect(
  host = "localhost",
  user = "the_encase_user",
  password = "SEou!gR[p$=YLqrI4Q9$",
  database = "encase"
)
mycursor = mydb.cursor()
sql_select_query = "select avatar_lang.lang from avatar_lang inner join childs on childs.child_id = avatar_lang.child_id where childs.child_fb_url = %s"
mycursor.execute(sql_select_query, (customfb,))
myresult = mycursor.fetchone()
print(myresult[0])
