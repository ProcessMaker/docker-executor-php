# Build
```
docker build -t processmaker4/executor-php:latest .
```

# executor-php
Script Task Executor Engine with PHP Runtime

This docker image provides a sandboxed protected environment to run custom PHP scripts that are written in ProcessMaker 4.
User created script tasks should be isolated however have utilities available to them in order to get most common tasks done. This 
PHP environment has PHP packages available and autoloaded so Script Tasks can take advantage of the following libraries:

- guzzlehttp/guzzle: ~6.0
- TODO : Identify most common libraries used for existing script tasks

## How to use
The execution requires a data.json, config.json and an output.json file be present on the host system. The data.json represents the 
Request instance data.  The config.json represents configuration specific for this Script Task. And the output.json should be a blank 
file that will be populated by the successful output of the script task. The script task is represented by a script.php file.
It is the responsibility of the caller to have these files prepared before executing the engine via command line (or docker API).

## Script Task design
When writing a Script Task, three variables are available.  They are:

- $data - A PHP associative array that represents the data loaded from data.json
- $config - A PHP associative array that represents the config loaded from config.json
- $client - The ProcessMaker 4 PHP SDK Client preconfigured to access the API via OAuth authentication

Your script should execute quickly. Once the script is complete, your return statement will be used and converted to JSON which
will be stored in the output.json file.  Once the docker execution is complete, you should the return code of the docker execution. 
If the code is 0, then the script task executed successfully and you can read output.json for the valid output.  If it is non-zero,
then you should review STDERR to see the error that was displayed during execution.

### Example data.json
```json
{
  "firstname": "Taylor"
}
```

### Example Script Task
```php
<?php
// Uppercase the entire firstname attribute
$data['firstname'] = strtoupper($data['firstname']);
// Return it
return $data;
```

### Example output.json
```json
{"firstname":"TAYLOR"}
```

## Command Line Usage
```bash
$ docker run -v <path to local data.json>:/opt/executor/data.json \
  -v <path to local config.json>:/opt/executor/config.json \
  -v <path to local script.php>:/opt/executor/script.php \
  -v <path to local output.json>:/opt/executor/output.json \
  processmaker/executor:php \
  php /opt/executor/bootstrap.php
```

#### License

Distributed under the [AGPL Version 3](https://www.gnu.org/licenses/agpl-3.0.en.html)

ProcessMaker \(C\) 2002 - 2021 ProcessMaker Inc.

For further information visit: [http://www.processmaker.com/](http://www.processmaker.com/)
