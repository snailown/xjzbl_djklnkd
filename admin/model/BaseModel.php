<?php
//echo 'baseModel';exit;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'db.class.php';
/**
 * Description of BaseModel
 *
 * @author koudejian
 */
class BaseModel {
    //put your code here
    public $db = null;
    
    public $counts = 0;
    
    private $table = '';

    public $page = null;
    
    public function __construct($tablename){
        $this->table = $tablename;
        $this->db = db::getInstance();
    }
    
    /**
     * 获取行数
     * @return counts
     */
    public function getCount(){
        if($this->counts == 0){
            $result = $this->db->doSql('select count(id) as num from ' . $this->table);
            foreach($result as $temp);
            $this->counts = @intval($temp['num']);
        }
        return $this->counts;
    }
    /**
     * 设置分页参数
     * @param type $page
     */
    public function setPage($page){
        $this->page = $page;
    }
}
