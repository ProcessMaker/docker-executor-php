set -e
set -x

BRANCH=${BRANCH:=master}
TAG=${TAG:=dev-${BRANCH//[\/]/-}}
EXECUTOR_IMAGE="processmaker/pm4-docker-executor-php:${TAG}"

pushd src
  if [[ ! -d "php-sdk" ]]; then
    git clone --branch $BRANCH --depth 1 https://github.com/ProcessMaker/pm4-sdk-php.git php-sdk
  fi
  rm -rf composer.lock
  rm -rf vendor
  composer install
  ./run_tests.sh
popd

docker build -t $EXECUTOR_IMAGE .
rm -rf php-sdk

# docker push $EXECUTOR_IMAGE