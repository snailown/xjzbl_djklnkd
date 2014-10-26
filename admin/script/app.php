<?php
include_once 'common.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once DOCUMENT_ROOT . '/model/UserAppModel.php';
include_once DOCUMENT_ROOT . '/model/FixturesModel.php';
include_once DOCUMENT_ROOT . '/model/RaceModel.php';
include_once DOCUMENT_ROOT . '/model/MatchsModel.php';

include_once DOCUMENT_ROOT . '/model/PlayerModel.php';
include_once DOCUMENT_ROOT . '/model/PlayerImageModel.php';
include_once DOCUMENT_ROOT . '/model/TeamImageModel.php';
include_once DOCUMENT_ROOT . '/model/TeamModel.php';
include_once DOCUMENT_ROOT . '/model/TeamImageModel.php';
include_once DOCUMENT_ROOT . '/model/VideoModel.php';
include_once DOCUMENT_ROOT . '/model/ItemModel.php';
include_once DOCUMENT_ROOT . '/model/ItemTimeModel.php';

//json helper
include_once DOCUMENT_ROOT . '/model/JSONHelper.php';

define(API_DEBUG, true);

$action = $_REQUEST['action'];
/**
 * do any thing berfore call api.
 */




//check api.
if($action == 'userLogin'){ //用户登录
    //1.定义参数接收method类型
    $param = API_DEBUG ? $_REQUEST : $_POST;
    //2.接收参数
    $user_device = @$param['device_id'];
    //3.验证参数
    if($user_device == ''){
        JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST);
    }
    //4.查找用户id，不存在则创建新用户返回uid
    $userModel = new UserAppModel();
    $user = $userModel->getByDevice($user_device);
    if($user == null){//add user
        $uid = $userModel->add($user_device, $user_device);
    }else{
        $uid = $user[UserAppModel::_id];
    }
    //5.登录数据返回
    if($uid == 0){
        JSONHelper::echoJSON(false, JSONHelper::USER_LOGIN_FAILED);
    }else{
        JSONHelper::echoJSON(true, array('uid'=>$uid));
    }
}



/**
 * 专辑模块接口
 */
else if($action == 'getAlbumList'){ //获取专辑列表
    //1.定义参数接收method类型
    $param = API_DEBUG ? $_REQUEST : $_GET;
    //2.接收参数
    $start = intval(@$param['start']);
    $page = intval(@$param['page']);
    //3.验证参数
//    if(true){
//        JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST);
//    }
    //4.返回数据
    $itemModel = new ItemModel();
    $items = $itemModel->getPageList('Album', $page, $start);
    
    //5.数据返回
    if($items == null){
        JSONHelper::echoJSON(true, null);
    }else{
        JSONHelper::echoJSON(true, $items);
    }  
}
else if($action == 'getOneAlbumVideoList'){ //获取某专辑的视频列表
    //1.定义参数接收method类型
    $param = API_DEBUG ? $_REQUEST : $_GET;
    //2.接收参数
    $aid = intval(@$param['album_id']);
    $start = intval(@$param['start']);
    $page = intval(@$param['page']);
    //3.验证参数
    if($aid == 0){
        JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST);
    }
    //4.查找数据
    $videoModel = new VideoModel();
    $videos = $videoModel->getListByItem($aid, $page, $start);
    //5.数据返回
    if($videos == null){
        JSONHelper::echoJSON(true, null);
    }else{
        JSONHelper::echoJSON(true, $videos);
    }
}
else if($action == 'getLeagueList'){ //获取联赛列表
    //1.定义参数接收method类型
    $param = API_DEBUG ? $_REQUEST : $_GET;
    //2.接收参数
    $start = intval(@$param['start']);
    $page = intval(@$param['page']);
    //3.验证参数
//    if(true){
//        JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST);
//    }
    //4.返回数据
    $itemModel = new ItemModel();
    $items = $itemModel->getPageList('League', $page, $start);
    
    //5.数据返回
    if($items == null){
        JSONHelper::echoJSON(true, null);
    }else{
        JSONHelper::echoJSON(true, $items);
    }  
}
else if($action == 'getFixturesList'){ //获取联赛赛季列表
    //1.定义参数接收method类型
    $param = API_DEBUG ? $_REQUEST : $_GET;
    //2.接收参数
    $lid = intval(@$param['league_id']);
    $start = intval(@$param['start']);
    $page = intval(@$param['page']);
    //3.验证参数
    if($lid == 0){
        JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST);
    }
    //4.返回数据
    $fixturesModel = new FixturesModel();
    $fixtures = $fixturesModel->getPageList($lid, $page, $start);
    
    //5.数据返回
    if($fixtures == null){
        JSONHelper::echoJSON(true, null);
    }else{
        JSONHelper::echoJSON(true, $fixtures);
    }
}




