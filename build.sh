set -e
set -x

EXECUTOR_IMAGE="nolanpro/executor:php"

# local clone of https://github.com/ProcessMaker/bpm
BPM_DIR=/home/vagrant/processmaker

# local clone of https://github.com/ProcessMaker/executor-php
EXECUTOR_DIR=/home/vagrant/bpm-plugins/ProcessMaker/executor-php

pushd $BPM_DIR
    php build_sdk.php
popd

SDK_PATH=$BPM_DIR/storage/api/php-client
pushd $EXECUTOR_DIR/src
    cp -r $SDK_PATH .
    rm -rf vendor
    rm -f composer.lock
    composer install
    
    # delete it out so docker doesn't copy it into the image
    rm -rf php-client
popd

pushd $EXECUTOR_DIR
    docker container prune -f
    docker rmi -f $EXECUTOR_IMAGE
    docker build -t $EXECUTOR_IMAGE .

    # test it (optional)
    # ./test.sh
popd
