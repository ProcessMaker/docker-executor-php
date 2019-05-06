set -e
set -x

BRANCH=${BRANCH:=master}
TAG=${TAG:=dev-${BRANCH//[\/]/-}}
EXECUTOR_IMAGE="processmaker/spark-docker-executor-php:${TAG}"

pushd src
  if [[ ! -d "spark-sdk-php" ]]; then
    git clone --branch $BRANCH --depth 1 https://github.com/ProcessMaker/spark-sdk-php.git
  fi
  rm -rf composer.lock
  rm -rf vendor
  composer install
  ./run_tests.sh
popd

docker build -t $EXECUTOR_IMAGE .
rm -rf src/spark-sdk-php
