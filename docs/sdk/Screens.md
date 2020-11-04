# Screens SDK Examples

These examples can be used directly in the screen editor.

## Get Screens

```php
<?php
$apiInstance = $api->screens();

$screens = [];

// Get all screens
$result = $apiInstance->getScreens();
foreach ($result->getData() as $screen) {
    $screens[] = [
        'id' => $screen->getId(),
        'title' => $screen->getTitle(),
        'cofnig' => $screen->getConfig() ];
}

return ['screens', $screens];
```

## Get screen

```php
<?php
$apiInstance = $api->screens();

$screen = $apiInstance->getScreensById(2);

return [
    'screen' => [
        'title' => $screen->getTitle(),
        'config' => $screen->getConfig(),
    ]
];
```


## Create screen
```php
<?php
$apiInstance = $api->screens();

$screen = new \ProcessMaker\Client\Model\ScreensEditable();
$screen->setTitle('Test Screen');
$screen->setDescription('Test Description');
$screen->setType('FORM');
$screen->setConfig(['name' => 'test', 'items' => []]);
$screen->setScreenCategoryId(1);

$newScreen = $apiInstance->createScreen($screen);
return ["newScreenId" => $newScreen->getId()];
```

## Update screen

```php
<?php
$apiInstance = $api->screens();

$screenId = 15;
$screen = $apiInstance->getScreensById($screenId);
$screen->setTitle('Updated Title');

$result = $apiInstance->updateScreen($screenId, $screen);

// If no errors are thrown, then the screen was successfully updated
return ['success' => true];
```

## Delete screen

```php
<?php
$apiInstance = $api->screens();

$apiInstance->deleteScreen(15);

// If no errors are thrown, then the screen was successfully deleted
return ['success' => true];
```

## Export screen

```php
<?php
$apiInstance = $api->screens();

$result = $apiInstance->exportScreen(14);

return ['downloadUrl' => $result->getUrl()];
```

## Import screen

```php
<?php
$apiInstance = $api->screens();

$exportedScreen = 'http://some-server/exported-screen.json';
$exportedScreen = 'http://pmdev/screen.json';
$tmpFile = '/tmp/screen.json';
copy($exportedScreen, $tmpFile);
$result = $apiInstance->importScreen($tmpFile);

return ['importResult' => $result->getStatus()];
```