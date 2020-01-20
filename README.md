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
[
	'auth-security' => [
    	"class" => "devskyfly\yiiModuleAuthSecurity\Module",
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

Config login view

```php
use devskyfly\yiiModuleAuthSecurity\widgets\auth\LoginForm;
echo LoginForm::widget(compact("model"));
```