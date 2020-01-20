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