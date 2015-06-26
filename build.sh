#!/bin/sh

#Looking for the PWD Path in this machine
path=`pwd`

# building alljoyn component services
printf "Building started for AllJoyn component services.\n"
cd $path/components/alljoyn/core/alljoyn/services/about/
scons WS=off BINDINGS=cpp
cd $path
printf "Alljoyn About Service build successful.!\n"
