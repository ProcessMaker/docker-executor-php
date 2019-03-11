set -e
set -x

# SDK_PATH=/home/vagrant/bpm-plugins/ProcessMaker/pm4-sdk-php
API_TOKEN=eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM4MDJkNWMyZDU3ODczNzVlNTYzZmM3NTUwYTMyYzczOTg2NjFkYzdhY2JkMDFmNzhkMDZiNzZjMDRlNTBmMjcxNmFmYzcxY2VkZTg1ZWMwIn0.eyJhdWQiOiIxIiwianRpIjoiYzgwMmQ1YzJkNTc4NzM3NWU1NjNmYzc1NTBhMzJjNzM5ODY2MWRjN2FjYmQwMWY3OGQwNmI3NmMwNGU1MGYyNzE2YWZjNzFjZWRlODVlYzAiLCJpYXQiOjE1NTIwODE2NzEsIm5iZiI6MTU1MjA4MTY3MSwiZXhwIjoxNTgzNzA0MDcxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.dJB2Ecel4AZpc1gw74a1Pd5IZ9vgTJSMY5UTPeCdSP0L67j1Pgx5Jpw3jVT_aj4xsu1wgSDhU7Xa0TlYdsdA4Xc2Xc3yoC1fcAKZUc_kz2-Ji1OS_LwSaUwc9-_UGfQouxNDR9a0pTK1v6XUmz2I3cJIJZcFwa0TktIq7F8yaMFExbDKBn7GDKe9KqfCoNtCloY4_stUKXf0q9YEU05hnJBdYFVLZ1idCK1l6gUtcirbQ7pkB4yfxwboN9SRJ0j-PAfGhmge-DyoCNJZ9kM7BIpaK66GW1W_E4AK2KkirlbM5QvMZBHLkFn3T1RWCnvqSj03-LHV3vwwPK3kr_TNEPV7bOSngO7c5NFXTi2aVXAAxY3X_AZU7vm9bpCmazi9K87GQEACsMx6Xafg0pFOyz3FLUMSCbTFq4hvZulu90ZqRZuOftTrNd-Cd6MGInp8SGR-4B-zVc33C1ynRFgatAWiEiWdWrDXtq9zSerF8iYpiBOUXF1d6D5CrABHaMlWplH8I3xsCES4YsCEdmHjGBHWAMaOQZ-BBRl8eDCWnYsthEXFn0wkgU0f1qB9tNwZOEI7qVfkBgWcAykwmOcip6QHATmBfVokZ03QWbrY2_u1mY-Fg2xWRy95jpflQ6nSvje27XjmbFdBTT3CWWdh0NKecr4rEIgMyGv2iw841kA
API_HOST=http://bpm4.local.processmaker.com/api/1.0

##############

EXECUTOR_IMAGE="nolanpro/executor:php"
EXECUTOR_DIR=${PWD}

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
-e "API_TOKEN=$API_TOKEN" \
-e "API_HOST=$API_HOST" \
$EXECUTOR_IMAGE php /opt/executor/bootstrap.php

cat output.json

rm config.json data.json output.json script.php
