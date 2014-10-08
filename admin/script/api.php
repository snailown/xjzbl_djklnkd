<?php
include_once 'common.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once DOCUMENT_ROOT . '/model/PlayerModel.php';
include_once DOCUMENT_ROOT . '/model/PlayerImageModel.php';
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
    
}else if($action == 'handleTop'){
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
}else if($action == 'modifiedPlayer'){
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
}else if($action == 'getImages'){
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
}else if($action == 'delImage'){
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
}else if($action == 'pickAppleApp'){
    $url = $_REQUEST['url'];
//    $url = "https://itunes.apple.com/cn/app/a+tian-xia-di-yi-fang-zhong/id343095636?mt=8";
    if($url != ''){
        $command = 'sh /shell/pick.sh ' . $url;
//        $command = 'sh /shell/test.sh >> /shell/logs';
        $result = shell_exec($command);
//        $result = @system($command);
//        $result = exec($command);echo json_encode($result);exit(0);
//        $result = exec($command);
        echo json_encode(array('result' => $result ));exit(0);
    }else{
        echo json_encode(array('result' => '0'));exit(0);
    }
}

?>
