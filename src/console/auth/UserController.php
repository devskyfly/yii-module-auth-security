<?php
namespace devskyfly\yiiModuleAuthSecurity\console\auth;

use devskyfly\php56\core\Cls;
use devskyfly\php56\types\Vrbl;
use devskyfly\yiiModuleAuthSecurity\models\auth\User;
use devskyfly\yiiModuleAuthSecurity\components\UserManager;
use yii\console\Controller;
use yii\helpers\BaseConsole;
use yii\web\IdentityInterface;
use yii\console\ExitCode;

class UserController extends Controller
{
    public $login;
    
    public $password;
    
    public $email; 
    
    public function options($actionID)
    {
        $options = [];
        
        switch ($actionID){
        case "add":
            $options[] = "login";
            $options[] = "password";
            $options[] = "email";
            break;
        case "disable":
            $options[] = "login";
            break;
        case "enable":
            $options[] = "login";
            break;
        case "set-password":
            $options[] = "login";
            $options[] = "password";
            break;
        case "set-email":
            $options[] = "login";
            $options[] = "email";
            break;
        case "delete":
            $options[] = "login";
            break;
        }
        
        return $options;
    }
    
    public function init()
    {
        parent::init();

        if(!Cls::isSubClassOf(static::getUserClass(), IdentityInterface::class)) {
            throw new \InvalidArgumentException('Propoerty $user_cls is not sub class of '.IdentityInterface::class);
        }
    }
    
    /**
     * Show list of all users
     * 
     * @return number
     */
    public function actionIndex()
    {
        try {
            $user_cls = UserManager::getIdentityCls();
            $users = $user_cls::find()->orderBy('username')->all();
            $itr = 0;
            
            if (!empty($users)) {
                foreach ($users as $item) {
                    $itr++;
                    $status=$item['status']==$user_cls::STATUS_ACTIVE?'Y':'N';
                    BaseConsole::output(
                        "{$itr}. {$status} {$item['username']}  ['{$item['email']}'] "
                        .PHP_EOL."password_hash: {$item['password_hash']}"
                        .PHP_EOL."auth_key: {$item['auth_key']}"
                    );
                }
            } else {
                BaseConsole::output('User list is empty.');
            }
        } catch (\Exception $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        } catch (\Throwable $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }
        
        return ExitCode::OK;
    }
    
    /**
     * Set password for user
     * 
     * --login
     * --password
     */
    public function actionSetPassword()
    {
        try{
            $user_cls = UserManager::getIdentityCls();
            
            if (empty($this->login)) {
                $user_name = BaseConsole::prompt('Enter user name:');
            } else {
                $user_name = $this->login;
            }
            
            
            $user = $user_cls::findOne(["username"=>$user_name]);
            
            if (Vrbl::isNull($user)) {
                BaseConsole::stdout("There is no such user '{$user_name}'.".PHP_EOL);
                return ExitCode::UNSPECIFIED_ERROR;
            }
            
            if (empty($this->password)) {
                $password_1 = BaseConsole::input("Insert password:");
                $password_2 = BaseConsole::input("Password again:");
            } else {
                $password_1 = $this->password;
                $password_2 = $this->password;
            }
            
            if ($password_1 !== $password_2) {
                BaseConsole::stdout("Passwords are not equal.");
                return ExitCode::UNSPECIFIED_ERROR;
            }
            
            $result = UserManager::setPassword($user, $password_2);
            
            if ($result) {
                BaseConsole::output("User '{$user->username}' email was updated.".PHP_EOL);
            } else {
                BaseConsole::output("Can't update user '{$user->username}' email.".PHP_EOL);
                $errors = $user->errors;
                if (count($errors) > 0) {
                    BaseConsole::output("User '{$user->username}' is invalide.".PHP_EOL);
                    foreach ($errors as $error_key=>$error_item) {
                        BaseConsole::stdout($error_key.':'.$error_item.PHP_EOL);
                    }
                }
            }
        } catch (\Exception $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        } catch (\Throwable $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }
        return ExitCode::OK; 
    }
    
    /**
     * Set email for user
     * --login --email
     */
    public function actionSetEmail()
    {
        try{
            $user_cls = UserManager::getIdentityCls();
            
            $user_name = BaseConsole::prompt('Enter user name:');
            
            $user = $user_cls::findOne(["username"=>$user_name]);
            
            if (Vrbl::isNull($user)) {
                BaseConsole::stdout("There is no such user '{$user_name}'.".PHP_EOL);
                return ExitCode::UNSPECIFIED_ERROR;
            }
            
            $email = BaseConsole::prompt("Insert email:");
            $result = UserManager::setEmail($user, $email);
            
            
            if ($result) {
                BaseConsole::output("User '{$user->username}' email was updated.".PHP_EOL);
            } else {
                BaseConsole::output("Can't update user '{$user->username}' email.".PHP_EOL);
                $errors = $user->errors;
                if (count($errors) > 0) {
                    BaseConsole::output("User '{$user->username}' is invalide.".PHP_EOL);
                    foreach ($errors as $error_key=>$error_item) {
                        BaseConsole::stdout($error_key.':'.$error_item.PHP_EOL);
                    }
                }
            }
            
        }catch (\Exception $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }catch (\Throwable $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }
        return ExitCode::OK;
    }
    
