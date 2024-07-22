#!/usr/bin/env python3
import mmap
from flask import Flask, jsonify
from flask import request
import re

app = Flask(__name__)


@app.route('/hatespeech')
def data():
    text = request.args.get('text')
    with open('hatespeech_data.txt', 'r') as fh:
    	contents = fh.read()
    loop = True
    while loop:
    	if (re.search(r'\b'+ re.escape(text) + r'\b', contents, re.MULTILINE)):
        	return 'true'
        	break
    	else:
    		return 'false'
    		break

if __name__ == '__main__':
    app.run(debug=True)

