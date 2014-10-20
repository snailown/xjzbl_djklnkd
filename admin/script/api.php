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

include_once DOCUMENT_ROOT . '/model/VideoModel.php';
include_once DOCUMENT_ROOT . '/model/ItemModel.php';
include_once DOCUMENT_ROOT . '/model/ItemTimeModel.php';

$action = $_REQUEST['action'];
if($action == 'userLogin'){//用户登录
    //1.接收参数
    $user = $_REQUEST['user'];
    $pass = md5($_REQUEST['pass']);
    if($user != '' && $pass != ''){
        require_once (DOCUMENT_ROOT . '/model/UserHelper.php');
        if(UserHelper::login($user, $pass)){
            echo json_encode(array('result'=>'0'));exit(0);
        }
    }
    echo json_encode(array('result'=>'1'));exit(0);
    
}
/*
else if($action == 'handleTop'){
    $id = intval($_REQUEST['id']);
    $actions = $_REQUEST['flag'];
    if($id > 0 && ($actions == 'cancel' || $actions == 'set')){
        $caseModel = new CaseModel();
        $value = ($actions == 'cancel') ? '0' : '1';
        $result = $caseModel->setTop($id, $value);
        if($result == false){
            echo json_encode(array('result'=>'1'));exit(0);
        }else{
            echo json_encode(array('result'=>'0'));exit(0);
        }
    }
    echo json_encode(array('result'=>'2'));exit(0);
}
//*/
else if($action == 'modifiedPlayer'){
    //'action=modifiedPlayer&id=' + $('#cid').val() + '&name=' + $('#name').val() + '&gameid=' + $('#gameid').val() 
    //      + '&nickname=' + $('#nickname').val() + '&race=' + $('#race').val() + '&team=' + $('#team').val()
    //      + '&tags=' + $('#tags').val() + '&logourl=' + $('#logourl').val()
    $id = intval($_REQUEST['id']);
    if($id == 0){
        echo json_encode(array('result'=>'1'));exit(0);
    }
    $name = $_REQUEST['name'];
    $gameid = $_REQUEST['gameid'];
    $nick = $_REQUEST['nickname'];
    $raceid = $_REQUEST['race'];
    $teamid = $_REQUEST['team'];
    $preteamid = $_REQUEST['tags'];
    $avatar = $_REQUEST['logourl'];

    $playerModel = new PlayerModel();
    $player = $playerModel->get($id);
    if($player == null){
        echo json_encode(array('result'=>'2'));exit(0);
    }
    $result = $playerModel->update($id, $name, $avatar, $gameid, $nick, $raceid, $teamid, $preteamid);
    if($result){
        echo json_encode(array('result'=>'0'));exit(0);
    }
    echo json_encode(array('result'=>'4'));exit(0);
}
else if($action == 'modifiedTeam'){
    //action=modifiedTeam&id=' + $('#cid').val() + '&name=' + $('#name').val() + '&country=' + $('#country').val() 
    //+ '&coach=' + $('#coach').val() + '&tags=' + $('#tags').val() + '&logourl=' + $('#logourl').val()
    $id = intval($_REQUEST['id']);
    if($id == 0){
        echo json_encode(array('result'=>'1'));exit(0);
    }
    $name = $_REQUEST['name'];
    $country = $_REQUEST['country'];
    $coach = $_REQUEST['coach'];
    $leader = $_REQUEST['leader'];
    $players = $_REQUEST['tags'];
    $logo = $_REQUEST['logourl'];

    $teamModel = new TeamModel();
    $team = $teamModel->get($id);
    if($team == null){
        echo json_encode(array('result'=>'2'));exit(0);
    }
    $result = $teamModel->update($id, $name, $logo, $country, $coach, $leader);
    $playerModel = new PlayerModel();
    $playerModel->editTeams($id, $players);
    if($result){
        echo json_encode(array('result'=>'0'));exit(0);
    }
    echo json_encode(array('result'=>'4'));exit(0);
}
else if($action == 'getImages'){
    $id = intval($_REQUEST['id']);
    if($id == 0){
        echo json_encode(array('result'=>'1'));
        exit(0);
    }
    $playerImageModel = new PlayerImageModel();
    $result = $playerImageModel->getPlayerImage($id);
    if($result == null){
        echo json_encode(array('result'=>'2'));
        exit(0);
    }else{
        echo json_encode($result);
    }
}
else if($action == 'delImage'){
    $id = intval($_REQUEST['id']);
    if($id == 0){
//        echo json_encode(array('result'=>'1'));
        exit(0);
    }
    $url = $_REQUEST['name'];
    $playerImageModel = new PlayerImageModel();
    $result = $playerImageModel->delPlayerImage($id, $url);
    if($result == null){
//        echo json_encode(array('result'=>'1'));
        exit(0);
    }else{
        echo json_encode($result);
    }
}
else if($action == 'getTeamImages'){
    $id = intval($_REQUEST['id']);
    if($id == 0){
        echo json_encode(array('result'=>'1'));
        exit(0);
    }
    $teamImageModel = new TeamImageModel();
    $result = $teamImageModel->addTeamImage($id);
    if($result == null){
        echo json_encode(array('result'=>'2'));
        exit(0);
    }else{
        echo json_encode($result);
    }
}
else if($action == 'delTeamImage'){
    $id = intval($_REQUEST['id']);
    if($id == 0){
//        echo json_encode(array('result'=>'1'));
        exit(0);
    }
    $url = $_REQUEST['name'];
    $teamImageModel = new TeamImageModel();
    $result = $teamImageModel->delTeamImage($id, $url);
    if($result == null){
//        echo json_encode(array('result'=>'1'));
        exit(0);
    }else{
        echo json_encode($result);
    }
}
else if($action == 'modifiedVideo'){
    $id = @intval(@$_REQUEST['id']);
    $name = @$_REQUEST['title'];
    $url = @$_REQUEST['url'];

    $map = @intval(@$_REQUEST['map']);
    $descant = @intval(@$_REQUEST['descant']);
    $logo = @$_REQUEST['logourl'];
//    echo json_encode(array('result'=>$_REQUEST));exit(0);
    if($name == '' || $url == '' || $map == '' || $descant == '' ){
        echo json_encode(array('result'=>'2'));
        exit(0);
    }
    $videoMode = new VideoModel();
    $result = $videoMode->update($id, $name, $url, $map, $descant, $logo);
    if($result){
        echo json_encode(array('result'=>'0'));exit(0);
    }
    echo json_encode(array('result'=>'4'));exit(0);
}
else if($action == 'pickVideo'){
    $url = $_REQUEST['url'];
    if($url != ''){
        $command = 'sh /shell/pickVideo.sh ' . $url;
        $result = shell_exec($command);
        echo json_encode(array('result' => $result ));exit(0);
    }else{
        echo json_encode(array('result' => '0'));exit(0);
    }
}else if($action == 'uploadVideoInfo'){
    $title = $_REQUEST['title'];
    $data = $_REQUEST['data'];
    $have_time = $_REQUEST['havetime'];
    $times = $_REQUEST['time'];
    $count = 0;
    if($title == '' || $data == null){
        echo '1';exit;
    }
    $itemModel = new ItemModel();
    $item = $itemModel->getPickId($title, $have_time);
    $time = 0;
    if($times == ''){//专辑
        $itemTimeModel = new ItemTimeModel();
        $time = $itemTimeModel->getPickId($times);
    }
    $arr = explode('#item#', $data);
    $videoModel = new VideoModel();
    foreach($arr as $line){
        //rCraft2 ArtworkTrailer#slip#
        //http%3A%2F%2Fv.youku.com%2Fv_show%2Fid_XMjcwNjI1MzA0.html%3Ff%3D5654073#slip#
        //02:14#slip#
        //http%3A%2F%2Fg2.ykimg.com%2F0100641F464B404375D617009F571292BA61DB-A52C-EBDF-3A1B-E9BD7F86A5DD
        if($line == ''){
            continue;
        }
        $arrs = explode('#slip#', $line);
        if(count($arrs) == 4 ){
            $id = $videoModel->addPick($arrs[0], $arrs[1], $arrs[2], $arrs[3], $item, $time);
            if($id > 0){
                $count++;
            }
        }
    }
    if($count > 0){
        echo '0';exit;
    }else{
        echo '2';exit;
    }
    
}

?>
