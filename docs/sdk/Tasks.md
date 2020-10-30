# Task SDK Examples

These examples can be used directly in the script editor.

## Get Tasks

```php
<?php
$apiInstance = $api->tasks();

$tasks = [];

// Returns all tasks that the user has access to

$result = $apiInstance->getTasks();
foreach ($result->getData() as $task) {
    $tasks[] = [
        'id' => $task->getId(),
        'name' => $task->getElementName(),
        'processRequestId' => $task->getProcessRequestId(),
        'status' => $task->getStatus(),
        'userId' => $task->getUserId(),
    ];
}

// Optional arguments
$process_request_id = 5; // int | Process request id
$filter = 'Form Task'; // string | filter by task id, node name, or request data
$order_by = 'id'; // string | Field to order results by
$order_direction = 'asc'; // string | 
$include = 'process,user'; // string | Include data from related models in payload. Comma separated list.

$result = $apiInstance->getTasks($process_request_id, $filter, $order_by, $order_direction, $include);
foreach ($result->getData() as $task) {
    $tasks[] = [
        'id' => $task->getId(),
        'name' => $task->getElementName(),
        'status' => $task->getStatus(),
        'userEmail' => $task->getUser()['email'],
        'processName' => $task->getProcess()['name']
    ];
}

return ['tasks' => $tasks];
```

## Get Task

```php
<?php
$apiInstance = $api->tasks();

$taskId = 15;
$task = $apiInstance->getTasksById($taskId);

return [
    'task' => [
        'name' => $task->getElementName(),
        'status' => $task->getStatus(),
        'userId' => $task->getUserId()
    ]
];
```

## Update Task

Used to complete a task

```php
<?php
$apiInstance = $api->tasks();

$taskId = 15;
$task = $apiInstance->getTasksById($taskId);

$process_request_token_editable = new \ProcessMaker\Client\Model\ProcessRequestTokenEditable();
$process_request_token_editable->setStatus('COMPLETED');
$process_request_token_editable->setData(['addToRequestData' => 'a value']);

$result = $apiInstance->updateTask($taskId, $process_request_token_editable);

// If no errors are thrown, then the task was successfully updated
return ['success' => true];
```