set -e
set -x

BRANCH=${BRANCH:=master}
TAG=${TAG:=dev-$BRANCH}
REPO=${REPO:=ProcessMaker/pm4-sdk-php}
EXECUTOR_IMAGE="processmaker/pm4-docker-executor-php:${TAG}"

pushd src
  composer install
  ./run_tests.sh
popd

docker build -t $EXECUTOR_IMAGE .

# docker push $EXECUTOR_IMAGE