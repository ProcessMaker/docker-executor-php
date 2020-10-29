# Get Users
```php
<?php
$config = ProcessMaker\Client\Configuration::getDefaultConfiguration()->setAccessToken(getenv('API_TOKEN'));
$config->setHost(getenv('API_HOST'));

$apiInstance = new ProcessMaker\Client\Api\UsersApi(
    new GuzzleHttp\Client(),
    $config
);

$users = [];

$result = $apiInstance->getUsers();
foreach ($result->getData() as $user) {
    $users[] = [ 'username' => $user->getUsername(), 'email' => $user->getEmail() ];
}

// With optional arguments
$status = 'ACTIVE';
$filter = 'admin';
$order_by = 'id';
$order_direction = 'asc';
$per_page = 1; 
$include = ''; // Include data from related models in payload. Comma seperated list.

$result = $apiInstance->getUsers();
foreach ($result->getData() as $user) {
    $users[] = [ 'username' => $user->getUsername(), 'email' => $user->getEmail() ];
}

return ['users', $users];
```

# Get User

```php
<?php
$config = ProcessMaker\Client\Configuration::getDefaultConfiguration()->setAccessToken(getenv('API_TOKEN'));
$config->setHost(getenv('API_HOST'));

$apiInstance = new ProcessMaker\Client\Api\UsersApi(
    new GuzzleHttp\Client(),
    $config
);

$user = $apiInstance->getUserById(5);

return [
    'user' => [
        'username' => $user->getUsername(),
        'email' => $user->getEmail(),
        'status' => $user->getStatus(),
    ]
];
```


# Create User
```php
<?php
$config = ProcessMaker\Client\Configuration::getDefaultConfiguration()->setAccessToken(getenv('API_TOKEN'));
$config->setHost(getenv('API_HOST'));

$apiInstance = new ProcessMaker\Client\Api\UsersApi(
    new GuzzleHttp\Client(),
    $config
);

$apiInstance = new ProcessMaker\Client\Api\UsersApi(
    new GuzzleHttp\Client(),
    $config
);
$user = new \ProcessMaker\Client\Model\UsersEditable();
$user->setFirstname('Test');
$user->setLastname('User');
$user->setUsername('testuser');
$user->setPassword('password123');
$user->setEmail('testuser@processmaker.com');
$user->setStatus('ACTIVE');

$newUser = $apiInstance->createUser($user);
return ["newUserId" => $newUser->getId()];
```

# Update User

```php
<?php
$config = ProcessMaker\Client\Configuration::getDefaultConfiguration()->setAccessToken(getenv('API_TOKEN'));
$config->setHost(getenv('API_HOST'));

$apiInstance = new ProcessMaker\Client\Api\UsersApi(
    new GuzzleHttp\Client(),
    $config
);

$userId = 5;
$user = $apiInstance->getUserById($userId);
$user->setFirstname('Updated First Name');
$user->setEmail('updated-email@processmaker.com');

$result = $apiInstance->updateUser($userId, $user);

// If no errors are thrown, then the user was successfully updated
return ['success' => true];
```

# Delete User
```php
<?php
$config = ProcessMaker\Client\Configuration::getDefaultConfiguration()->setAccessToken(getenv('API_TOKEN'));
$config->setHost(getenv('API_HOST'));

$apiInstance = new ProcessMaker\Client\Api\UsersApi(
    new GuzzleHttp\Client(),
    $config
);

$apiInstance->deleteUser(4);

// If no errors are thrown, then the user was successfully deleted
return ['success' => true];
```

# Restore Deleted User
```php
<?php
$config = ProcessMaker\Client\Configuration::getDefaultConfiguration()->setAccessToken(getenv('API_TOKEN'));
$config->setHost(getenv('API_HOST'));

$apiInstance = new ProcessMaker\Client\Api\UsersApi(
    new GuzzleHttp\Client(),
    $config
);

$restoreUser = new \ProcessMaker\Client\Model\RestoreUser();
$restoreUser->setUsername('testuser');
$apiInstance->restoreUser($restoreUser);

// If no errors are thrown, then the user was successfully restored
return ['success' => true];
```

# Update User Groups

Set the groups that a user belongs to

```php
<?php
$config = ProcessMaker\Client\Configuration::getDefaultConfiguration()->setAccessToken(getenv('API_TOKEN'));
$config->setHost(getenv('API_HOST'));

$apiInstance = new ProcessMaker\Client\Api\UsersApi(
    new GuzzleHttp\Client(),
    $config
);

$userId = 5;
$groupIds = [2,4];
$updateUserGroups = new \ProcessMaker\Client\Model\UpdateUserGroups();
$updateUserGroups->setGroups($groupIds);

$apiInstance->updateUserGroups($userId, $updateUserGroups);

// If no errors are thrown, then the user's groups were successfully updated
return ['success' => true];
```