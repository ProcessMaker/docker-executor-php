#!/bin/sh

# Retrieve version
TAG=$(cat composer.json | jq -r '.version')
export SDK_IMAGE="processmaker/docker-executor-php:$TAG"
# Build image
docker build -f Dockerfile.sdk -t $SDK_IMAGE .


