<?php
$authSecurity = require __DIR__ . '/auth-security.php';
$adminPanel = require __DIR__ . '/admin-panel.php';


return [
    'auth-security' => $authSecurity,
    'admin-panel' => $adminPanel,
];
