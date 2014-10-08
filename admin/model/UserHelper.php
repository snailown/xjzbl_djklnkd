<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'UserModel.php';
/**
 * Description of UserHelper
 *
 * @author koudejian
 */
class UserHelper {
    
    const USER_ID = 'session_uid';
    const USER_NAME = 'session_uname';
    /**
     * 用户登录
     * @param type $user
     * @param type $pass
     * @return boolean
     */
    public static function login($user, $pass){
        if($user != '' && $pass != ''){
            $userModel = new UserModel();
            $user = $userModel->auth($user, $pass);
            if($user != null){
                $_SESSION[self::USER_ID] = $user[UserModel::_id];
                $_SESSION[self::USER_NAME] = $user[UserModel::_user];
                return true;
            }
        }
        return false;
    }
    /**
     * 退出登录
     */
    public static function logout(){
        unset($_SESSION[self::USER_ID]);
        unset($_SESSION[self::USER_NAME]);
    }
    
    /**
     * 是否登录
     * @return type
     */
    public static function isAuth(){
        return ($_SESSION[self::USER_ID] > 0)? true : false;
    }
}
