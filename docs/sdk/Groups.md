# Groups SDK Examples

These examples can be used directly in the script editor.

## Get Groups

```php
<?php
$apiInstance = $api->groups();

$groups = [];

// Get all groups
$result = $apiInstance->getGroups();
foreach ($result->getData() as $group) {
    $groups[] = [
        'id' => $group->getId(),
        'name' => $group->getName(),
        'description' => $group->getDescription(),
        'status' => $group->getStatus()
    ];
}

// Filter and sort groups with optional arguments
$status = 'ACTIVE'; // string | ACTIVE or INACTIVE
$filter = 'designers'; // string | Filter results by string. Searches Name and Description
$order_by = 'name';
$order_direction = 'asc';
$per_page = 10;
$include = ''; // string | Include data from related models in payload. Comma separated list.

$result = $apiInstance->getGroups($status, $filter, $order_by, $order_direction, $per_page, $include);

foreach ($result->getData() as $group) {
    $groups[] = [
        'id' => $group->getId(),
        'name' => $group->getName(),
        'description' => $group->getDescription(),
        'status' => $group->getStatus()
    ];
}

return ['groups', $groups];
```

## Get all users in a group

```php
<?php
$apiInstance = $api->groups();

$users = [];
$groupId = 3;
$result = $apiInstance->getGroupUsers($groupId);

foreach ($result->getData() as $user) {
    $users[] = [
        'id' => $user->getId(),
        'name' => $user->getUsername(),
        'email' => $user->getEmail(),
        'status' => $user->getStatus(),
    ];
}

return ['usersInGroup' => $users];
```

## Get Group

```php
<?php
$apiInstance = $api->groups();

$groupId = 2;
$group = $apiInstance->getGroupById($groupId);
return [
    'group' => [
        'name' => $group->getName(),
        'description' => $group->getDescription(),
        'status' => $group->getStatus(),
    ],
];
```

## Create Group

```php
<?php
$apiInstance = $api->groups();

$group = new \ProcessMaker\Client\Model\GroupsEditable();
$group->setName("New group");
$group->setDescription("New group description");
$group->setStatus("ACTIVE");

$newGroup = $apiInstance->createGroup($group);

return ['newGroupId' => $newGroup->getId()];
```

## Update Group

```php
<?php
$apiInstance = $api->groups();

$groupId = 5;
$group = $apiInstance->getGroupById($groupId);

$group->setName("Updated group name");
$group->setDescription("Updated group description");
$group->setStatus("INACTIVE");

$apiInstance->updateGroup($groupId, $group);

// If no errors are thrown, then the group was successfully updated
return ['success' => true];
```

## Delete Group

```php
<?php
$apiInstance = $api->groups();

$groupId = 5;
$apiInstance->deleteGroup($groupId);

// If no errors are thrown, then the group was successfully deleted 
return ['success' => true];
```