<?php
// Include our composer libraries
require __DIR__ . '/vendor/autoload.php';

// Our paths
const DATA_JSON_PATH = '/opt/executor/data.json';
const CONFIG_JSON_PATH = '/opt/executor/config.json';
const OUTPUT_JSON_PATH = '/opt/executor/output.json';
const SCRIPT_PATH = '/opt/executor/script.php';

// Our error codes
const DATA_JSON_INVALID = 100;
const CONFIG_JSON_INVALID = 101;
const SCRIPT_PATH_INVALID = 102;


$data = json_decode(@file_get_contents(DATA_JSON_PATH), true);
if($data === null) {
    // Terminate script, the data is invalid json or cannot be ready
    fwrite(STDERR, "Data JSON file (" . DATA_JSON_PATH . ") does not exist or is invalid.");
    exit(DATA_JSON_INVALID);
}

$config = json_decode(@file_get_contents(CONFIG_JSON_PATH), true);
if($config === null) {
    // Terminate script, the config is invalid json or cannot be ready
    fwrite(STDERR, "Config JSON file (" . CONFIG_JSON_PATH . ") does not exist or is invalid.");
    exit(CONFIG_JSON_INVALID);
}

// Check for existence of script
if(!file_exists(SCRIPT_PATH)) {
    // Terminate script, the config is invalid json or cannot be ready
    fwrite(STDERR, "Script file (" . SCRIPT_PATH . ") does not exist or is invalid.");
    exit(SCRIPT_PATH_INVALID);
}

if (getenv('API_TOKEN') && getenv('API_HOST') && class_exists('ProcessMaker\Client\Configuration')) {
    $api_config = new ProcessMaker\Client\Configuration();
    $api_config->setAccessToken(getenv('API_TOKEN'));
    $api_config->setHost(getenv('API_HOST'));
    $api = new Executor\Api($api_config, isset($_ENV['API_SSL_VERIFY']) ? (bool) $_ENV['API_SSL_VERIFY'] : true);
}
try {
    $response = require(SCRIPT_PATH);
} catch(GuzzleHttp\Exception\ServerException $e) {
    // Guzzle truncates by default so re-throw using full response
    throw new \Exception(\GuzzleHttp\Psr7\str($e->getResponse()));
}

// Finally store the output of our script into our output JSON path
file_put_contents(OUTPUT_JSON_PATH, json_encode($response));


