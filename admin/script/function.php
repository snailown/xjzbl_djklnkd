<?php
	
	/**
	 * 计算中英文混排字符串的长度，一个中文字符算2字符
	 * strlen()将中文字符算作3个字符，mb_strlen（）将中文字符算作一个字符
	 * @param $str
	 */
	function getStrLen($str){
		return (strlen(trim($str)) + mb_strlen(trim($str),'UTF8')) / 2;
	}
	
	/**
	 * 加密字符串
	 * 当前用md5
	 * @param $str
	 */
	function encodeStr($str){
		return md5($str);
	}
	
	function getRandomString($len) { 
	    $chars = array( 
	        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  
	        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",  
	        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",  
	        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",  
	        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",  
	        "3", "4", "5", "6", "7", "8", "9" 
	    ); 
	    $charsLen = count($chars) - 1; 
	    shuffle($chars);    // 将数组打乱 
	    $output = ""; 
	    for ($i=0; $i<$len; $i++) { 
	        $output .= $chars[mt_rand(0, $charsLen)]; 
	    } 
	    return $output; 
	} 
	
	function getRandomStringOfNum($len) { 
	    $chars = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9"); 
	    $charsLen = count($chars) - 1; 
	    shuffle($chars);    // 将数组打乱 
	    $output = ""; 
	    for ($i=0; $i<$len; $i++) { 
	        $output .= $chars[mt_rand(0, $charsLen)]; 
	    } 
	    return $output; 
	} 
	
	/**
	 * 删除数组中的元素，并更新数组索引
	 * @param $array
	 * @param $index
	 */
	function array_trim ( $array, $index ){
		if(is_array($array)){
			unset ( $array[$index] );
			if(count($array) > 0){
				array_unshift ( $array, array_shift ( $array ) );
			}
			return $array;
		}else{
			return false;
		}
	}
	
	function substr_cut($str_cut,$length = 26){ 
		if (strlen($str_cut) > $length){
			for($i=0; $i < $length; $i++){
				if (ord($str_cut[$i]) > 256){
					$i++;
				}
			}
			$str_cut = substr($str_cut,0,$i);
		}
		return $str_cut."...";
	} 
	
	function getDateTime(){
		date_default_timezone_set('PRC');
		return date("Y-m-d H:i:s");
	}
	
	function getDateFormat($fomat = ""){//Y年m月d日
		date_default_timezone_set('PRC');
		if($fomat){
			return date($fomat);
		}else{
			return date("Y-m-d");
		}
	}
	
	function checkLogin($r){
		if($_SESSION['ID'] == ""){
			header("Location:".WEBSITE_URL."login.php?r=".urlencode($r));
			//@header("Location:login.php?r=".urlencode($r));
		}
	}
	
	function getDateByDays($day,$time = true){//+n || -n
		date_default_timezone_set('PRC');
		$str = date("Y-m-d",strtotime($day." day"));
		$str .= $time ? " 00:00:00" : "";
		return $str;
	}
	
	//处理返回JSON字符串时的引号和回车的问题
	function strReplace($str){
		//$str1 = str_replace("'","\'",$str);
		$str1 = str_replace("\"","\\\"",$str);
		$str2 = str_replace("\r\n","<br />",$str1);
		return $str2;
	}

    function requireLogin(){
        //登录验证
        include_once (DOCUMENT_ROOT . '/model/UserHelper.php');
        if(!UserHelper::isAuth()){
            header('location:' . WEBSITE_URL .'login.php');
        }
    }