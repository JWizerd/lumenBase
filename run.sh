#!/bin/bash

echo "Creating home-net network"
docker network create home-net

docker rm -f yourservice

docker run --name="yourservice" \
    -p 30010:80 \
    -v /home/theringleman/Development/homeFinanceV2:/var/www/html/ \
    --network='home-net' \
    -d yourservice