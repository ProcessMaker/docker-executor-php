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

$response = require(SCRIPT_PATH);

// Finally store the output of our script into our output JSON path
file_put_contents(OUTPUT_JSON_PATH, json_encode($response));


