# Notifications SDK Examples

These examples can be used directly in the script editor.

## Get Notifications

Get all notifications for the user

```php
<?php
$apiInstance = $api->notifications();

$result = $apiInstance->getNotifications();

foreach ($result->getData() as $notification) {
    $notifications[] = [
        'id' => $notification->getId(),
        'type' => $notification->getType(),
        'notifiableType' => $notification->getNotifiableType(),
        'notifiableId' => $notification->getNotifiableId(),
        'name' => $notification->getName(),
        'message' => $notification->getMessage(),
    ];
}

return ['notifications' => $notifications];
```

## Create Notification

```php
<?php
$apiInstance = $api->notifications();

$notification = new \ProcessMaker\Client\Model\NotificationEditable();
$notification->setType('ProcessMaker\Notifications\ActivityActivatedNotification');
$notification->setNotifiableType('ProcessMaker\Models\User');
$notification->setNotifiableId(1);
$notification->setData(
    json_encode([
        'name' => "Test Name",
        'message' => "Test Message",
    ])
);

$newNotification = $apiInstance->createNotification($notification);

return ['newNotificationId' => $newNotification->getId()];
```

## Get Notification By Id

```php
<?php
$apiInstance = $api->notifications();

$notification = $apiInstance->getNotificationById('121910f1-d01a-4bee-bb27-f6a5a4b80656');

return [
    'type' => $notification->getType(),
    'notifiableType' => $notification->getNotifiableType(),
    'notifiableId' => $notification->getNotifiableId(),
    'data' => json_decode($notification->getData()),
];
```


## Update Notification

```php
<?php
$apiInstance = $api->notifications();

$notification = $apiInstance->getNotificationById('121910f1-d01a-4bee-bb27-f6a5a4b80656');

$data = json_decode($notification->getData(), true);
$data['name'] = 'Updated Name';

$updateNotification = new \ProcessMaker\Client\Model\NotificationEditable();

$updateNotification->setData(
    json_encode($data)
);

$apiInstance->updateNotification(
    $notification->getId(),
    $updateNotification
);

// If no errors are thrown, then the notification was successfully updated
return ['success' => true];
```

## Delete Notification

```php
<?php
$apiInstance = $api->notifications();

$apiInstance->deleteNotification('121910f1-d01a-4bee-bb27-f6a5a4b80656');

// If no errors are thrown, then the notification was successfully deleted
return ['success' => true];
```

## Mark Notification As Read

```php
<?php
$apiInstance = $api->notifications();

$apiInstance->markNotificationAsRead([
    'message_ids' => [
        'b5fd1292-9c65-4416-b967-4bc322243363'
    ],
    'routes' => [],
]);

// If no errors are thrown, then the notification was successfully updated
return ['success' => true];
```

## Mark Notification As Unread

```php
<?php
$apiInstance = $api->notifications();

$apiInstance->markNotificationAsUnread([
    'message_ids' => [
        'b5fd1292-9c65-4416-b967-4bc322243363'
    ],
    'routes' => [],
]);

// If no errors are thrown, then the notification was successfully updated
return ['success' => true];
```

## Mark All As Unread For A Type

```php
<?php
$apiInstance = $api->notifications();

$apiInstance->markAllAsRead([
    'id' => 1,
    'type' => 'ProcessMaker\Models\User'
]);

// If no errors are thrown, then the notification was successfully updated
return ['success' => true];
```