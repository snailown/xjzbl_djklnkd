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
class ItemController extends BaseController{
    private $file = null;
    public function __construct($arrs, $files){
        parent::__construct($arrs);
        $this->file = $files;
//        print_r($files);
//        exit;
    }
    /**
     * 添加应用分类
     * @return boolean
     */
    public function addItem(){
        //1.接收参数
        $name = @$this->args['name'];
        $parent = @intval($this->args['name1']);
        
        if($name == '' || $parent == ''){
            return false;
        }
        //3.插入数据
        $itemMode = new ItemModel();
        $item = $itemMode->getItem($parent);
        $have_time = @$item[ItemModel::_have_time];
//        print_r($item);exit;
        $result = $itemMode->add($name, $parent, $have_time);
        if($result == false || $result == null){
            return false;
        }
        return $result;
    }
    
    public function updateItem(){
        $id = intval($this->args['id']);
        $name = @$this->args['name'];
        $parent = @intval($this->args['name1']);
        if($id == 0 || $name == '' || $parent == ''){
            return false;
        }
        
        //3.修改数据
        $itemMode = new ItemModel();
        $item = $itemMode->getItem($parent);
        $have_time = @$item[ItemModel::_have_time];
        $result = $itemMode->update($id, $name, $parent, $have_time);
        if($result == false || $result == null){
            return false;
        }
        return $result;
    }
    /**
     * 上传文件
     * @return string
     */
//    private function getFile(){
//        if($this->file == null){
//            return '';
//        }
//        $tempFile = $this->file['logos']['tmp_name'];
////        print_r($this->file);exit;
//        $targetFolder = DOCUMENT_ROOT . '/logo/';
//        $fileParts = pathinfo($this->file['logos']['name']);
//        $filename = getDateFormat('YmdHis_') . getRandomStringOfNum(8) . '.' . $fileParts['extension'];
//        $targetFile = $targetFolder . $filename;
//        if(move_uploaded_file($tempFile, $targetFile)){
//            return WEBSITE_URL . 'logo/' . $filename;
//        }else{
//            return '';
//        }
//    }
}
