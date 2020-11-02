# Processes SDK Examples

These examples can be used directly in the script editor.

## Start a new process request

```php
<?php
$apiInstance = $api->processes();


$process_id = 8; // int | ID of process to return
$event = 'node_1'; // string | Node ID of the start event
$body = new \stdClass; // object | data that will be stored as part of the created request

$body->foo = 'bar';

$processRequest = $apiInstance->triggerStartEvent($process_id, $event, $body);

return ['newProcessRequestId' => $processRequest->getId()];
```

## Get Processes

```php
<?php
$apiInstance = $api->processes();

$processes = [];

// Returns all processes that the user has access to
$result = $apiInstance->getProcesses();
foreach ($result->getData() as $process) {
    $processes[] = [
        'id' => $process->getId(),
        'name' => $process->getName(),
        'process_category_id' => $process->getProcessCategoryId(),
        'status' => $process->getStatus(),
    ];
}

// Optional Parameters
$filter = 'test';
$order_by = 'id'; // string | Field to order results by
$order_direction = 'asc'; // string | 
$per_page = 5; // int | 
$status = 'ACTIVE'; // string | ACTIVE or INACTIVE
$include = 'category'; // string | Include data from related models in payload. Comma separated list.

$result = $apiInstance->getProcesses($filter, $order_by, $order_direction, $per_page, $status, $include);
foreach ($result->getData() as $process) {
    $processes[] = [
        'id' => $process->getId(),
        'name' => $process->getName(),
        'categoryName' => $process->getCategory()['name'],
        'status' => $process->getStatus(),
    ];
}

return ['processes' => $processes];
```

## Get Process
```php
<?php
$apiInstance = $api->processes();

$process = $apiInstance->getProcessById(1);

return [
    'name' => $process->getName(),
    'categoryName' => $process->getCategory()['name'],
    'status' => $process->getStatus(),
];
```

## Create Process
```php
<?php
$apiInstance = $api->processes();

$process_editable = new \ProcessMaker\Client\Model\ProcessEditable(); // \ProcessMaker\Client\Model\ProcessEditable | 
$process_editable->setName("test process");
$process_editable->setDescription("test process description");
$newProcess = $apiInstance->createProcess($process_editable);
return ["newProcessId" => $newProcess->getId()];
```

## Get Process
```php
<?php
$apiInstance = $api->processes();

$process = $apiInstance->getProcessById(4);
$process->setName('new name');
$result = $apiInstance->updateProcess($process->getId(), $process);

// If no errors are thrown, then the process was successfully updated
return ['success' => true];
```

## Delete Process
```php
<?php
$apiInstance = $api->processes();
$process = $apiInstance->deleteProcess(3);

// If no errors are thrown, then the process was successfully deleted
return ['success' => true];
```

## Restore Deleted Process
```php
<?php
$apiInstance = $api->processes();
$process = $apiInstance->restoreProcess(3);

// If no errors are thrown, then the process was successfully restored 
return ['success' => true];
```

## List processes a user can start

```php
<?php
$apiInstance = $api->processes();

$processes = [];

// Returns all processes that the user can start
$result = $apiInstance->startProcesses();
foreach ($result->getData() as $process) {
    $processes[] = [
        'id' => $process->getId(),
        'name' => $process->getName(),
        'process_category_id' => $process->getProcessCategoryId(),
        'status' => $process->getStatus(),
    ];
}


// Optional parameters
$filter = 'test'; // string | Filter results by string. Searches Name, Description, and Status. Status must match exactly. Others can be a substring.
$order_by = 'id'; // string | Field to order results by
$order_direction = 'asc'; // string | 
$per_page = 10; // int | 
$include = 'category'; // string | Include data from related models in payload. Comma separated list.

$result = $apiInstance->startProcesses($filter, $order_by, $order_direction, $per_page, $include);

$processes[] = [
    'id' => $process->getId(),
    'name' => $process->getName(),
    'categoryName' => $process->getCategory()['name'],
    'status' => $process->getStatus(),
];

return ['processes' => $processes];
```


## Export Process
```php
<?php
$apiInstance = $api->processes();
$process_id = 1; // int | ID of process to export
$result = $apiInstance->exportProcess($process_id);

return [
    'downloadUrl' => $result->getUrl(),
];
```

## Import Process
```php
<?php
$apiInstance = $api->processes();

$exportedProcess = 'http://some-server/exported-process.json';
$tmpFile = '/tmp/process.json';
copy($exportedProcess, $tmpFile);
$result = $apiInstance->importProcess($tmpFile);

return [
    'importedProcessId' => $result->getProcess()['id']
];
```

## Set assignments for an imported process
```php
<?php
$apiInstance = $api->processes();

$process_id = 9; // int | ID of process to return
$process_assignments = new \ProcessMaker\Client\Model\ProcessAssignments();

$process_assignments->setEditData([
    'users' => [1],
    'groups' => [],
]);
$apiInstance->assignmentProcess($process_id, $process_assignments);

// If no errors are thrown, then the process assignments were successfully set
return ['success' => true];
```
