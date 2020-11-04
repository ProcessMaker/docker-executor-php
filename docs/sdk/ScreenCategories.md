# Screen Categories SDK Examples

These examples can be used directly in the screen editor.

## Get Screen Categories

```php
<?php
$apiInstance = $api->screenCategories();

$screenCategories = [];
$result = $apiInstance->getScreenCategories();

foreach($result->getData() as $screenCategory) {
    $screenCategories[] = [
        'id' => $screenCategory->getId(),
        'name' => $screenCategory->getName(),
        'status' => $screenCategory->getStatus(),
    ];
}

return ['screenCategories' => $screenCategories];
```

## Get Screen Category
```php
<?php
$apiInstance = $api->screenCategories();

$screenCategory = $apiInstance->getScreenCategoryById(5);

return [
    'name' => $screenCategory->getName(),
    'status' => $screenCategory->getStatus(),
];
```

## Create Screen Category

```php
<?php
$apiInstance = $api->screenCategories();

$screen_category_editable = new \ProcessMaker\Client\Model\ScreenCategoryEditable();
$screen_category_editable->setName('test');
$screen_category_editable->setStatus('ACTIVE');
$newScreenCategory = $apiInstance->createScreenCategory($screen_category_editable);

return ['newProccessCategoryId' => $newScreenCategory->getId()];
```

## Update Screen Category

```php
<?php
$apiInstance = $api->screenCategories();

$screenCategory = $apiInstance->getScreenCategoryById(5);
$screenCategory->setName("Updated name");

$apiInstance->updateScreenCategory($screenCategory->getId(), $screenCategory);

// If no errors are thrown, then the screen category was successfully updated
return ['success' => true];
```

## Delete Screen Category

```php
<?php
$apiInstance = $api->screenCategories();

$apiInstance->deleteScreenCategory(5);

// If no errors are thrown, then the screen category was successfully deleted
return ['success' => true];
```

