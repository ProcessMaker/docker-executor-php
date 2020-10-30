# Process Request SDK Examples

These examples can be used directly in the script editor.

## Get Process Requests

```php
<?php
$apiInstance = $api->processRequests();

$processRequests = [];

// Returns all process Requests that the user has access to
$result = $apiInstance->getProcessesRequests();
foreach ($result->getData() as $processRequest) {
    $processRequests[] = [
        'id' => $processRequest->getId(),
        'status' => $processRequest->getStatus(),
        'processId' => $processRequest->getProcessId()
    ];
}

// Include data and associated process
$type = null; // string | Only return requests by type (all|in_progress|completed)
$filter = null; // string | Filter results by string. Searches Name, Description, and Status. Status must match exactly. Others can be a substring.
$order_by = 'id'; // string | Field to order results by
$order_direction = 'asc'; // string | 
$per_page = null; // int | 
$include = 'process,data'; // string | Include data from related models in payload. Comma separated list.

$result = $apiInstance->getProcessesRequests($type, $filter, $order_by, $order_direction, $per_page, $include);
foreach ($result->getData() as $processRequest) {
    $processRequests[] = [
        'id' => $processRequest->getId(),
        'status' => $processRequest->getStatus(),
        'processName' => $processRequest->getProcess()['name'],
        'requestData' => $processRequest->getData(),
    ];

}

return ['processRequests' => $processRequests];
```

## Get Process Request

```php
<?php
$apiInstance = $api->processRequests();

$processRequestId = 3;
$processRequest = $apiInstance->getProcessRequestById($processRequestId);

$result = [
    'status' => $processRequest->getStatus(),
    'processId' => $processRequest->getProcessId()
];

// Include data, participants, and user that started the request
$include = 'data,participants,user';
$result = $apiInstance->getProcessRequestById($processRequestId, $include);

$result = [
    'status' => $result->getStatus(),
    'data' => $result->getData(),
    'user' => $result->getUser()['username'],
    'participants' => array_map(function($user) {
        return $user['username'];
    }, $result->getParticipants()),
];

return ['processRequest' => $result];
```

## Update Process Request
```php
<?php
$apiInstance = $api->processRequests();

$processRequestId = 4;
$include = 'data';
$processRequest = $apiInstance->getProcessRequestById($processRequestId, $include);
$data = $processRequest->getData();

$data['newItem'] = 'test2';

$processRequestEditable = new \ProcessMaker\Client\Model\ProcessRequestEditable();
$processRequestEditable->setData($data);

$apiInstance->updateProcessRequest($processRequestId, $processRequestEditable);

// If no errors are thrown, then the process request was successfully updated
return ['success' => true];
```

## Delete Process Request

```php
<?php
$apiInstance = $api->processRequests();

$processRequestId = 2;
$apiInstance->deleteProcessRequest($processRequestId);

// If no errors are thrown, then the process request was successfully deleted
return ['success' => true];
```