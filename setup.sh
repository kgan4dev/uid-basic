#!/bin/bash

# This setup.sh script installs necessary dependencies for 'Unified IoT Dashboard' Framework
# to be worked properly on this machine.

# Setup for Alljoyn
sudo apt-get update
sudo apt-get install build-essential gcc g++ libssl-dev python scons curl apache2 php5 libapache2-mod-php5 -y
