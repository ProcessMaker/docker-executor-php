# Users SDK Examples

These examples can be used directly in the script editor.

## Update Css Setting 

```php
<?php
$apiInstance = $api->cssSettings();

$settings_editable = new \ProcessMaker\Client\Model\SettingsEditable();
$settings_editable->setKey('css-override');

$settings_editable->setVariables(
    json_encode([
        [
            'id' => '$primary',
            'value' => '#E13333',
            'title' => 'Primary'
        ], [
            'id' => '$secondary',
            'value' => '#788793',
            'title' => 'Secondary'
        ], [
            'id' => '$success',
            'value' => '#00BF9C',
            'title' => 'Success'
        ], [
            'id' => '$info',
            'value' => '#17A2B8',
            'title' => 'Info'
        ], [
            'id' => '$warning',
            'value' => '#F3BB0F',
            'title' => 'Warning'
        ], [
            'id' => '$danger',
            'value' => '#ED4757',
            'title' => 'Danger'
        ], [
            'id' => '$dark',
            'value' => '#000000',
            'title' => 'Dark'
        ], [
            'id' => '$light',
            'value' => '#FFFFFF',
            'title' => 'Light'
        ]
    ])
);

$result = $apiInstance->updateCssSetting($settings_editable);

// If no errors are thrown, then the settings were successfully updated
return ['success' => true];
```