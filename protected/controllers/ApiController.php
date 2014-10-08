<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiController
 * please update Wiki if there were some modified on Api.
 * @author koudejian
 */
class ApiController extends Controller{
    
    /**
     * 验证接口访问合法性
     * @param type $action
     * @return boolean
     */
    public function beforeAction($action) {
	/*
        $uid = @intval($_REQUEST['uid']);
        $token = @$_REQUEST['user_token'];
        $temp = $uid . strtolower('api/' . $this->getAction()->getId());
        if(!CommonUtils::apiVervified($temp, $token)){//renturn false
            JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST);
        }
        //*/
        return true;
    }
    
    //测试环境使用debug＝true
    private $debug = true;
    
    
    //////////////////////////////////采集引导页接口/////////////////////////////////////////
    
    function actionAddAppSite(){
        $id = @$_GET['id'];
        $name = @$_GET['name'];
        $url = @$_GET['url'];
        $array = array('pid' => $id, 'name' => $name);
        if($url != ''){
            $array['url'] = $url;
        }
        $appModel = ForeplayPickAppModel::model()->findByAttributes($array);
        if(!($appModel == false)){
            echo $id . ' is already exsist!';return;
        }
        $appModel = new ForeplayPickAppModel();
        $appModel->initData($id, $name, $url);
        $result = $appModel->save(false);
        if($result === false){
            echo $id . '===' . $name . '===' . $url . ' insert failed!';
        }else{
            echo $result;
        }
        
    }
    function actionGetAppSiteList(){
        $limit = @intval($_GET['limit']);
        
        $appModel = new ForeplayPickAppModel();
        
        $result = $appModel->getList($limit);
        
        if($result == null){
            //JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST); 
            echo json_encode(400);
        }else{
            //JSONHelper::echoJSON(true, $result);
            echo json_encode($result);
        }
    }
    
    function actionSetAppSiteStatu(){
        $id = @intval($_GET['id']);
        if($id > 0){
            $appModel = ForeplayPickAppModel::model()->findByAttributes(array('id' =>  $id));
            if(!($appModel === false)){
                if($appModel->is_picked == '0'){
                    $appModel->is_picked = 1;
                    $result = $appModel->save(false);
                    if(!($result === false)){
                        JSONHelper::echoJSON(true, '1'); 
                    } 
                }else{
                    JSONHelper::echoJSON(true, '2'); 
                }
                
            }
        }
        JSONHelper::echoJSON(false, '0'); 
    }
    
    function actionAddAppInfo(){
        $name = @$_GET['name'];
        $images = @$_GET['images'];
        $id = @intval($_GET['id']); 
        if($name == ''){
           // JSONHelper::echoJSON(false, '1');
            echo 1;exit;
        }
        
        $appModel = ForeplayCaseModel::model()->findByAttributes(array('app_name' =>  $name));
        if($appModel == false){
            $appModel = new ForeplayCaseModel();
            $appModel->app_name = $name;
            $result = $appModel->save(false);
            if(!($result === false)){
                $this->setAppSiteStatus($id);
                $arr = explode(';', $images);
                if(count($arr) > 0){
                    
                    $length = count($arr);
                    for($i = 0; $i < $length; $i++){
                        if($arr[$i] != ''){
                            $caseImageModel = new ForeplayCaseImageModel();
                            $caseImageModel->cid = $appModel->id;
                            $caseImageModel->image_url = $arr[$i];
                            $caseImageModel->save(false);
                        }
                    }
                    //JSONHelper::echoJSON(false, '5');
                    echo 5;  exit;                 
                }
                echo 4;exit;
                //JSONHelper::echoJSON(false, '4');
            }
            //JSONHelper::echoJSON(false, '3');
            echo 3;exit;
        }
        //JSONHelper::echoJSON(false, '2');
        echo 2;exit;
    }
    function setAppSiteStatus($id){
//        echo 12;exit;
        if($id > 0){
            $appModel = ForeplayPickAppModel::model()->findByAttributes(array('id' =>  $id));
            if(!($appModel === false)){
                if($appModel->is_picked == '0'){
                    $appModel->is_picked = 1;
                    $result = $appModel->save(false);
                    if(!($result === false)){
                        return 1;
                    }
                }else{
                    return 2;
                }
            }
            return 3;
        }
        return 0;
    }
    /**
     * 采集苹果app
     * @return type
     */
    function actionAddAppleAppSite(){
        $id = @$_GET['tid'];
        $name = @$_GET['name'];
        $url = @$_GET['url'];
        $array = array('tid' => $id, 'name' => $name);
        if($url != ''){
            $array['url'] = $url;
        }
        $appModel = ForeplayPickAppleAppModel::model()->findByAttributes($array);
        if(!($appModel == false)){
            echo $id . ' is already exsist!';return;
        }
        $appModel = new ForeplayPickAppleAppModel();
        $appModel->initData($id, $name, $url);
        $result = $appModel->save(false);
        if($result === false){
            echo $id . '===' . $name . '===' . $url . ' insert failed!';
        }else{
            echo $result;
        }
        
    }
    function actionGetAppleAppSiteList(){
        $limit = @intval($_GET['limit']);
        
        $appModel = new ForeplayPickAppleAppModel();
        //set first to 2
        $appModels = ForeplayPickAppleAppModel::model()->findByAttributes(array('id' => $appModel->getFirstId()));
        $appModels->is_picked = 2;
        $appModels->save(false);
        //return data
        $result = $appModel->getList($limit);
        
        if($result == null){
            //JSONHelper::echoJSON(false, JSONHelper::ERROR_ILLEGAL_REQUEST); 
            echo json_encode(400);
        }else{
            //JSONHelper::echoJSON(true, $result);
            echo json_encode($result);
        }
    }
    
