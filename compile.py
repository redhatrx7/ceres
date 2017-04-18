#! python
import sys
import os
import subprocess
import json
import glob

dir_path = os.path.dirname(os.path.realpath(__file__))
headers_path = dir_path + '/WebContent/application/config/headers/'
footers_path = dir_path + '/WebContent/application/config/footers/'
path_to_assets = 'WebContent/assets/'

#js = []
#css = []

#f = open(header_path, "r")
#for line in f:
#    if ".js" in line:
#        js.append(path_to_assets + line.split("'")[1])
#    elif ".css" in line:
 #       css.append(path_to_assets + line.split("'")[1])
#f.close()

#f = open(footer_path, "r")
#for line in f:
#    if ".js" in line:
#        js.append(path_to_assets + line.split("'")[1])
#    elif ".css" in line:
#        css.append(path_to_assets + line.split("'")[1])
#f.close()

controller_js = {}
controller_css = {}

paths = glob.glob(dir_path + '/WebContent/application/config/controllers/*.php')
for file in paths:
    files = []
    cssFiles = []
    js = []
    css = []
    f = open(file, "r")
    for line in f:
        if ".js" in line:
             files.append(path_to_assets + line.split("'")[1])
        elif ".css" in line:
            cssFiles.append(path_to_assets + line.split("'")[1])
        elif "'header' =>" in line:
            f = open(headers_path+line.split('=>')[0].replace("'", '').strip()+'.php', "r")
            for line in f:
                if ".js" in line:
                    js.append(path_to_assets + line.split("'")[1])
                elif ".css" in line:
                    css.append(path_to_assets + line.split("'")[1])
            f.close()
        elif "'footer' =>" in line:
            f = open(footers_path+line.split('=>')[0].replace("'", '').strip()+'.php', "r")
            for line in f:
                if ".js" in line:
                    js.append(path_to_assets + line.split("'")[1])
                elif ".css" in line:
                    css.append(path_to_assets + line.split("'")[1])
            f.close()
    f.close()
    controller_js[os.path.basename(file).replace('.php', '')] = js + files
    controller_css[os.path.basename(file).replace('.php', '')] = css + cssFiles

subprocess.check_call(dir_path + '/node_modules/.bin/gulp copy', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp react', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp sass', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp compress --controllers "' +json.dumps(controller_js)+'"', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp minify --controllerscss "'+json.dumps(controller_css)+'"', shell=True)