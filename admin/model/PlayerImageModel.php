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
class PlayerImageModel extends BaseModel{
    const _table = 'starcraft_players_images';
    
    const _id = 'id';
    const _pid = 'pid';
    const _url = 'image_url';
    const _order = 'orders';
    
    public function __construct(){
        parent::__construct(self::_table); 
    }
    public function addPlayerImage($id, $url){
        if($id > 0 && $url != ''){
            $data = array(
                self::_pid => $id,
                self::_url => $url
            );
            $verified = $this->db->fetchOne(self::_table, $data, self::_id);
            if($verified == false || $verified == null){
                $result = $this->db->insert(self::_table, $data);
                if($result == false || $result == null){
                    return 0;
                }
                return $result;
            }else{
                return $verified[self::_id];
            }
        }
        return 0;
    }
    public function getPlayerImage($id){
        $id = intval($id);
        if($id == 0){
            return null;
        }
        return $this->db->fetch(self::_table, array(self::_pid => $id), self::_order .' desc ', '', self::_id . ',' . self::_url);
    }
    public function delPlayerImage($id, $url){
        $id = intval($id);
        if($id == 0 || $url == ''){
            return null;
        }
        $result = $this->db->del(self::_table, array(self::_pid => $id, self::_url => $url));
        if($result == false){
            return null;
        }
        return $this->db->fetch(self::_table, array(self::_pid => $id), self::_order .' desc ', '', self::_id . ',' . self::_url);
    }
}
