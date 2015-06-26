#!/bin/bash

arg=$1
path=`pwd`
arch=$(uname -m)

if [ -z "$arg" ]; then
	printf "USAGE: ./run.sh {start/stop}\n"
	exit
fi

if [ $arch == 'i686' ]; then
        TARGET_CPU='x86'
elif [ $arch == 'armv61' ]; then
        TARGET_CPU='arm'
fi

# Running Alljoyn component services
if [ $arg == 'start' ]; then
	export LD_LIBRARY_PATH=$path/components/alljoyn/core/alljoyn/build/linux/$TARGET_CPU/debug/dist/cpp/lib:$path/components/alljoyn/core/alljoyn/build/linux/$TARGET_CPU/debug/dist/about/lib:$path/components/alljoyn/core/alljoyn/build/linux/$TARGET_CPU/debug/dist/notification/lib:$LD_LIBRARY_PATH

	printf "Starting Alljoyn component services . . . \n\n"
	printf "About Client service . . . 		"
	$path/components/alljoyn/core/alljoyn/build/linux/$TARGET_CPU/debug/dist/about/bin/AboutClient >> $path/components/logs/alljoyn/AboutClient.log 2>&1 &
	printf "Done\n"
	printf "Notification Consumer service . . .	"
	$path/components/alljoyn/core/alljoyn/build/linux/$TARGET_CPU/debug/dist/notification/bin/ConsumerService >> $path/components/logs/alljoyn/ConsumerService.log 2>&1 &
	printf "Done\n\n"
#	printf "Notification Producer service . . .	"
#	$path/components/alljoyn/core/alljoyn/build/linux/$TARGET_CPU/debug/dist/notification/bin/ProducerService >> $path/components/logs/alljoyn/ProducerService.log  2>&1 &
#	printf "Done\n\n"
	printf "Alljoyn component services started Successfully.!\n"
elif [ $arg == 'stop' ]; then
	printf "Stoping Alljoyn component services . . . \n\n"	
	printf "About Client service		"
	kill -9 $(ps | grep "AboutClient" | awk '{print $1}')
	printf "Done\n"
	printf "Notification Consumer Service 	"
	kill -9 $(ps | grep "ConsumerService" | awk '{print $1}')
	printf "Done\n\n"
#	printf "Notification Producer Service 	"
#	kill -9 $(ps | grep "ProducerService" | awk '{print $1}')
#	printf "Done\n\n"
	printf "Alljoyn component services stop successfully.!\n"
else
	printf "USAGE: ./run.sh {start/stop}\n"
fi
