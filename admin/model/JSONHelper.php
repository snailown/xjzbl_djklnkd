<?php

class JSONHelper {
    /**
     *  retInfo:根据状态json化返回值
     *  @param status 执行的状态
     * 			info 返回的信息
     *  @return json字符串;
     */
    const ERROR = 1;
    const SUCCESS = 0;
    //下面都是错误码
    const TYPE_JSON = 10;
    
    
    const ERROR_ILLEGAL_REQUEST = 400;      //非法请求或者参数不全
    const INTERNAL_ERROR_FAILED = 500;      //服务器内部错误或数据库异常
    const USER_LOGIN_FAILED = 401;          //用户登录失败
    
    static function retInfo($status, $info = null, $type = self::TYPE_JSON) {
        if ($type == self::TYPE_JSON) {
            header('Content-Type: application/json');
        }
        $ret = array();
        if ($status) {
            $ret['status'] = JSONHelper::SUCCESS;
        } else {
            $ret['status'] = JSONHelper::ERROR;
        }
        $ret['data'] = $info;
        return json_encode($ret);
    }
    
    static function echoJSON($status, $info = null, $type = self::TYPE_JSON) {
        echo self::retInfo($status, $info, $type);
        exit();
    }
    static function echoErrorCode($status, $info = null, $type = self::TYPE_JSON) {
        echo self::retInfo($status, self::getErrorStringByCode($info), $type);
        exit();
    }
    static function getErrorStringByCode($errno){
        switch ($errno){
            case 400:
                return "非法请求";
            case 401:
                return "手机号码非法";
            case 402:
                return "手机号码重复";
            case 403:
                return "邮箱非法";
            case 404:
                return "邮箱地址重复";
            case 405:
                return "密码格式错误";
            case 406:
                return "身份证号码不合法";
            case 407:
                return "登录用户名或者密码不正确";
            case 408:
                return "非法请求";
            case 409:
                return "非法请求";
            case 410:
                return "非法请求";
            case 411:
                return "非法请求";
            case 412:
                return "非法请求";
            case 413:
                return "非法请求";
            case 414:
                return "服务异常";
            case 415:
                return "非法请求";
            case 416:
                return "非法请求";
            case 417:
                return "非法请求";
            case 418:
                return "身份证号码重复";
            case 419:
                return "非法请求";
            case 420:
                return "非法请求";
            case 421:
                return "非法请求";
            case 422:
                return "非法请求";
            case 423:
                return "非法请求";
            default :
                return $errno;
        }
    }
}