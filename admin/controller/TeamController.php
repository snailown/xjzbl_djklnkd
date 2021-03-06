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
class TeamController extends BaseController{
    private $file = null;
    public function __construct($arrs, $files){
        parent::__construct($arrs);
        $this->file = $files;
    }
    /**
     * 添加应用
     * @return boolean
     */
    public function addTeam(){
        //1.接收参数
        $name = @$this->args['name'];
        $country = @intval(@$this->args['countrys']);
        $coach = @intval(@$this->args['coach']);
        $leader = @intval(@$this->args['leader']);
        
        $players = $this->args['tags'];

        if($name == '' ){
            return false;
        }
        //2.准备数据
        $uselog = @$this->args['uselog'];
        if($uselog == '1'){
            $logo = $this->getFile();
        }else if($uselog == '2'){
            $logo = @$this->args['logurl'];
        }
        //3.插入数据
        $teamMode = new TeamModel();
        $result = $teamMode->add($name, $logo, $country, $coach, $leader);
        if($result == false || $result == null){
            return false;
        }
        //4.修改选手所在战队
        //*
        if($players != '' && $result > 0){
            $arr = explode(',', $players);
            $count = count($arr);
            if($count > 0){
                $playerModel = new PlayerModel();
                for($i = 0; $i < $count; $i++){
                    $playerModel->editTeam($result, $arr[$i]);
                }
            }
        }
        //*/
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
