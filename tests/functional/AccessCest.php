<?php

use devskyfly\yiiModuleAuthSecurity\models\auth\User;

class AccessCest
{
    public $adminLogin = "admin";

    public $adminEmail = "admin@admin.com";

    public $adminPassword = "123456";
    
    public $adminNewPassword = "1234567";

    public function _before(FunctionalTester $I)
    {

    }

    public function addAdmin(FunctionalTester $I)
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
    public function accessAdminPage(FunctionalTester $I)
    {
        $this->amOnPage(['site/admin-page']);
        //$this->see('Login form');
    }

}
