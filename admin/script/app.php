<?php
include_once 'common.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once DOCUMENT_ROOT . '/model/PlayerModel.php';
include_once DOCUMENT_ROOT . '/model/PlayerImageModel.php';
include_once DOCUMENT_ROOT . '/model/TeamImageModel.php';
include_once DOCUMENT_ROOT . '/model/TeamModel.php';
include_once DOCUMENT_ROOT . '/model/TeamImageModel.php';
include_once DOCUMENT_ROOT . '/model/VideoModel.php';
include_once DOCUMENT_ROOT . '/model/ItemModel.php';
include_once DOCUMENT_ROOT . '/model/ItemTimeModel.php';

$action = $_REQUEST['action'];
if($action == 'userLogin'){//用户登录
    //1.接收参数
    $user = $_REQUEST['user'];
    
}