/**
 * 明星模块接口
 */
else if($action == 'getRaceList'){ //获取
    //1.定义参数接收method类型
    $param = API_DEBUG ? $_REQUEST : $_GET;
    //2.接收参数
    //无参数
    //3.验证参数
    //无校验
    //4.返回数据
    $raceModel = new RaceModel();
    $races = $raceModel->getAllList();
    $counts = count($races);
    $playerModel = new PlayerModel();
    for($i = 0; $i < $counts; $i++){
        $players = null;
        $players = $playerModel->getPageList($races[$i][RaceModel::_id]);
        $races[$i]['players'] = ($players == null) ? null : $players;
    }
    //5.数据返回
    if($races == null){
        JSONHelper::echoJSON(true, null);
    }else{
        JSONHelper::echoJSON(true, $races);
    }
}
else if($action == 'getPlayerListByRace'){ //按种族获取明星列表
    //1.定义参数接收method类型
    $param = API_DEBUG ? $_REQUEST : $_POST;
    //2.接收参数
    $rid = intval(@$param['race_id']);
    $start = intval(@$param['start']);
    $page = intval(@$param['page']);
    //3.验证参数
    if($rid == 0){
        JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST);
    }
    //4.查找数据
    $playerModel = new PlayerModel();
    $players = $playerModel->getPageList($rid, $page, $start);
    //5.数据返回
    if($players == null){
        JSONHelper::echoJSON(true, null);
    }else{
        JSONHelper::echoJSON(true, $players);
    }
}
else if($action == 'getPlayerFixturesList'){ //明星赛程列表
    //1.定义参数接收method类型
    $param = API_DEBUG ? $_REQUEST : $_GET;
    //2.接收参数
    $pid = intval(@$param['player_id']);
    $start = intval(@$param['start']);
    $page = intval(@$param['page']);
    //3.验证参数
    if($pid == 0){
        JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST);
    }
    //4.查找数据
    $matchsModel = new MatchsModel();
    $matchs = $matchsModel->getPlayerPageList($pid, $page, $start);
    //5.数据返回
    if($matchs == null){
        JSONHelper::echoJSON(true, null);
    }else{
        JSONHelper::echoJSON(true, $matchs);
    }
}
else if($action == 'getPlayerMatchsListByFixtures'){ //明星某赛程的比赛列表
    //1.定义参数接收method类型
    $param = API_DEBUG ? $_REQUEST : $_GET;
    //2.接收参数
    $pid = intval(@$param['player_id']);
    $fid = intval(@$param['fixtures_id']);
    //3.验证参数
    if($pid == 0){
        JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST);
    }
    //4.查找数据
    $matchsModel = new MatchsModel();
    $matchs = $matchsModel->getPageList($pid, $fid);
    //5.数据返回
    if($matchs == null){
        JSONHelper::echoJSON(true, null);
    }else{
        JSONHelper::echoJSON(true, $matchs);
    }
}





/**
 * 战队模块接口
 */
else if($action == 'getTeamList'){ //战队列表
    //1.定义参数接收method类型
    $param = API_DEBUG ? $_REQUEST : $_GET;
    //2.接收参数
    $start = intval(@$param['start']);
    $page = intval(@$param['page']);
    //3.验证参数
    //无
    //4.查找数据
    $teamModel = new TeamModel();
    $teams = $teamModel->getPageList($page, $start);
    //5.数据返回
    if($teams == null){
        JSONHelper::echoJSON(true, null);
    }else{
        JSONHelper::echoJSON(true, $teams);
    }
}


/**
 * test 
 */
else if($action == 'test'){ //用户登录
    //1.定义参数接收method类型
    $param = API_DEBUG ? $_REQUEST : $_POST;
    //2.接收参数
    $user_device = @$param['device_id'];
    //3.验证参数
    if($user_device == ''){
        JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST);
    }
    //4.查找数据
    $userModel = new UserAppModel();
    $user = $userModel->getByDevice($user_device);
    if($user == null){//add user
        $uid = $userModel->add($user_device, $user_device);
    }else{
        $uid = $user[UserAppModel::_id];
    }
    //5.数据返回
    if($uid == 0){
        JSONHelper::echoJSON(false, JSONHelper::USER_LOGIN_FAILED);
    }else{
        JSONHelper::echoJSON(true, array('uid'=>$uid));
    }
}
else{//参数非法
    JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST);
}


