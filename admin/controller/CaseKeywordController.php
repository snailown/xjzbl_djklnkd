<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'BaseController.php';

/**
 * Description of CaseController
 *
 * @author koudejian
 */
class CaseKeywordController extends BaseController{
    private $file = null;
    public function __construct($arrs, $files){
        parent::__construct($arrs);
        $this->file = $files;
//        print_r($files);
//        exit;
    }
    /**
     * 添加关键词
     * @return boolean
     */
    public function add(){
        //1.接收参数
        $name = @$this->args['name'];
        $color = @$this->args['color'];
        $types = @intval($this->args['types']);
        if($name == '' || $color == ''){
            return false;
        }
        //3.插入数据
        $keywordMode = new CaseKeywordModel();
        $result = $keywordMode->add($name, $color, $types);
        if($result == false || $result == null){
            return false;
        }
        return $result;
    }
    /**
	 *更新关键词
	 *
	 */
    public function update(){
        $id = intval($this->args['id']);
        $name = @$this->args['name'];
        $color = @$this->args['color'];
        $types = @intval($this->args['types']);
        if($id == 0 || $name == '' || $color == ''){
            return false;
        }
        
        //3.修改数据
        $keywordMode = new CaseKeywordModel();
        $result = $keywordMode->update($id, $name, $color, $types);
        if($result == false || $result == null){
            return false;
        }
        return $result;
    }
    
}
