<?php

use devskyfly\yiiModuleAuthSecurity\models\auth\User;

class FiltersCest
{
    public $adminLogin = "admin";

    public $adminEmail = "admin@admin.com";

    public $adminPassword = "123456";

    public function addAdmin(FunctionalTester $I)
    {
        $I->runShellCommand("robo tests:clear");
        $I->runShellCommand("./yii auth-security/auth/user/index");
        $I->runShellCommand("./yii auth-security/auth/user/add --login={$this->adminLogin} --email={$this->adminEmail} --password={$this->adminPassword}");
        $I->assertEquals(1, User::find()->where([])->count());
        
        $user = User::findOne(['username' => $this->adminLogin]);
        $I->assertTrue($user->validatePassword($this->adminPassword));
    }

    /**
     * @depends addAdmin
     * @param FunctionalTester $I
     * @return void
     */
    public function adminPage(FunctionalTester $I)
    {
        $I->amOnPage(['site/admin-page']);
        $I->see('Login form');

        $I->submitForm('#login-form', [
            'LoginForm[username]' => $this->adminLogin,
            'LoginForm[password]' => $this->adminPassword
        ]);

        $I->see('Admin page');
    }
}
