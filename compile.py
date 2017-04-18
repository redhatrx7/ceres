#! python
import sys
import os
import subprocess
import json
import glob

'''
Script for compiling Ceres sass, jsx, css, javascript using gulp and to create minifications and uglifications
for a production environment
@reference gulpfile.js
'''

# Paths
dir_path = os.path.dirname(os.path.realpath(__file__))
controllers = glob.glob(dir_path + '/WebContent/application/config/controllers/*.php')
headers_path = dir_path + '/WebContent/application/config/headers/'
footers_path = dir_path + '/WebContent/application/config/footers/'
path_to_assets = 'WebContent/assets/'

# Parameters
controller_js = {}
controller_css = {}

# Get controller's css and js parameters
for controller in controllers:
    controllerJsFiles = []
    controllerCssFiles = []
    js = []
    css = []

	# open each controllers configuration
    controllerFile = open(controller, "r")
    for controllerLine in controllerFile:
    	# Get the js files in the config
        if ".js" in controllerLine:
             controllerJsFiles.append(path_to_assets + controllerLine.split("'")[1])
        # Get the css files in the config
        elif ".css" in controllerLine:
            controllerCssFiles.append(path_to_assets + controllerLine.split("'")[1])
        # Open the header file
        elif "'header' =>" in controllerLine:
            headerFile = open(headers_path + controllerLine.split('=>')[0].replace("'", '').strip() + '.php', "r")
            # Get js and css files of this controllers header file
            for line in headerFile:
                if ".js" in line:
                    js.append(path_to_assets + line.split("'")[1])
                elif ".css" in line:
                    css.append(path_to_assets + line.split("'")[1])
            headerFile.close()
        # Open the footer file
        elif "'footer' =>" in controllerLine:
            footerFile = open(footers_path + controllerLine.split('=>')[0].replace("'", '').strip() + '.php', "r")
            # Get js and css files of this controllers footer file
            for line in footerFile:
                if ".js" in line:
                    js.append(path_to_assets + line.split("'")[1])
                elif ".css" in line:
                    css.append(path_to_assets + line.split("'")[1])
            footerFile.close()
    controllerFile.close()
 
 	# Assign js css files to the controller objects
    controller_js[os.path.basename(controller).replace('.php', '')] = js + controllerJsFiles
    controller_css[os.path.basename(controller).replace('.php', '')] = css + controllerCssFiles

# Initiate gulp sequence
subprocess.check_call(dir_path + '/node_modules/.bin/gulp copy', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp react', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp sass', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp compress --controllers "'  + json.dumps(controller_js) + '"', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp minify --controllerscss "' + json.dumps(controller_css) + '"', shell=True)