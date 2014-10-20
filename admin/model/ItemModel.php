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
class ItemModel extends BaseModel{
    const _table = 'starcraft_video_item';
    
    const _id = 'id';
    const _name = 'name';
    const _parent = 'parent';
    const _have_time = 'have_time';
//    const _final_name = 'final_name';
    
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
        return $this->db->fetch(self::_table, '', '', '', self::_id . ',' . self::_name );
    }
    
    public function getItemList($id=0){
        return $this->db->fetch(self::_table, self::_parent . '= \''.$id.'\' and ' . self::_have_time . '=\'0\'' , '', '', self::_id . ',' . self::_name );
    }
    public function getItemTimeList($id=0){
        return $this->db->fetch(self::_table, self::_parent . '= \''.$id.'\' and ' . self::_have_time . '=\'1\'' , '', '', self::_id . ',' . self::_name );
    }
    
    public function add($name, $parent, $have_time){
        return $this->db->insert(self::_table, array(self::_name => $name, self::_parent => $parent, self::_have_time => $have_time));
    }
    public function update($id, $name, $parent, $have_time){
        $id = intval($id);
        if($id == 0){
            return false;
        }
        $data = array(
            self::_name => $name,
            self::_parent => $parent,
            self::_have_time => $have_time,
        );
        return $this->db->update(self::_table, $data, array(self::_id => $id));
    }
    
    public function getItem($id){
        $id = intval($id);
        if($id == 0){
            return null;
        }
        return $this->db->fetchOne(self::_table, array(self::_id => $id));
    }
    public function getParents(){
        return $this->db->fetch(self::_table, array(self::_parent => '0'), '', '', self::_id . ',' . self::_name );
    }
    
    public function getTimeItems(){
        return $this->db->fetch(self::_table, self::_parent. ' > \'0\' and ' . self::_have_time . ' = \'1\'', '', '', self::_id . ',' . self::_name );
    }
    
    
    public function getPickId($title, $time){
        if($title == ''){
            return 0;
        }
        $item = $this->db->fetchOne(self::_table, array(self::_name => $title));
        if(count($item) > 0){
            return $item[self::_id];
        }else{
            return $this->add($title, '2', $time == '' ? '0' : '1');
        }
    }
}
