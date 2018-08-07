# Bring in from PHP docker image
FROM 7.2.8-cli-stretch

# Copy over our PHP libraries/runtime
COPY ./src /opt/executor

