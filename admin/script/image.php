<?php
	@session_start();
	@require_once 'common.php';
	@require_once DOCUMENT_ROOT.'/model/db.class.php';
	@$db = new db();
	$error = "";
	$msg = "";
	$fileElementName = $_REQUEST["filename"];
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
			$msg .= " File Name: " . $_FILES[$fileElementName]['name'] . ", ";
			$msg .= " File Size: " . @filesize($_FILES[$fileElementName]['tmp_name']);
			//*文件路径
			$tmp = explode(".",$_FILES[$fileElementName]["name"]);
			$image_url = "attach/museum/".getDateFormat("YmdHis").getRandomString(6).".".$tmp[count($tmp)-1];
			if(!move_uploaded_file($_FILES[$fileElementName]['tmp_name'],DOCUMENT_ROOT."/".$image_url)){
					//$msg = "[上传图片失败，请检查]";
			}else {
				@unlink($_FILES[$fileElementName]);
			}
			//*/	
	}	
	echo json_encode(array ('error'=>$error,'msg'=>$msg,'path'=>$image_url));
	/*	
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	//echo 				"path: '" . $image_url . "'\n";
	echo "}";
	*/
?>