#!/bin/sh
set -e

tar xf - -C /

php /opt/executor/bootstrap.php

if [ "$#" -gt 0 ]; then
    tar cf - -C / "$@"
fi
