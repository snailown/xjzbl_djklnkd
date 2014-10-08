<?php
//echo 'usermodel';exit;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'BaseModel.php';
/**
 * Description of UserModel
 *
 * @author koudejian
 */
class UserModel extends BaseModel{
    const _table = 'starcraft_admin_user';
    
    const _id = 'id';
    const _user = 'username';
    const _pass = 'passwd';
    
    
    public function __construct(){
        parent::__construct(self::_table); 
    }
    //put your code here
    public function auth($user, $pass){
        if($user != '' && $pass != ''){
            return $this->db->fetchOne(self::_table, array(self::_user => $user, self::_pass => $pass), self::_id . ', ' . self::_user);
        } 
        return null;
    }
    
}
