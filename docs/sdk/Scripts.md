# Scripts SDK Examples

These examples can be used directly in the script editor.

## Get Scripts

```php
<?php
$apiInstance = $api->scripts();

$scripts = [];

// Get all scripts
$result = $apiInstance->getScripts();
foreach ($result->getData() as $script) {
    $scripts[] = [
        'id' => $script->getId(),
        'title' => $script->getTitle(),
        'language' => $script->getLanguage() ];
}

return ['scripts', $scripts];
```

## Get script

```php
<?php
$apiInstance = $api->scripts();

$script = $apiInstance->getScriptsById(1);

return [
    'script' => [
        'title' => $script->getTitle(),
        'language' => $script->getLanguage(),
        'code' => $script->getCode(),
    ]
];
```


## Create script
```php
<?php
$apiInstance = $api->scripts();

$script = new \ProcessMaker\Client\Model\ScriptsEditable();
$script->setTitle('Test');
$script->setDescription('Test');
$script->setScriptCategoryId(14);
$script->setLanguage('php');
$script->setRunAsUserId(1);
$script->setCode('<?php return[]; ?>');

$newScript = $apiInstance->createScript($script);
return ["newScriptId" => $newScript->getId()];
```

## Update script

```php
<?php
$apiInstance = $api->scripts();

$scriptId = 1;
$script = $apiInstance->getScriptsById($scriptId);
$script->setTitle('Updated Title');

$result = $apiInstance->updateScript($scriptId, $script);

// If no errors are thrown, then the script was successfully updated
return ['success' => true];
```

## Delete script

```php
<?php
$apiInstance = $api->scripts();

$apiInstance->deleteScript(588);

// If no errors are thrown, then the script was successfully deleted
return ['success' => true];
```

## Execute script

```php
<?php
$apiInstance = $api->scripts();

$data = ['exampleData' => 1];
$config = ['exampleConfig' => 1];
$execution = $apiInstance->executeScript(
    1, // The script ID to run
    [
        'sync' => true,
        'data' => json_encode($data), // Optional
        'config' => json_encode($config), // Optional
    ]
);

return [
    'result' => $execution->getOutput(),
];
```

## Duplicate Script

```php
<?php
$apiInstance = $api->scripts();

$script_id = 1;
$scripts_editable = new \ProcessMaker\Client\Model\ScriptsEditable();
$scripts_editable->setScriptCategoryId(1);
$scripts_editable->setTitle('Duplicated script');
$scripts_editable->setLanguage('php');
$scripts_editable->setDescription('duplicated script');
$scripts_editable->setRunAsUserId(1);
$newScript = $apiInstance->duplicateScript($script_id, $scripts_editable);

return ['duplicatedScriptId' => $newScript->getId()];
```
