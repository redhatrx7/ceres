#! python
import sys
import os
import subprocess
import json
import glob

'''
Handles the running of php unit tests
'''

# Paths
dir_path = os.path.dirname(os.path.realpath(__file__))
if not os.path.exists(dir_path+'/unittests'):
    os.makedirs(dir_path+'/unittests')
test_paths = glob.glob(dir_path + '/WebContent/application/controllers/tests/*.php')
tests = []
for test in test_paths:
    tests.append(test.replace('\\', '/').split('/').pop().replace('.php', ''))

for test in tests:
    output = subprocess.Popen( 'php ' + dir_path + '/WebContent/index.php tests ' + test, stdout=subprocess.PIPE ).communicate()[0]
    file = open(dir_path+'/unittests/'+test+'.html', 'w')
    file.truncate()
    file.write(str(output,'utf-8'));