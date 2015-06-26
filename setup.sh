#!/bin/bash

# This setup.sh script installs necessary dependencies for 'Unified IoT Dashboard' Framework
# to be worked properly on this machine.

# Setup for Alljoyn
sudo apt-get update
sudo apt-get install build-essential gcc g++ libssl-dev python scons curl apache2 php5 libapache2-mod-php5 -y

# Logs for Alljoyn services
mkdir components/logs/alljoyn

# Assuming apache2 home directory set to '/var/www' or '/var/www/html'
if [ -d '/var/www/html' ]; then
	sudo ln -s `pwd` /var/www/html 
else
	sudo ln -s `pwd` /var/www
fi
