# ceres
generic codeigniter project for quick starts on web development

###################
CERES
###################

This project is meant to speed the process of setting up a php multi-page/single page applications using codeigniter 3.

*******************
Usable Frameworks
*******************
* Codeigniter
* Jquery
* React
* Sass
* Bootstrap

*******************
Intallation
*******************
* You will need to install node.js
* (Optional: install python)

*******************
EZ setup help
*******************

For the quickest setup use these steps

* Install WAMP (need vc++ redistributable)
* Set document root in httpd-vhosts in apache: c:/wamp64/www/Site and Directory: c:/wamp64/www/Site/
* the settings is already setup for a Static Web Project in eclpse. You will have to setup the http server in eclipse to serve it to the wamp/www directory.
* In the php.ini set "short_open_tag = on" to on.
* in PHP my admin make sure to create a mydb database and a user table with and id column and name column. (or configure the codeigniter your own way in the database.php config file)

**************************
Project Setup
**************************

* In the root directory of this project run "npm install" in your command line
* currently there is no single script for the gulp. so in the same directory run these commands:
  * node_modules\.bin\gulp copy (this will copy your node module files being used to your assets)
  * node_modules\.bin\gulp react (this will compile your jsx)
  * node_modules\.bin\gulp sass (this will compile you sass)
* There is also a python script to run these gulp commands as an eclipse external tool (you will need to make an external tool that runs this script or run this script by hand).
* TODO: make gulp watch for sass and jsx changes

*******************
ENVIROMENTS
*******************
* Edit the .htaccess file to toggle between development and non development environments
* non development evironments have minified css js for each controller

*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.