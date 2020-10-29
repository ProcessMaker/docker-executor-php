# Group Members SDK Examples

These examples can be used directly in the script editor.

## Get Group Members

Get all the groups the current user belongs to

```php
<?php
$apiInstance = $api->groupMembers();

$groupMembers = [];

$result = $apiInstance->getGroupMembers();
foreach ($result->getData() as $groupMember) {
    $groupMembers[] = [
        'group_id' => $groupMember->getGroupId(),
        'member_type' => $groupMember->getMemberType(),
        'member_id' => $groupMember->getMemberId()
    ];
}

// Show groups for other users (Script must be run as an admin user)
$member_id = 5; // User id

// Other optional arguments
$order_by = 'id';
$order_direction = 'asc';
$per_page = 10;

$result = $apiInstance->getGroupMembers($member_id, $order_by, $order_direction, $per_page);;

foreach ($result->getData() as $group) {
    $groupMembers[] = [
        'group_id' => $groupMember->getGroupId(),
        'member_type' => $groupMember->getMemberType(),
        'member_id' => $groupMember->getMemberId()
    ];
}

return ['groupMembers', $groupMembers];
```