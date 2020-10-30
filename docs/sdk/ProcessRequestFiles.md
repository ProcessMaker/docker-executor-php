# Process Request Files SDK Examples

These examples can be used directly in the script editor.

## Get Process Request Files

All files in a process request

```php
<?php
$apiInstance = $api->requestFiles();

$processRequestId = 5;
$files = [];
$result = $apiInstance->getRequestFiles($processRequestId);
foreach ($result->getData() as $file) {
    $files[] = [
        'id' => $file->getId(),
        'filename' => $file->getFileName(),
        'size' => $file->getSize(),
    ];
}
return ['files' => $files];
```

## Get Process Request File

```php
<?php
$apiInstance = $api->requestFiles();

$processRequestId = 5;
$fileId = 6;
$file = $apiInstance->getRequestFilesById($processRequestId, $fileId);

$fileContents = file_get_contents($file->getPathname());

return [
    'fileContents' => base64_encode($fileContents),
];
```

## Create Process Request File

```php
<?php
$apiInstance = $api->requestFiles();

$filePath = '/tmp/file.txt';
file_put_contents($filePath, 'test');

$requestId = 5;
$dataName = 'my_file'; // Name of the variable used in a request
$file = $filePath; // Path to the file

$newFile = $apiInstance->createRequestFile($requestId, $dataName, $file);

return ['newFileId' => $newFile->getFileUploadId()];
```