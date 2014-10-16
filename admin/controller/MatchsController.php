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
class MatchsController extends BaseController{
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
    public function addMatchs(){
        
        //1.接收参数
        $name = @$this->args['name'];
        $group = @$this->args['group'];
        $orders = @$this->args['orders'];
        $palyer1 = @intval(@$this->args['player1']);
        $palyer2 = @intval(@$this->args['player2']);
        $team1 = @intval(@$this->args['team1']);
        $team2 = @intval(@$this->args['team2']);
        $video = @intval(@$this->args['video']);
        $groupModel = new GroupModel();
        $fixtures = $groupModel->getFixturesId($group);
        if($name == '' || $group == '' || $fixtures == '' || $orders == '' || $palyer1 == '' || $palyer2 == '' || $team1 == '' || $team2 == ''){
            return false;
        }
        //3.插入数据
        $matchsMode = new MatchsModel();
        $result = $matchsMode->add($name, $group, $fixtures, $orders, $palyer1, $palyer2, $team1, $team2, $video);
        
        if($result == false || $result == null){
            return false;
        }
        $videoModel = new VideoModel();
        $videoModel->updateMatch($video, $result, $fixtures);
        return $result;
    }
    
    public function updateMatchs(){
        $id = intval($this->args['id']);
        $name = @$this->args['name'];
        $group = @$this->args['group'];
        $orders = @$this->args['orders'];
        $palyer1 = @intval(@$this->args['player1']);
        $palyer2 = @intval(@$this->args['player2']);
        $team1 = @intval(@$this->args['team1']);
        $team2 = @intval(@$this->args['team2']);
        $video = @intval(@$this->args['video']);
        $groupModel = new GroupModel();
        $fixtures = $groupModel->getFixturesId($group);
        if($name == '' || $group == '' || $fixtures == '' || $orders == '' || $palyer1 == '' || $palyer2 == '' || $team1 == '' || $team2 == ''){
            return false;
        }
        //3.修改数据
        $matchsMode = new MatchsModel();
        $result = $matchsMode->update($id, $name, $group, $fixtures, $orders, $palyer1, $palyer2, $team1, $team2, $video);
        if($result == false || $result == null){
            return false;
        }
        $videoModel = new VideoModel();
        $videoModel->updateMatch($video, $id, $fixtures);
        return $result;
    }

}
