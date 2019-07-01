set -e
set -x

BRANCH=${BRANCH:=master}
TAG=${TAG:=dev-${BRANCH//[\/]/-}}
EXECUTOR_IMAGE="processmaker4/executor-php:${TAG}"

pushd src
  if [[ ! -d "sdk-php" ]]; then
    git clone --branch $BRANCH --depth 1 https://github.com/ProcessMaker/sdk-php.git
  fi
  rm -rf composer.lock
  rm -rf vendor
  composer install
  ./run_tests.sh
popd

docker build -t $EXECUTOR_IMAGE .
rm -rf src/sdk-php