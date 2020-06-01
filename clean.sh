#!/bin/bash
#
# This script kill and remove all the containers used for the RES lab HTTPinfra and ran 
# by the script init.sh 
# 
# Usage : ./clean.sh 
#
# Author : Gaëtan Daubresse 

docker kill express_dynamic1 express_dynamic2 apache_static1 apache_static2 apache_rp portainer 
docker rm express_dynamic1 express_dynamic2 apache_static1 apache_static2 apache_rp portainer 
docker volume rm portainer_data
