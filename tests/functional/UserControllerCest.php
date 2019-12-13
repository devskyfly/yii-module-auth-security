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
     * Undocumented function
     *
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
}
