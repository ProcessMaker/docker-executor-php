set -e
set -x

EXECUTOR_IMAGE="nolanpro/executor:php"

# local clone of https://github.com/ProcessMaker/bpm
BPM_DIR=/home/vagrant/processmaker

# local clone of https://github.com/ProcessMaker/executor-php
EXECUTOR_DIR=${PWD}

# local clone of https://github.com/ProcessMaker/pm4-sdk-php
SDK_PATH=/home/vagrant/bpm-plugins/ProcessMaker/pm4-sdk-php

pushd $BPM_DIR
    rm -rf /tmp/php-client
    php artisan bpm:sdk php /tmp
    cp -rf /tmp/php-client/. $SDK_PATH
popd

# temporary for testing
pushd $EXECUTOR_DIR/src
    # ln -s $SDK_PATH php-client
    rm -rf vendor
    rm -f composer.lock
    composer install
    # rm php-client
popd

pushd $EXECUTOR_DIR
    docker container prune -f
    docker rmi -f $EXECUTOR_IMAGE
    docker build -t $EXECUTOR_IMAGE .

    # test it (optional)
    # ./test.sh
    
    docker push $EXECUTOR_IMAGE
popd
