#!/bin/bash

# This setup.sh script installs necessary dependencies for 'Unified IoT Dashboard' Framework
# to be worked properly on this machine.

arch=$(uname -m)

# Setup for Alljoyn
if [ $arch == 'i686' -o $arch == 'armv6l' ]; then
	sudo apt-get update
	sudo apt-get install build-essential -y
	sudo apt-get install gcc g++ libssl-dev -y
	sudo apt-get install python scons curl -y
fi
