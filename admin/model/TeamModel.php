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
class TeamModel extends BaseModel{
    const _table = 'starcraft_team';
    
    const _id = 'id';
    const _name = 'name';
    const _logo = 'logo';
    const _country = 'country';
    const _coach_id = 'coach_id';
    const _leader = 'leader';
    
    private $key = '';
    public function __construct(){
        parent::__construct(self::_table);
    }
    public function getCounts($key){
        if($key != ''){
            $this->key = $key;
            $count_sql = 'select count(id) as num from ' . self::_table . ' where ' 
                    . self::_name . ' like \'' . '%' . $this->key . '%\'' 
                    ;
            $result = $this->db->doSql($count_sql);
            foreach($result as $temp);
            $this->counts = @intval($temp['num']);     
        }else{
            $this->key = '';
            return $this->getCount();
        }
    }
    public function getList(){
        $limit = ' limit '. $this->page->getStart() . ',' . $this->page->getShowrows();
        if($this->key != ''){
            $sql = 'select * from ' . self::_table . ' where ' 
                    . self::_name . ' like \'' . '%' . $this->key . '%\'' 
                    . ' order by types asc ' . $limit;
        }else{
            $sql = 'select * from ' . self::_table . ' order by types asc ' . $limit;
        }
        return $this->db->doSql($sql);
    }
    public function getAllList(){
        return $this->db->fetch(self::_table, '', '', '', '*');
    }
    
    public function add($name, $logo, $country, $coach, $leader){
        return $this->db->insert(self::_table, 
                array(
                    self::_name => $name, 
                    self::_logo => $logo, 
                    self::_country => $country,
                    self::_coach_id => $coach, 
                    self::_leader => $leader, 
                ));
    }
    
    public function update($id, $name, $logo, $country, $coach, $leader){
        $id = intval($id);
        if($id == 0){
            return false;
        }
        $data = array(
                    self::_name => $name, 
                    self::_logo => $logo, 
                    self::_country => $country,
                    self::_coach_id => $coach, 
                    self::_leader => $leader, 
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
