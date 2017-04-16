#! python
import sys
import os
import subprocess

dir_path = os.path.dirname(os.path.realpath(__file__))

subprocess.check_call(dir_path + '/node_modules/.bin/gulp copy', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp react', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp sass', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp compress', shell=True)
subprocess.check_call(dir_path + '/node_modules/.bin/gulp minify', shell=True)