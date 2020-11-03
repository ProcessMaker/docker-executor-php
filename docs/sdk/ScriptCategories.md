# Script Categories SDK Examples

These examples can be used directly in the script editor.

## Get Script Categories

```php
<?php
$apiInstance = $api->scriptCategories();

$scriptCategories = [];
$result = $apiInstance->getScriptCategories();

foreach($result->getData() as $scriptCategory) {
    $scriptCategories[] = [
        'id' => $scriptCategory->getId(),
        'name' => $scriptCategory->getName(),
        'status' => $scriptCategory->getStatus(),
    ];
}

return ['scriptCategories' => $scriptCategories];
```

## Get Script Category
```php
<?php
$apiInstance = $api->scriptCategories();

$scriptCategory = $apiInstance->getScriptCategoryById(3);

return [
    'name' => $scriptCategory->getName(),
    'status' => $scriptCategory->getStatus(),
];
```

## Create Script Category

```php
<?php
$apiInstance = $api->scriptCategories();

$script_category_editable = new \ProcessMaker\Client\Model\ScriptCategoryEditable();
$script_category_editable->setName('test');
$script_category_editable->setStatus('ACTIVE');
$newScriptCategory = $apiInstance->createScriptCategory($script_category_editable);

return ['newProccessCategoryId' => $newScriptCategory->getId()];
```

## Update Script Category

```php
<?php
$apiInstance = $api->scriptCategories();

$scriptCategory = $apiInstance->getScriptCategoryById(3);
$scriptCategory->setName("Updated name");

$apiInstance->updateScriptCategory($scriptCategory->getId(), $scriptCategory);

// If no errors are thrown, then the script category was successfully updated
return ['success' => true];
```

## Delete Script Category

```php
<?php
$apiInstance = $api->scriptCategories();

$apiInstance->deleteScriptCategory(3);

// If no errors are thrown, then the script category was successfully deleted
return ['success' => true];
```

