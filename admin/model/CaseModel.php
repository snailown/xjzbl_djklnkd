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
class CaseModel extends BaseModel{
    const _table = 'foreplay_case';
    
    const _id = 'id';
    const _name = 'app_name';
    const _logo = 'app_log';
    const _time = 'version_time';
    const _no = 'version_no';
    const _vname = 'version_name';
    const _tag_id = 'tag_id';
    const _parent = 'parent_id';
    const _top = 'is_top';
    const _url = 'download_url';
    const _url_android = 'download_android';
    const _top_time = 'top_times';
    
    private $key = '';
    
    public function __construct(){
        parent::__construct(self::_table);
    }
    
    /**
     * 获取条数
     * @param type $key
     * @return int $count
     */
    public function getCounts($key, $tag_id = 0){
        $tag_id = intval($tag_id);
        if($key != ''){
            $this->key = $key;
            if($tag_id > 0){
                $count_sql = 'select count(id) as num from ' . self::_table . ' where ' . self::_name . ' like \'' . '%' . $this->key . '%\'' . ' and ' . self::_tag_id . ' like \'%,' . $tag_id . ',%\''  ;
            }else{
                $count_sql = 'select count(id) as num from ' . self::_table . ' where ' . self::_name . ' like \'' . '%' . $this->key . '%\'' ;
            }
            $result = $this->db->doSql($count_sql);
            foreach($result as $temp);
            $this->counts = @intval($temp['num']);     
        }else{
            $this->key = '';
            return $this->getCount($tag_id);
        }
    }
    /**
     * 获取行数
     * @return counts
     */
    public function getCount($tag_id){
        $tag_id = intval($tag_id);
        if($tag_id > 0){
            if($this->counts == 0){
                $sql = 'select count(id) as num from ' . self::_table . ' where ' . self::_tag_id . ' like \'%,' . $tag_id . ',%\'';
                
                $result = $this->db->doSql($sql);
                foreach($result as $temp);
                $this->counts = @intval($temp['num']);
            }
            return $this->counts;
        }else{
            return $this->getCount();
        }
        
    }
    /**
     * 应用列表
     * @return type
     */
    public function getList($tag_id = 0){
        $tag_id = intval($tag_id);
        $limit = ' limit '. $this->page->getStart() . ',' . $this->page->getShowrows();
        if($this->key != ''){
            if($tag_id > 0){
                $sql = 'select * from ' . self::_table . ' where ' . self::_name . ' like \'' . '%' . $this->key . '%\'' . ' and ' . self::_tag_id . ' like \'%,' . $tag_id . ',%\'' . $limit;
            }else{
                $sql = 'select * from ' . self::_table . ' where ' . self::_name . ' like \'' . '%' . $this->key . '%\'' . $limit;
            }
        }else{
            if($tag_id > 0){
                $sql = 'select * from ' . self::_table . ' where ' . self::_tag_id . ' like \'%,' . $tag_id . ',%\'' . ' order by id desc ' . $limit;
            }else{
                $sql = 'select * from ' . self::_table . ' order by id desc ' . $limit;
            }
        }
        return $this->db->doSql($sql);
    }
    
    /**
     * 添加应用
     * @param type $name
     * @param type $vno
     * @param type $vname
     * @param type $time
     * @param type $tags
     * @param type $pid
     * @param type $top
     * @param type $url
     * @param type $logo
     * @return type
     */
    public function add($name, $vno, $vname, $time, $tags, $pid = 0, $top = 0, $url = '', $download_android='', $logo = ''){
        $data = array(
            self::_name => $name,
            self::_no => $vno,
            self::_vname => $vname,
            self::_time => $time,
            self::_tag_id => $tags,
            self::_parent => $pid,
            self::_top => $top,
            self::_url => $url,
            self::_url_android => $download_android,
            self::_logo => $logo      
        );
        
        $verified = $this->db->fetchOne(self::_table, $data, self::_id);
        if( $verified == null){
            return $this->db->insert(self::_table, $data );
        }else{
            return $verified[self::_id];
        }
    }
    
    /**
     * 搜索根应用
     * @param type $key
     * @return type
     */
    public function search($key = ''){
        if($key == ''){
            return $this->db->fetch(self::_table, array(self::_parent => '0'),  self::_id . ' desc', '', self::_id . ',' . self::_name );
        }else{
            return $this->db->fetch(self::_table, self::_parent . '=0 and ' . self::_name . ' like \'%' . $key . '%\'', self::_id . ' desc', '', self::_id . ',' . self::_name);
        }
    }
    
    public function setTop($id, $top){
        $top = intval($top);
        $id = intval($id);
        if($top > 1 || $id == 0){
            return false;
        }
//        echo json_encode('update ' . self::_table . ' set ' . self::_top . '=' . $top . ' where ' . self::_id . '=' . $id);exit;
//        return $this->db->doSql('update ' . self::_table . ' set ' . self::_top . '=' . $top . ' where ' . self::_id . '=' . $id);
        return $this->db->update(self::_table, array(self::_top => $top, self::_top_time => strtotime(date("Y-m-d H:i:s"))), array(self::_id => $id));
    }
    
    public function get($id){
        $id = intval($id);
        if($id > 0){
            return $this->db->fetchOne(self::_table, array(self::_id => $id));
        }
    }
    public function isUsedParent($pid){
        $pid = intval($pid);
        $arr = $this->db->fetch(self::_table, array(self::_parent => $pid));
        if(count($arr) > 0){
            return false;
        }else{
            return true;
        }
    }
    public function update($id, $name, $vname, $vno, $time, $download, $download_android, $parent, $istop, $tags, $logo){
        $data = array(
            self::_name => $name,
            self::_vname => $vname,
            self::_time => $time,
            self::_url => $download,
            self::_url_android => $download_android,
            self::_top => $istop,
            self::_tag_id => $tags,
            self::_parent => $parent,
            self::_logo => $logo,
            self::_no => $vno
        );
        return $this->db->update(self::_table, $data, array(self::_id => $id));
    }
    /**
     * update logo
     * @param type $id
     * @param type $url
     * @return int
     */
    public function updateLogo($id, $url){
        $id = intval($id);
        if($id > 0 && $url != ''){
            if($this->db->update(self::_table, array(self::_logo => $url), array(self::_id => $id)) > 0){
                return 0;
            }else{
                return -1;
            }
        }
    }
}
