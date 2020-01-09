<?php

use devskyfly\yiiModuleAuthSecurity\models\auth\User;

class UserControllerCest
{
    public $adminLogin = "admin";

    public $adminEmail = "admin@admin.com";

    public $adminPassword = "123456";
    
    public $adminNewPassword = "1234567";

    public function _before(FunctionalTester $I)
    {

    }

    public function tryAdd(FunctionalTester $I)
    {
        $I->runShellCommand("./yii auth-security/auth/user/index");
        $I->runShellCommand("./yii auth-security/auth/user/add --login={$this->adminLogin} --email={$this->adminEmail} --password={$this->adminPassword}");
        $I->assertEquals(1, User::find()->where([])->count());
        
        $user = User::findOne(['username' => $this->adminLogin]);
        $I->assertTrue($user->validatePassword($this->adminPassword));
    }

    /**
     * @depends tryAdd
     * @param FunctionalTester $I
     * @return void
     */
    public function trySetPassword(FunctionalTester $I)
    {
        $I->runShellCommand("./yii auth-security/auth/user/set-password --login={$this->adminLogin} --password={$this->adminNewPassword}");
        $user = User::findOne(['username' => $this->adminLogin]);
        $I->assertTrue($user->validatePassword($this->adminNewPassword));
    }

    /**
     * Undocumented function
     *
     * @depends trySetPassword
     * @param FunctionalTester $I
     * @return void
     */
    public function tryDisable(FunctionalTester $I)
    {
        $I->runShellCommand("./yii auth-security/auth/user/disable --login={$this->adminLogin}");
        $user = User::findOne(['username' => $this->adminLogin]);
        $I->assertEquals($user->status, User::STATUS_DELETED);
    }

    /**
     * Undocumented function
     *
     * @depends tryDisable
     * @param FunctionalTester $I
     * @return void
     */
    public function tryEnable(FunctionalTester $I)
    {
        $I->runShellCommand("./yii auth-security/auth/user/enable --login={$this->adminLogin}");
        $user = User::findOne(['username' => $this->adminLogin]);
        $I->assertEquals($user->status, User::STATUS_ACTIVE);
    }

    /**
     * @depends tryEnable
     */
    public function tryAddUsers(FunctionalTester $I)
    {
        $I->runShellCommand("./yii auth-security/auth/user/add --login=user1 --email=user1@test.ru --password=1234");
        $I->runShellCommand("./yii auth-security/auth/user/add --login=user2 --email=user2@test.ru --password=1235");
        $I->runShellCommand("./yii auth-security/auth/user/add --login=user3 --email=user3@test.ru --password=1236");
        $I->runShellCommand("./yii auth-security/auth/user/add --login=user4 --email=user4@test.ru --password=1237");
    }

    /**
     * @depends tryAddUsers
     */
    public function tryAddRoles(FunctionalTester $I)
    {
        $authManager = Yii::$app->authManager;
        
        $adminRole = $authManager->createRole('admin');
        $authManager->add($adminRole);

        $userRole = $authManager->createRole('user');
        $authManager->add($userRole);

        $authManager->addChild($adminRole, $userRole);

        $users = User::findAll([]);

        foreach ($users as $user) {
            if ($user->username == 'admin') {
                $authManager->assign($adminRole, $user->id);
            } else {
                $authManager->assign($userRole, $user->id);
            }
        }
    }
}
