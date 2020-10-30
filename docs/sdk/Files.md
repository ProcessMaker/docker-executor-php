# Files SDK Examples

These examples can be used directly in the script editor.

## Get Files

```php
<?php
$apiInstance = $api->files();

$files = [];

// Get all files in the system
$result = $apiInstance->getFiles();
foreach ($result->getData() as $file) {
    $files[] = [
        'id' => $file->getId(),
        'file_name' => $file->getFileName(),
        'model_type' => $file->getModelType(),
        'model_id' => $file->getModelId(),

        // Variable name in the request data
        'data_name' => $file->getCustomProperties()['data_name'], 
    ];
}

return ['files', $files];
```

## Get File

Gets info about a file in the system. To actually fetch the file see Get File Contents

```php
<?php
$apiInstance = $api->files();

$fileId = 1;
$file = $apiInstance->getFileById($fileId);

return [
    'file' => [
        'file_name' => $file->getFileName(),
        'model_type' => $file->getModelType(),
        'model_id' => $file->getModelId(),
        'data_name' => $file->getCustomProperties()['data_name'], 
    ],
];
```

## Create File

Note: To upload files to a request, use createRequestFile

```php
<?php
$apiInstance = $api->files();

$filePath = '/tmp/file.txt';
file_put_contents($filePath, 'test');

$model_id = 20; // int | ID of the model to which the file will be associated
$model = 'ProcessMaker\Models\ProcessRequest'; // Full namespaced class of the model to associate
$data_name = 'my_file'; // Name of the variable used in a request
$collection = 'default'; // string | Media collection name. For requests, use 'default'
$file = $filePath; // Path to the file

$newFile = $apiInstance->createFile($model_id, $model, $data_name, $collection, $file);

return ['newFileId' => $newFile->getId()];
```

## Get File Contents

```php
<?php
$apiInstance = $api->files();

$fileId = 8;
$file = $apiInstance->getFileContentsById($fileId);
$fileContents = file_get_contents($file->getPathname());

return [
    'fileContents' => base64_encode($fileContents),
];
```

## Delete File

```php
<?php
$apiInstance = $api->files();

$fileId = 8;
$apiInstance->deleteFile($fileId);

// If no errors are thrown, then the file was successfully deleted
return ['success' => true];
```