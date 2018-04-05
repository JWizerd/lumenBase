#!/bin/bash

docker rm -f test

docker run --name="test" \
    -p 3001:80 \
    -v /Users/theringleman/development/lumen/test:/var/www/html/ \
    -d test