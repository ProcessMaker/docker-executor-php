# Process Categories SDK Examples

These examples can be used directly in the script editor.

## Get Process Categories

```php
<?php
$apiInstance = $api->processCategories();

$processCategories = [];
$result = $apiInstance->getProcessCategories();

foreach($result->getData() as $processCategory) {
    $processCategories[] = [
        'name' => $processCategory->getName(),
        'status' => $processCategory->getStatus(),
    ];
}

return ['processCategories' => $processCategories];
```

## Get Process Category
```php
<?php
$apiInstance = $api->processCategories();

$processCategory = $apiInstance->getProcessCategoryById(2);

return [
    'name' => $processCategory->getName(),
    'status' => $processCategory->getStatus(),
];
```

## Create Process Category

```php
<?php
$apiInstance = $api->processCategories();

$process_category_editable = new \ProcessMaker\Client\Model\ProcessCategoryEditable();
$process_category_editable->setName('test');
$process_category_editable->setStatus('ACTIVE');
$newProcessCategory = $apiInstance->createProcessCategory($process_category_editable);

return ['newProccessCategoryId' => $newProcessCategory->getId()];
```

## Update Process Category

```php
<?php
$apiInstance = $api->processCategories();

$processCategory = $apiInstance->getProcessCategoryById(2);
$processCategory->setName("Updated name");

$apiInstance->updateProcessCategory($processCategory->getId(), $processCategory);

// If no errors are thrown, then the process category was successfully updated
return ['success' => true];
```

## Delete Process Category

```php
<?php
$apiInstance = $api->processCategories();

$apiInstance->deleteProcessCategory(4);

// If no errors are thrown, then the process category was successfully deleted
return ['success' => true];
```

