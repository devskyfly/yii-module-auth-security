<?php
$db = require __DIR__ . '/db.php';
$user = require __DIR__ . '/user.php';
$authManager = require __DIR__ . '/authManager.php';


return [
    'db' => $db,
    'user' => $user,
    'authManager' => $authManager
];
