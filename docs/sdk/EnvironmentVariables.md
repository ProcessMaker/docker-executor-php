# Environment Variables SDK Examples

These examples can be used directly in the script editor.

## Get Environment Variables

```php
<?php
$apiInstance = $api->environmentVariables();

$result = $apiInstance->getEnvironmentVariables();

foreach ($result->getData() as $envVar) {
    $envVars[] = [
        'name' => $envVar->getName(),
        'description' => $envVar->getDescription(),
    ];
}

return ['environmentVariables' => $envVars];
```

## Get Environment Variable by ID

```php
<?php
$apiInstance = $api->environmentVariables();

$envVar = $apiInstance->getEnvironmentVariableById(11);

return [
    'name' => $envVar->getName(),
    'description' => $envVar->getDescription(),
];
```

## Create Environment Variable 

```php
<?php
$apiInstance = $api->environmentVariables();

$environment_variable_editable = new \ProcessMaker\Client\Model\EnvironmentVariableEditable();
$environment_variable_editable->setName('test');
$environment_variable_editable->setDescription('test');
$environment_variable_editable->setValue('123');
$newEnvVar = $apiInstance->createEnvironmentVariable($environment_variable_editable);

return ['newEnvVarId' => $newEnvVar->getId()];
```

## Update Environment Variable

```php
<?php
$apiInstance = $api->environmentVariables();

$envVar = $apiInstance->getEnvironmentVariableById(11);

$envVar->setName('test_updated');
$envVar->setDescription('test description updated');
$envVar->setValue('12345');

$apiInstance->updateEnvironmentVariable(
    $envVar->getId(),
    $envVar
);

// If no errors are thrown, then the environment variable was successfully updated
return ['success' => true];
```

## Delete Environment Variable
```php
<?php
$apiInstance = $api->environmentVariables();

$apiInstance->deleteEnvironmentVariable(15);

// If no errors are thrown, then the environment variable was successfully deleted
return ['success' => true];
```