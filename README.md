## Yii2 Module Auth and Security

### Install

Composer

```bash
composer require devskyfly/yii-module-auth-security
```

Migrations

```bash
./yii migrate --migrationPath="vendor/devskyfly/yiiModuleAuthSecurity/migrations"
```

### Config

Config app access
```php
'as accessfilter' => [
	'class' => 'yii\filters\AccessControl',
	'except' => [ 'site/login'],
	'rules' => [
		[
			'allow' => true,
			'roles' => ['@']
		],
	]
]
```

Config app components

```php
[
	'authManager' => [
    	'class' => 'yii\rbac\PhpManager'
	],
	'user' => [
		'class' => 'yii\web\User',
		'identityClass' => 'devskyfly\yiiModuleAuthSecurity\models\auth\User',
		'loginUrl' => ['/site/login']
	]
]
```

Config app modules

```php
'modules' => [
	'auth-security' => [
		"class" => "devskyfly\yiiModuleAuthSecurity\Module",
		"loginTitle" = "Login page";
    	"loginKeywords" = "Login keywords";
    	"loginDescription" = "Login description";
	] 
]
```

Config app controller

```php
public function actions()
{
	return [
		'error' => [
			'class' => ErrorAction::class,
		],
		'login' => [
			'class' => LoginAction::class
		],
		'logout' => [
			'class' => LogoutAction::class
		],
	];
}
```

Config app login view by creating file /views/site/login.php

```php
use devskyfly\yiiModuleAuthSecurity\widgets\auth\LoginForm;
echo LoginForm::widget(compact("loginForm"));
```