    /**
     * Enable user (set status property to User::STATUS_ACTIVE).
     * --login
     */
    public function actionEnable()
    {
        try{
            $user_cls = UserManager::getIdentityCls();
            
            if (empty($this->login)) {
                $user_name = BaseConsole::input("Insert user name:");
            } else {
                $user_name = $this->login;
            };
            
            $user = $user_cls::findOne(["username"=>$user_name]);
            
            if (Vrbl::isNull($user)) {
                BaseConsole::stdout("There is no such user '{$user_name}'.".PHP_EOL);
                return ExitCode::UNSPECIFIED_ERROR;
            }
            
            $result = UserManager::enable($user);

            if ($result) {
                BaseConsole::output("User '{$user->username}' was enabled.".PHP_EOL);
            } else {
                BaseConsole::output("Can't enable user '{$user->username}'.".PHP_EOL);
                $errors = $user->errors;
                if (count($errors) > 0) {
                    BaseConsole::output("User '{$user->username}' is invalide.".PHP_EOL);
                    foreach ($errors as $error_key=>$error_item) {
                        BaseConsole::stdout($error_key.':'.$error_item.PHP_EOL);
                    }
                }
            }
            
        }catch (\Exception $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }catch (\Throwable $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }
        return ExitCode::OK;
    }
    
    /**
     * Disable user (set status property to User::STATUS_DELETED).
     * --login
     */
    public function actionDisable()
    {
        try{
            $user_cls = UserManager::getIdentityCls();
            
            if (empty($this->login)) {
                $user_name = BaseConsole::input("Insert user name:");
            } else {
                $user_name = $this->login;
            };
            
            $user = $user_cls::findOne(["username"=>$user_name]);
            
            if (Vrbl::isNull($user)) {
                BaseConsole::stdout("There is no such user '{$user_name}'.".PHP_EOL);
                return ExitCode::UNSPECIFIED_ERROR;
            }
            
            $result = UserManager::disable($user);

            if ($result) {
                BaseConsole::output("User '{$user->username}' was enabled.".PHP_EOL);
            } else {
                BaseConsole::output("Can't enable user '{$user->username}'.".PHP_EOL);
                $errors = $user->errors;
                if (count($errors)> 0) {
                    BaseConsole::output("User '{$user->username}' is invalide.".PHP_EOL);
                    foreach ($errors as $error_key=>$error_item) {
                        BaseConsole::stdout($error_key.':'.$error_item.PHP_EOL);
                    }
                }
            }
            
        }catch (\Exception $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }catch (\Throwable $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }
        return ExitCode::OK;
    }
    
    
    /**
     * Add user to system.
     * 
     * add --login= --email= --password=
     */
    public function actionAdd()
    {
        try{
            $user_cls = UserManager::getIdentityCls();

            $user = new $user_cls();
            
            if (Vrbl::isEmpty($this->login)) {
                $user->username = BaseConsole::input("Insert user name:");
            } else {
                $user->username = $this->login;
            }
            
            if (Vrbl::isEmpty($this->email)) {
                $user->email = BaseConsole::input("Insert email:");
            } else {
                $user->email=$this->email;
            }
            
            if (Vrbl::isEmpty($this->password)) {
                $password_1 = BaseConsole::input("Insert password:");
                $password_2 = BaseConsole::input("Password again:");
            } else {
                $password_1 = $this->password;
                $password_2 = $this->password;
            }
            
            if ($password_1!==$password_2) {
                BaseConsole::stdout("Passwords are not equal.");
                return 0;
            }

            $result = UserManager::add($user, $password_2);
            
            if ($result) {
                BaseConsole::output("User '{$user->username}' added.".PHP_EOL);
            } else {
                BaseConsole::output("Can't add user '{$user->username}'.".PHP_EOL);
                $errors = $user->errors;
                if (count($errors) > 0) {
                    BaseConsole::output("User '{$user->username}' is invalide.".PHP_EOL);
                    foreach ($errors as $error_key=>$error_item) {
                        BaseConsole::stdout($error_key.':'.$error_item.PHP_EOL);
                    }
                }
            }
        } catch (\Exception $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }catch (\Throwable $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }
        return ExitCode::OK; 
    }
    
    /**
     * Delete user from system.
     * --login
     */
    public function actionDelete()
    {
        try{
            $user_cls = UserManager::getIdentityCls();
            
            if (empty($this->login)) {
                $user_name = BaseConsole::input("Insert user name:");
            } else {
                $user_name = $this->login;
            }

            $model=$user_cls::find()->where(['username'=>$user_name])->one();
            
            if(BaseConsole::confirm("Are you sure?")
                &&BaseConsole::confirm("Are you realy sure?")
            ) {
                if(is_null($model)) {
                    BaseConsole::output("No such user '$user_name'.".PHP_EOL);
                }else{
                    if($model->delete()) {
                        BaseConsole::output("User '$user_name' was deleted.");
                    }else{
                        BaseConsole::output("Can't delete $user_name.");
                    }
                }
            }else{
                BaseConsole::output("You discard this action.");
            }
        }catch (\Exception $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
             return ExitCode::UNSPECIFIED_ERROR;
        }catch (\Throwable $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }
        return ExitCode::OK;
    }
    
    /**
     * Delete all users from system.
     */
    public function actionDeleteAll()
    {
        try{
            $user_cls = UserManager::getIdentityCls();
            
            if(BaseConsole::confirm("Are you sure?")
                &&(BaseConsole::confirm("Are you realy sure?"))
            ) {
                try{
                    $user_cls::deleteAll();
                    BaseConsole::output('Users were droped.'.PHP_EOL);
                }catch(\Exception $e){
                    BaseConsole::output("Can\'t drop all users.".PHP_EOL);
                    throw $e;
                }
            }else{
                BaseConsole::output("You discard this action.");
            }
        }catch (\Exception $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }catch (\Throwable $e){
            BaseConsole::stdout($e->getMessage().PHP_EOL.$e->getTraceAsString());
            return ExitCode::UNSPECIFIED_ERROR;
        }
        return ExitCode::OK;
    } 
    
    /**
     * Return user model class name
     *
     * @return string - user classname
     */
    protected static function getUserClass()
    {
        return User::class;
    }
}




   
