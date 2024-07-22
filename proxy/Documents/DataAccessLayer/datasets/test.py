import re

with open('hatespeech_data.txt', 'r') as fh:
    contents = fh.read()
loop = True
while loop:
    if (re.search(r'\b'+ re.escape('viol') + r'\b', contents, re.MULTILINE)):
        print("That name exists!")
        break
    else:
        print("Couldn't find the name.")
        break
