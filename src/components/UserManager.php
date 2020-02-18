<?php
namespace devskyfly\yiiModuleAuthSecurity\components;

use devskyfly\yiiModuleAuthSecurity\ModuleException;
use yii\web\IdentityInterface;
use yii\base\BaseObject;

class UserManager extends BaseObject
{

    /**
     * Return yii\web\User::identityClass of application.
     *
     * @return string
     */
    public static function getIdentityCls()
    {
        return \Yii::$app->user->identityClass;
    }

    public static function setPassword(IdentityInterface $user, $password)
    {
        $user->setPassword($password);
        $user->generateAuthKey();

        if ($user->validate()) {
            if ($user->saveLikeItem()) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    public static function setEmail(IdentityInterface $user, $email)
    {
        $user->email = $email;

        if ($user->validate()) {
            if ($user->saveLikeItem()) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }



    public static function enable(IdentityInterface $user)
    {
        $userCls = self::getIdentityCls();
        $user->status = $userCls::STATUS_ACTIVE;

        if ($user->validate()) {
            if ($user->saveLikeItem()) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    public static function disable(IdentityInterface $user)
    {
        $userCls = self::getIdentityCls();
        $user->status = $userCls::STATUS_DELETED;

        if ($user->validate()) {
            if ($user->saveLikeItem()) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Undocumented function
     *
     * @param IdentityInterface $user
     * @param string $password
     * @param [] - [extensionName => [field=>val,...]]
     * @return boolean
     */
    public static function add(IdentityInterface $user, $password, $opt = [])
    {
        $user->enableActive();
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->loadLikeItem($opt);

        if ($user->validate()) {
            if (!$user->insertLikeItem()) {
                throw new ModuleException('Can\'t add user');
            }
            return true;
        } else {
            return false;
        }
    }

    public static function delete($login)
    {
        
    }

    public static function deleteAll()
    {
        
    }
}