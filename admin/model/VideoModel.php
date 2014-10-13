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
class VideoModel extends BaseModel{
    const _table = 'starcraft_video';
    
    const _id = 'id';
    const _name = 'name';
    const _thumbnails = 'thumbnails';
    const _url = 'url';
    const _player_one = 'player_one_id';
    const _player_two = 'player_two_id';
    const _team_one = 'team_one_id';
    const _team_two = 'team_two_id';
    const _map = 'map_id';
    const _descant = 'descant_id';
    const _during = 'during';
    
    private $key = '';
    public function __construct(){
        parent::__construct(self::_table);
    }
    public function getCounts($key){
        if($key != ''){
            $this->key = $key;
            $count_sql = 'select count(id) as num from ' . self::_table . ' where ' 
                    . self::_name . ' like \'' . '%' . $this->key . '%\'' 
                    . ' or ' . self::_during . ' like \'' . '%' . $this->key . '%\''
//                    . ' or ' . self::_nick . ' like \'' . '%' . $this->key . '%\''
                    ;
            $result = $this->db->doSql($count_sql);
            foreach($result as $temp);
            $this->counts = @intval($temp['num']);     
        }else{
            $this->key = '';
            return $this->getCount();
        }
    }
    public function getList($rid = 0){
        $limit = ' limit '. $this->page->getStart() . ',' . $this->page->getShowrows();
        if($this->key != ''){
            $sql = 'select * from ' . self::_table . ' where ' 
                    . self::_name . ' like \'' . '%' . $this->key . '%\'' 
                    . ' or ' . self::_during . ' like \'' . '%' . $this->key . '%\''
//                    . ' or ' . self::_nick . ' like \'' . '%' . $this->key . '%\''
                    . ' order by id desc ' . $limit;
        }else{
            if($rid == 0){
                $sql = 'select * from ' . self::_table . ' order by id desc ' . $limit;
            }else{
                $sql = 'select * from ' . self::_table . ' where ' . self::_race . '= \'' . $rid . '\' order by id desc ' . $limit;
            }
            
        }
        return $this->db->doSql($sql);
    }
    public function getAllList(){
        return $this->db->fetch(self::_table, '', '', '', '*');
    }
    
    public function add($name, $url, $palyer1, $palyer2, $team1, $team2, $map, $descant, $thumbnails=''){
        return $this->db->insert(self::_table, 
                array(
                    self::_name => $name, 
                    self::_url => $url, 
                    self::_player_one => $palyer1,
                    self::_player_two => $palyer2, 
                    self::_team_one => $team1, 
                    self::_team_two => $team2,
                    self::_map => $map,
                    self::_descant => $descant,
                    self::_thumbnails => $thumbnails,
                ));
    }
    
    public function update($id, $name, $url, $palyer1, $palyer2, $team1, $team2, $map, $descant, $thumbnails=''){
        $id = intval($id);
        if($id == 0){
            return false;
        }
        $data = array(
                    self::_name => $name, 
                    self::_url => $url, 
                    self::_player_one => $palyer1,
                    self::_player_two => $palyer2, 
                    self::_team_one => $team1, 
                    self::_team_two => $team2,
                    self::_map => $map,
                    self::_descant => $descant,
                    self::_thumbnails => $thumbnails,
                );
       
        return $this->db->update(self::_table, $data, array(self::_id => $id));
    }
   
    public function get($id){
        $id = intval($id);
        if($id == 0){
            return null;
        }
        return $this->db->fetchOne(self::_table, array(self::_id => $id));
    }
}