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
	
	/**
	 * $str 原始字符串
	 * $encoding 原始字符串的编码，默认GBK
	 * $prefix 编码后的前缀，默认"&#"
	 * $postfix 编码后的后缀，默认";"
	 */
	function unicode_encode($str, $encoding = 'GBK', $prefix = '&#', $postfix = ';') {
	    $str = iconv($encoding, 'UCS-2', $str);
	    $arrstr = str_split($str, 2);
	    $unistr = '';
	    for($i = 0, $len = count($arrstr); $i < $len; $i++) {
	        $dec = hexdec(bin2hex($arrstr[$i]));
	        $unistr .= $prefix . $dec . $postfix;
	    } 
	    return $unistr;
	} 
	 
	/**
	 * $str Unicode编码后的字符串
	 * $encoding 原始字符串的编码，默认GBK
	 * $prefix 编码字符串的前缀，默认"&#"
	 * $postfix 编码字符串的后缀，默认";"
	 */
	function unicode_decode($unistr, $encoding = 'GBK', $prefix = '&#', $postfix = ';') {
	    $arruni = explode($prefix, $unistr);
	    $unistr = '';
	    for($i = 1, $len = count($arruni); $i < $len; $i++) {
	    	$arruni[$i] = $arruni[$i].";";//add by cinlan
	        if (strlen($postfix) > 0) {
	            $arruni[$i] = substr($arruni[$i], 0, strlen($arruni[$i]) - strlen($postfix));
	        } 
	        $temp = intval($arruni[$i]);
	        $unistr .= ($temp < 256) ? chr(0) . chr($temp) : chr($temp / 256) . chr($temp % 256);
	    } 
	    return iconv('UCS-2', $encoding, $unistr);
	} 
	
	function sendMail($smtp_host, $smtp_port, $smtp_auth, $username, $password, $charset, $from, $fromname, $to, $subject, $body){
		require_once("PHPMailer_v5.1/class.phpmailer.php");
		try {
			$mail = new PHPMailer(true);   //New instance, with exceptions enabled
			$mail->IsSMTP();                           // tell the class to use SMTP
			$mail->SMTPAuth   = $smtp_auth;            // enable SMTP authentication
//			$mail->SMTPSecure = "ssl";
			$mail->Host       = $smtp_host;            // SMTP server
			$mail->Port       = $smtp_port;            // set the SMTP server port
			$mail->Username   = $username;            // SMTP server username
			$mail->Password   = $password;            // SMTP server password
			$mail->CharSet    = $charset;
			//$mail->IsSendmail();  // tell the class to use Sendmail
			$mail->AddReplyTo($from, $fromname);
			$mail->From       = $from;
			$mail->FromName   = $fromname;
			$mail->AddAddress($to);
			$mail->Subject  = $subject;
			$mail->AltBody    = "text/html"; // optional, comment out and test
			$mail->WordWrap   = 80; // set word wrap
			$mail->MsgHTML($body);
			$mail->IsHTML(true); // send as HTML
			$mail->Send();
			return true;
		} catch (phpmailerException $e) {
			echo $e->errorMessage();
			return false;
		}
	}
	
	function resizeImage($filename,$newwidth,$newheight,$newfilename){
		$src = imagecreatefromjpeg($filename);
		list($width,$height)=getimagesize($filename);
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		imagejpeg($tmp,$newfilename,100);
		imagedestroy($src);
		imagedestroy($tmp);
	}
	
	function sendSms($mobile,$content){
		if($mobile != "" && $content != ""){
			require_once 'lib/nusoap.php';
			$client = new soapclient('http://www.wemediacn.net/webservice/smsservice.asmx?wsdl',true);
			$err = $client->getError();
			if ($err) {
			 echo "<h2>Constructor error</h2><pre>" . $err . "</pre>";
			}
			$client->soap_defencoding = 'utf-8';
			$client->decode_utf8 = false;
			$param = array(
				'mobile' => $mobile,
				'FormatID' => '8',
				'Content' => $content,
				'ScheduleDate' => '2011-01-01',
				'TokenID' => '7100110030570644'
			);
			
			$result = $client->call("SendSMS", array('parameters' => $param), '', '', false, true,'document','encoded');
			//print_r($result);
			if(substr($result['SendSMSResult'],0,2) == "OK")
				return true;
			else
				return false;
		}
	}
	
	/**
	 * 计算折扣
	 * @param $price
	 * @param $total
	 */
	function getZQ($price,$total){
		if($price/$total >= 1){
			echo "无";
		}else{
			echo round($price/$total,2)*10 . "折";
		}
		
		
	}
	
	/**
	 * 获取用户在淘宝中的信用
	 */
	function getTaobaoCredits($nick,$sessionKey){
//		header("Content-type: text/xml; charset=utf-8");
		include DOCUMENT_ROOT."/service/taobao/TopSdk.php";
		//将下载SDK解压后top里的TopClient.php第8行$gatewayUrl的值改为沙箱地址:http://gw.api.tbsandbox.com/router/rest,
		//正式环境时需要将该地址设置为:http://gw.api.taobao.com/router/rest
		//实例化TopClient类
		$c = new TopClient;
		$c->appkey = TAOBAO_APPKEY;
		$c->secretKey = TAOBAO_SECRETKEY;
		//实例化具体API对应的Request类
		$req = new UserGetRequest;
		$req->setFields("buyer_credit,seller_credit");
		$req->setNick($nick);
		
		//执行API请求并打印结果
		$resp = $c->execute($req, $sessionKey);
//		echo "result:";
		//print_r($resp);
//		echo "<br>";
//		echo "nick:".$req->getNick();
//		echo $req->getNick();
		return $resp;
	}

	/**
	 * PHP发送HTTPS请求
	 * 要使用CURL,在PHP.INI中开启
	 * @param $site
	 * @param $url
	 * @param $params
	 */
	function fetch_page($site,$url,$params=false){
	    $ch = curl_init();
	    $cookieFile = $site . '_cookiejar.txt';
	    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
	    curl_setopt($ch, CURLOPT_COOKIEFILE,$cookieFile);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch,   CURLOPT_SSL_VERIFYPEER,   FALSE);
	    curl_setopt($ch, CURLOPT_HTTPGET, true);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 4);
	    if($params)
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3');
	    curl_setopt($ch, CURLOPT_URL,$url);
	
	    $result = curl_exec($ch);
	    //file_put_contents('jobs.html',$result);
	    return $result;
	}
	/*
	 * //博物馆项目取内容前20个字符
	 * @param $str
	 * @return $str(前20个字符)
	 */
