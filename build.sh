#!/bin/bash

#Looking for the PWD Path in this machine
path=`pwd`
arch=$(uname -m)

# building alljoyn component services
printf "Building started for AllJoyn component services.\n"
cd $path/components/alljoyn/core/alljoyn/
if [ $arch == 'i686' ]; then
	scons WS=off BINDINGS=cpp SERVICES="about,notification"

	printf "Checking Alljoyn About Service . . . "
	if [ -f $path/components/alljoyn/core/alljoyn/build/linux/x86/debug/dist/about/bin/AboutClient ]; then
		printf "Build successful.!\n"
	else
		printf "\nSomething went wrong.!\n"
	fi

	printf "Checking Alljoyn notification Service . . . "
	if [ -f $path/components/alljoyn/core/alljoyn/build/linux/x86/debug/dist/notification/bin/ConsumerService ] && [ -f $path/components/alljoyn/core/alljoyn/build/linux/x86/debug/dist/notification/bin/ProducerService ]; then
		printf "Build successful.!\n"
	else
		printf "\nSomething went wrong.!\n"
	fi
elif [ $arch == 'armv61' ]; then
	scons WS=off BINDINGS=cpp CPU=arm OE_BASE=/usr SERVICES="about,notification"

	printf "Checking Alljoyn About Service . . . "
	if [ -f $path/components/alljoyn/core/alljoyn/build/linux/arm/debug/dist/about/bin/AboutClient ]; then
		printf "Build successful.!\n"
	else
		printf "\nSomething went wrong.!\n"
	fi

	printf "Checking Alljoyn notification Service . . . "
	if [ -f $path/components/alljoyn/core/alljoyn/build/linux/arm/debug/dist/notification/bin/ConsumerService ] && [ -f $path/components/alljoyn/core/alljoyn/build/linux/arm/debug/dist/notification/bin/ProducerService ]; then
		printf "Build successful.!\n"
	else
		printf "\nSomething went wrong.!\n"
	fi
fi

cd $path
