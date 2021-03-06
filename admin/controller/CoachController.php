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
class CoachController extends BaseController{
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
    public function addCoach(){
        //1.接收参数
        $name = @$this->args['name'];
        $remark = @$this->args['remark'];
        
        if($name == '' || $remark == ''){
            return false;
        }
        //3.插入数据
        $coachMode = new CoachModel();
        $result = $coachMode->add($name, $remark);
        if($result == false || $result == null){
            return false;
        }
        return $result;
    }
    
    public function updateCoach(){
        $id = intval($this->args['id']);
        $name = @$this->args['name'];
        $remark = @$this->args['remark'];
        if($id == 0 || $name == '' || $remark == ''){
            return false;
        }
        
        //3.修改数据
        $coachMode = new CoachModel();
        $result = $coachMode->update($id, $name, $remark);
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
