#!/bin/bash
# 
# This script run all the containers for the RES lab HTTPInfra 
#
# Usage : ./init.sh 
#
# Author : Gaëtan Daubresse 

cd docker-images/apache-php-image
docker build -t res/apache_php . 

cd ../apache-reverse-proxy 
docker build -t res/apache_rp .

cd ../express-image 
docker build -t res/express_locations . 

docker run -d --name express_dynamic1 res/express_locations
docker run -d --name express_dynamic2 res/express_locations

docker run -d --name apache_static1 res/apache_php
docker run -d --name apache_static2 res/apache_php

docker run -d -e STATIC_APP1=172.17.0.4:80 -e STATIC_APP2=172.17.0.5:80 -e DYNAMIC_APP1=172.17.0.2:3000 -e DYNAMIC_APP2=172.17.0.3:3000 --name apache_rp -p 8080:80 res/apache_rp

cd ..
docker volume create portainer_data
docker run -d -p 9000:9000 --name=portainer --restart=always -v /var/run/docker.sock:/var/run/docker.sock -v portainer_data:/data portainer/portainer


