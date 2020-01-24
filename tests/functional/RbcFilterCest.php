<?php

use devskyfly\yiiModuleAuthSecurity\models\auth\User;

class RbcFilterCest
{
    public $adminLogin = "admin";

    public $adminEmail = "admin@admin.com";

    public $adminPassword = "123456";

    public function addUsers(FunctionalTester $I)
    {

        $I->runShellCommand("robo tests:clear");
        //Admin
        $I->runShellCommand("./yii auth-security/auth/user/add --login={$this->adminLogin} --email={$this->adminEmail} --password={$this->adminPassword}");
        //User
        $I->runShellCommand("./yii auth-security/auth/user/add --login=user1 --email=user1@test.ru --password=1234");

        $authManager = Yii::$app->authManager;
        $adminRole = $authManager->createRole('admin');
        $authManager->add($adminRole);

        $userRole = $authManager->createRole('user');
        $authManager->add($userRole);

        $authManager->addChild($adminRole, $userRole);

        $users = User::find()->where([])->all();
        
        foreach ($users as $user) {
            if ($user->username == 'admin') {
                $authManager->assign($adminRole, $user->id);
            } else {
                $authManager->assign($userRole, $user->id);
            }
        }
    }

    /**
     * @depends addUsers
     * @param FunctionalTester $I
     * @return void
     */
    public function loginAdmin(FunctionalTester $I)
    {
        $I->amOnPage(['site/admin-page']);
        
        $I->see('Login form');

        $I->submitForm('#login-form', [
            'LoginForm[username]' => $this->adminLogin,
            'LoginForm[password]' => $this->adminPassword
        ]);

        $I->see('Admin page');
    }

    /**
     * @depends loginAdmin
     * @param FunctionalTester $I
     * @return void
     */
    public function loginUser(FunctionalTester $I)
    {
        $I->amOnPage(['site/auth-page']);
        $I->see('Login form');

        $I->submitForm('#login-form', [
            'LoginForm[username]' => "user1",
            'LoginForm[password]' => "1234"
        ]);

        $I->see('Auth page');
        //$I->see('Index page');
    }
}
