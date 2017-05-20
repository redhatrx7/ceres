#! python
import sys
import os
import subprocess
import json
import glob

dir_path = os.path.dirname(os.path.realpath(__file__))

if not os.path.exists(dir_path+'/composer'):
    os.makedirs(dir_path+'/composer')
# npm install
os.chdir(dir_path)
subprocess.Popen('npm install', stdout=subprocess.PIPE, shell=True )
os.chdir('composer')
subprocess.Popen('composer install', stdout=subprocess.PIPE, shell=True )
os.chdir('../WebContent')
subprocess.Popen('composer install', stdout=subprocess.PIPE, shell=True )