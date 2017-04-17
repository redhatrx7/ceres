#! python
import sys
import os
import subprocess
import json
import glob

dir_path = os.path.dirname(os.path.realpath(__file__))
header_path = dir_path + '/WebContent/application/config/header.php'
footer_path = dir_path + '/WebContent/application/config/footer.php'
path_to_js = 'WebContent/assets/'

js = []

f = open(header_path, "r")
for line in f:
    if ".js" in line:
        js.append(path_to_js + line.split("'")[1])
f.close()

f = open(footer_path, "r")
for line in f:
    if ".js" in line:
        js.append(path_to_js + line.split("'")[1])
f.close()

controller_js = {}
paths = glob.glob(dir_path + '/WebContent/application/config/controllers/*.php')
for file in paths:
    files = []
    f = open(file, "r")
    for line in f:
        if ".js" in line:
             files.append(path_to_js + line.split("'")[1])
    f.close()
    controller_js[os.path.basename(file).replace('.php', '')] = files;

subprocess.check_call(dir_path + '/node_modules/.bin/gulp copy', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp react', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp sass', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp compress --js "'+json.dumps(js)+'" --controllers "'+json.dumps(controller_js)+'"', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp minify', shell=True)