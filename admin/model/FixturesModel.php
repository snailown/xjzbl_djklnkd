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
class FixturesModel extends BaseModel{
    const _table = 'starcraft_fixtures';
    
    const _id = 'id';
    const _name = 'name';
    const _item = 'item_id';
    const _item_time = 'item_time_id';
    
    private $key = '';
    public function __construct(){
        parent::__construct(self::_table);
    }
    public function getCounts($key){
        if($key != ''){
            $this->key = $key;
            $count_sql = 'select count(id) as num from ' . self::_table . ' where ' . self::_name . ' like \'' . '%' . $this->key . '%\'' ;
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
            $sql = 'select * from ' . self::_table . ' where ' . self::_name . ' like \'' . '%' . $this->key . '%\'' . $limit;
        }else{
            $sql = 'select * from ' . self::_table . ' order by id desc ' . $limit;
        }
        return $this->db->doSql($sql);
    }
    public function getAllList(){
        return $this->db->fetch(self::_table, '', '', '', '*' );
    }
    
    public function add($name, $item, $itemTime){
        return $this->db->insert(self::_table, array(self::_name => $name, self::_item => $item, self::_item_time => $itemTime));
    }
    public function update($id, $name, $item, $itemTime){
        $id = intval($id);
        if($id == 0){
            return false;
        }
        $data = array(
            self::_name => $name,
            self::_item => $item, 
            self::_item_time => $itemTime,
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
    public function getFixturesName($id){
        $fixtures = $this->get($id);
        if($fixtures != null){
            return $fixtures[self::_name];
        }else{
            return '--';
        }
    }
}
