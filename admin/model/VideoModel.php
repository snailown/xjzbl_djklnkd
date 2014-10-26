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
    const _map = 'map_id';
    const _descant = 'descant_id';
    const _during = 'during';
    const _times = 'times';
    const _item_id = 'item_id';
    const _time_id = 'time_id';
    const _match_id = 'match_id';
    const _fixtures_id = 'fixtures_id';
    const _count = 'counts';
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
    public function getAllNameList(){
        return $this->db->fetch(self::_table, '', '', '', self::_id . ',' . self::_name . ',' . self::_url);
    }
    
    public function add($name, $url, $map, $descant, $thumbnails=''){
        return $this->db->insert(self::_table, 
                array(
                    self::_name => $name, 
                    self::_url => $url, 
 
                    self::_map => $map,
                    self::_descant => $descant,
                    self::_thumbnails => $thumbnails,
                ));
    }
    /**
     * 添加抓取视频
     * @param type $name
     * @param type $url
     * @param type $during
     * @param type $thumbnails
     * @param type $times
     * @param type $item
     * @return type
     */
    public function addPick($name, $url, $during, $thumbnails, $times = 0, $item = 0){
        $video = $this->db->fetchOne(self::_table, array(self::_url => $url));
        if($video == null){
            return $this->db->insert(self::_table, 
                array(
                    self::_name => $name, 
                    self::_url => $url,
                    self::_during => $during,
                    self::_thumbnails => $thumbnails,
                    self::_time_id => $times,
                    self::_item_id => $item,
                ));
        }
    }
    
    public function update($id, $name, $url, $map, $descant, $thumbnails=''){
        $id = intval($id);
        if($id == 0){
            return false;
        }
        $data = array(
                    self::_name => $name, 
                    self::_url => $url, 
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
    
    public function updateMatch($id, $mid, $fid){
        $id = intval($id);
        $mid = intval($mid);
        $fid = intval($fid);
        if($id > 0 && $mid > 0 && $fid > 0){
            $data = array(
                    self::_item_id => 0, 
                    self::_match_id => $mid, 
                    self::_fixtures_id => $fid,
                );
            return $this->db->update(self::_table, $data, array(self::_id => $id));
        }
    }
    
    
    public function getListByItem($aid, $page=0, $start=0){
        $aid = intval($aid);
        $page = intval($page);
        $start = intval($start);
        if($aid == 0){
            return null;
        }
        $size = 10;
        $limit = ($page*$size) . ', ' . $size;
        $condition = self::_item_id . ' = ' . $aid;
        if($start > 0){
            $condition .= ' and ' . self::_id . ' < ' . $start;
        }
        $order = self::_id . ' desc ';
        $field = self::_id . ', ' . self::_name . ', ' . self::_url . ', ' . self::_thumbnails;
        return $this->db->fetch(self::_table, $condition, $order, $limit, $field);
    }
}
