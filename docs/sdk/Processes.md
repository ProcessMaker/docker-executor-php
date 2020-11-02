# Processes SDK Examples

These examples can be used directly in the script editor.

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

