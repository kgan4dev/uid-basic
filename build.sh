#!/bin/bash

#Looking for the PWD Path in this machine
path=`pwd`
arch=$(uname -m)

# building alljoyn component services
printf "Building started for AllJoyn component services.\n"
cd $path/components/alljoyn/core/alljoyn/services/about/
if [ $arch == 'i686' ]; then
	scons WS=off BINDINGS=cpp

	if [ -f $path/components/alljoyn/core/alljoyn/services/about/build/linux/x86/debug/dist/about/bin/AboutClient ]; then
		printf "Alljoyn About Service build successful.!\n"
	else
		printf "Something went wrong.!\n"
	fi
elif [ $arch == 'armv61' ]; then
	scons WS=off BINDINGS=cpp CPU=arm OE_BASE=/usr 

	if [ -f $path/components/alljoyn/core/alljoyn/services/about/build/linux/arm/debug/dist/about/bin/AboutClient ]; then
		printf "Alljoyn About Service build successful.!\n"
	else
		printf "Something went wrong.!\n"
	fi
fi
cd $path
