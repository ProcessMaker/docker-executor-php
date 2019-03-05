set -e
set -x

BPM_DIR=/home/vagrant/processmaker

API_TOKEN=eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjgyNTQyOGRlZWY3MDBkMjVjMzNkYTc4ZTNjZmQ2Yzg2NGJkNmM5ZWU1ZGY5NTU5NDBiZmU0N2UyNDliYWI3NGQ1ZTY1OWY4NTAxMWQ5ZDRiIn0.eyJhdWQiOiIxIiwianRpIjoiODI1NDI4ZGVlZjcwMGQyNWMzM2RhNzhlM2NmZDZjODY0YmQ2YzllZTVkZjk1NTk0MGJmZTQ3ZTI0OWJhYjc0ZDVlNjU5Zjg1MDExZDlkNGIiLCJpYXQiOjE1NTE3Njc3MDcsIm5iZiI6MTU1MTc2NzcwNywiZXhwIjoxNTgzMzkwMTA2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.5jZjEht0D048PQw99xF4hh-Qgfr146ABb1w8yc1Ezv-weuDPsYZnCsldtYKy2PYmctHKNvd1BR708oZ96D1LjjoREoCtiST2VDviv9Cv74gdUZGfVwu_A4paYTRywAiJPnOWXrUurSlBi9ZGI6lU1KptsuGj1YG9kC5bfbTYtay7AfC_487s5UbISV-de5_lv8CtvlMvxx_lcNe2ZblKO-Zkv7dwEDjMfcvE975tq4WF77IlM5HYchqj9ZOZkfkYcg7vXtrk52tOLBALWQpTQj8xwZgdX5xF49Dt2LkgZ1jQZaydKakz-UpJsBG0u7UAWgo43gMgsCS0F2GLR8YCNS281aMICT9VMX0oTXczdpVebZVzN_uhAWkqzTbZwL8Q-Eo5TUMuEBKaDL-9n1JMzAXmnylfsewwm0yPLJ-Xk2yE0tab26zQiBo6CTI5X6Yjf4C_Xms7vCdJOVh1JdjSKkzNfFvKyiiok7BKe83s_fShX-bXyhFIRXAK1k0Kx8prfcDGc5Gz0_jzjNj6fBCi1gSUrAwSu1JkGhTbfw1b-t1AouGbX02TGjDluU9kmY_e5Q3ifxwBFU-XYrdHjMC7UojN4cPk4cII9LvoEtQhHE4lVROY8_0KfYsJVwb6W5ldCbU4IYVTUnv2NhfSymFAPyM2DLgWtAUB_-PImCrCdfI

##############

EXECUTOR_IMAGE="nolanpro/executor:php"
EXECUTOR_DIR=${PWD}
SDK_PATH=$BPM_DIR/storage/api/php-client

echo '{}' > config.json
echo '{"foo":"Bar"}' > data.json
echo '' > output.json

echo '<?php
        $api_config->setDebug(true);
        $apiInstance = new OpenAPI\Client\Api\UsersApi($api_client, $api_config);
        $result = $apiInstance->getUsers();
        return [ "email" => $result->getData()[0]->getEmail() ];' > script.php

docker run --rm \
-v $EXECUTOR_DIR/data.json:/opt/executor/data.json \
-v $EXECUTOR_DIR/config.json:/opt/executor/config.json \
-v $EXECUTOR_DIR/script.php:/opt/executor/script.php \
-v $EXECUTOR_DIR/output.json:/opt/executor/output.json \
-v $SDK_PATH:/opt/executor/php-client \
-e "API_TOKEN=$API_TOKEN" \
$EXECUTOR_IMAGE php /opt/executor/bootstrap.php

cat output.json

rm config.json data.json output.json script.php