    function setAppleAppSiteStatus($id){
        if($id > 0){
            $appModel = ForeplayPickAppleAppModel::model()->findByAttributes(array('id' =>  $id));
            if(!($appModel === false)){
                if($appModel->is_picked == '0'){
                    $appModel->is_picked = 1;
                    $result = $appModel->save(false);
                    if(!($result === false)){
                        return 1;
                    }
                }else{
                    return 2;
                }
            }
            return 3;
        }
        return 0;
    }
    
    /**
     * //TODO 
     */
    function actionAddAppleAppInfo(){
        $name = @$_GET['name'];
        $images = @$_GET['images'];
        $logo = @$_GET['logo'];
        $version = @$_GET['version'];
        $date = @$_GET['date'];
        $developer = @$_GET['developer'];
        $descript = @$_GET['descript'];
        $download_ur = @$_GET['download_ur'];
        //type_id
        $tid = @intval($_GET['tid']);
        //site id
        $id = @intval($_GET['id']); 
        if($name == ''){
           // JSONHelper::echoJSON(false, '1');
            echo 1;exit;
        }
        $tag = @$_GET['tag'];
        if($tid == 0){
            $tagModel = new ForeplayCaseTagModel();
            $tid = $tagModel->getId($tag);
        }
        if($tid == 0){
            $tid = 1;
            //echo 6;exit;
        }
        
        $appModel = ForeplayCaseModel::model()->findByAttributes(array('app_name' => $name, 'version_name' => $version  ));
        if($appModel == false){
            $appModel = new ForeplayCaseModel();
            $appModel->app_name = $name;
            $appModel->tag_id = ',1,' . $tid . ',';
            $appModel->version_name = $version;
            $appModel->version_time = $date;
            $appModel->app_log = $logo;
            $appModel->download_url = $download_ur;
            $appModel->download_android = 'http://www.wandoujia.com/search?key=' . $name;
            
            $appModel->developer = $developer;
            $appModel->description = $descript;
            $result = $appModel->save(false);
            if(!($result === false)){
                $this->setAppleAppSiteStatus($id);
                $arr = explode(';', $images);
                if(count($arr) > 0){
                    
                    $length = count($arr);
                    for($i = 0; $i < $length; $i++){
                        if($arr[$i] != ''){
                            $caseImageModel = new ForeplayCaseImageModel();
                            $caseImageModel->cid = $appModel->id;
                            $caseImageModel->image_url = $arr[$i];
                            $caseImageModel->save(false);
                        }
                    }
                    //JSONHelper::echoJSON(false, '5');
                    echo 5;  exit;                 
                }
                echo 4;exit;
                //JSONHelper::echoJSON(false, '4');
            }
            //JSONHelper::echoJSON(false, '3');
            echo 3;exit;
        }
        //JSONHelper::echoJSON(false, '2');
        echo 2;exit;
    }
}
