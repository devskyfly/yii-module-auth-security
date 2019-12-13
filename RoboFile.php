<?php
use devskyfly\robocmd\DevTestTrait;
use yii\db\Migration;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

// загрузка конфигурации приложения
$config = require __DIR__ . '/tests/app/config/console.php';

// создание и конфигурация приложения, а также вызов метода для обработки входящего запроса
$yiiApp = (new yii\web\Application($config));


class RoboFile extends \Robo\Tasks
{
    use DevTestTrait;    

    public function testsClear()
    {
        $db = Yii::$app->db;
        $tables = $db->getSchema()->getTableNames();

        foreach ($tables as $table) {
            if ($table != "migration") {
                $this->say("Truncate table: {$table}");
                $migration = new Migration();
                $migration->truncateTable($table);
            }
        }

        $appPath = $this->testsAppPath();
        $this->taskFilesystemStack()->remove($appPath.'/rbac')->run();

        $this->devAfterInitProject();
    }

    public function devAfterInitProject()
    {
        $appPath = $this->testsAppPath();
        $this->taskFilesystemStack()->mkdir($appPath.'/rbac')->run();
    }
}