function utf8_substr($str,$start=0) {
    if(empty($str)){
        return false;
    }
    if (function_exists('mb_substr')){
        if(func_num_args() >= 3) {
            $end = func_get_arg(2);
            return mb_substr($str,$start,$end,'utf-8');
        }
        else {
            mb_internal_encoding("UTF-8");
            return mb_substr($str,$start);
        }      
 
    }
    else {
        $null = "";
        preg_match_all("/./u", $str, $ar);
        if(func_num_args() >= 3) {
            $end = func_get_arg(2);
            return join($null, array_slice($ar[0],$start,$end));
        }
        else {
            return join($null, array_slice($ar[0],$start));
        }
    }
}
function replaceHtml($document)
{
     $document = trim($document);
     if (strlen($document) <= 0) {
      return $document;
     }
     $search = array ("'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
                   "'<[\/\!]*?[^<>]*?>'si",          // 去掉 HTML 标记
             //   "'([\r\n])[\s]+'",                // 去掉空白字符
             "'&(quot|#34);'i",                // 替换 HTML 实体
          "'&(amp|#38);'i",
          "'&(lt|#60);'i",
          "'&(gt|#62);'i",
          "'&(nbsp|#160);'i"
          );                    // 作为 PHP 代码运行
     $replace = array ("",
           "",
          // "\1",
           "\"",
           "&",
           "<",
           ">",
           " "
          );
     return @preg_replace ($search, $replace, $document);
}
/*
 * 图片裁剪
 */

function getImageName($image,$newwidth,$newheight){
	$temp = explode('.',$image);
	$name = $temp[0].'_'.$newwidth.'x'.$newheight.'.jpg';
	return $name;
}
function cutOutImage($image,$newwidth,$newheight){
	$temp = explode('.',$image);
	$format = $temp[1];
	$newimage = $temp[0].'_'.$newwidth.'x'.$newheight.'.jpg';
	@ob_clean();
	if(function_exists("imagejpeg") && ($format == 'jpg' || $format == 'jpeg')){
		@header('Content-type: image/jpeg');
		@list($width, $height) = getimagesize($image);
		@$thumb = imagecreatetruecolor($newwidth, $newheight);
		@$source = imagecreatefromjpeg($image);
		@imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		@imagejpeg($thumb,$newimage);
		@imagedestroy($thumb);
	}else if(function_exists("imagegif") && $format == 'gif'){
		@header ("Content-type: image/gif");
		@list($width, $height) = getimagesize($image);
		@$thumb = imagecreatetruecolor($newwidth, $newheight);
		@$source = imagecreatefromgif($image);
		@imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		@imagejpeg($thumb,$newimage);
		//@imagegif($thumb,$newimage);
		@imagedestroy($thumb);
	}else if(function_exists("imagepng") && $format == 'png'){
		@header ("Content-type: image/png");
		@list($width, $height) = getimagesize($image);
		@$thumb = imagecreatetruecolor($newwidth, $newheight);
		@$source = imagecreatefrompng($image);
		@imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		@imagejpeg($thumb,$newimage);
		//@imagepng($thumb,$newimage);
		@imagedestroy($thumb);
	}
	/*
	else if(function_exists("imagewbmp") && $format == 'bmp'){
		header ("Content-type: image/vnd.wap.wbmp");
		list($width, $height) = getimagesize($image);
		$thumb = imagecreatetruecolor($newwidth, $newheight);
		$source = imagecreatefromwbmp($image);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		imagewbmp($thumb,$newimage.'.png');
	}
	*/
	if(file_exists(DOCUMENT_ROOT."/".$newimage) ){
		return true;
	}else{
		return false;
	}
}
function outputImage($image,$newwidth,$newheight){
	$name = getImageName($image,$newwidth,$newheight);
	if(file_exists(DOCUMENT_ROOT."/".$name) ){
		return $name;
	}else{//所需图片不存在则裁剪图片
		if(file_exists(DOCUMENT_ROOT."/".$image) ){
			$tmp = cutOutImage($image,$newwidth,$newheight);
			if($tmp){
				return $name;
			}else{//裁剪失败返回原图
				return $image;
			}
		}else{
			return "images/bsgaxasdf_03.jpg";
		}
	}
}


?>