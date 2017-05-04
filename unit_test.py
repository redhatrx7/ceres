#! python
import sys
import os
import subprocess
import json
import glob
import re

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

#generate the results
for test in tests:
    output = subprocess.Popen( 'php ' + dir_path + '/WebContent/index.php tests ' + test, stdout=subprocess.PIPE ).communicate()[0]
    file = open(dir_path+'/unittests/'+test+'.html', 'w')
    file.truncate()
    file.write(str(output,'utf-8'));
    file.close()

# scan and report the results
for test in tests:
     file = open(dir_path+'/unittests/'+test+'.html', 'r')
     result = False
     note = False
     resultSet = {}

     for line in file:
         if result:
             resultSet[test] = {}
             if 'Passed' in line:
                 resultSet[test]['passed'] = 'Passed'
             else:
                 resultSet[test]['passed'] = 'Failed'
         elif note:
             resultSet[test]['function'] = re.split('<|>', line)[2]
         if 'Result</th>' in line:
             result = True
         else:
             result = False
         if 'Notes</th>' in line:
            note = True
         else:
            note = False

#results
for key in resultSet.keys():
    print(key + ': ' + resultSet[key]['function'] + ' = ' + resultSet[key]['passed'])
    