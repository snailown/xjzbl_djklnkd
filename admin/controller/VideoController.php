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
class VideoController extends BaseController{
    private $file = null;
    public function __construct($arrs, $files){
        parent::__construct($arrs);
        $this->file = $files;
    }
    /**
     * 添加应用
     * @return boolean
     */
    public function addVideo(){
        //1.接收参数
        $name = @$this->args['title'];
        $url = @$this->args['url'];
        $palyer1 = @intval(@$this->args['player1']);
        $palyer2 = @intval(@$this->args['player2']);
        $team1 = @intval(@$this->args['team1']);
        $team2 = @intval(@$this->args['team2']);
        $map = @intval(@$this->args['map']);
        $descant = @intval(@$this->args['descant']);
        
        if($name == '' || $url == '' || $palyer1 == '' || $palyer2 == '' || $team1 == '' || $team2 == '' || $map == '' || $descant == '' ){
            return false;
        }
        //2.准备数据
        $thumbnails = @$this->args['uselog'];
        if($thumbnails == '1'){
            $logo = $this->getFile();
        }else if($thumbnails == '2'){
            $logo = @$this->args['logurl'];
        }
        //3.插入数据
        $videoMode = new VideoModel();
        $result = $videoMode->add($name, $url, $palyer1, $palyer2, $team1, $team2, $map, $descant, $logo);
        if($result == false || $result == null){
            return false;
        }
        return $result;
    }
    
    /**
     * 上传文件
     * @return string
     */
    function getFile(){
        $tempFile = $this->file['logfile']['tmp_name'];
        $targetFolder = DOCUMENT_ROOT . '/logo/';
        $fileParts = pathinfo($this->file['logfile']['name']);
        $filename = getDateFormat('YmdHis_') . getRandomStringOfNum(8) . '.' . $fileParts['extension'];
        $targetFile = $targetFolder . $filename;
        if(move_uploaded_file($tempFile, $targetFile)){
            return WEBSITE_URL . 'logo/' . $filename;
        }else{
            return '';
        }
    }
}
