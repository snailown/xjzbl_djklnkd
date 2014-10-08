<?php
include_once 'common.php';

include_once DOCUMENT_ROOT . '/model/PlayerImageModel.php';
include_once DOCUMENT_ROOT . '/model/TeamImageModel.php';

/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
$playerImageModel = new PlayerImageModel();
$teamImageModel = new TeamImageModel();
// Define a destination
$targetFolder = DOCUMENT_ROOT . '/img/'; // Relative to the root
$id = intval($_POST['id']);
$type = $_POST['type'];

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	// Validate the file type
	$fileTypes = array('jpg', 'JPG','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
        
        $filename = getDateFormat('YmdHis_') . getRandomStringOfNum(8) . '.' . $fileParts['extension'];
        $targetFile = $targetFolder . $filename;
        if(move_uploaded_file($tempFile,$targetFile)){
            if($type == 'team'){
                $result = $teamImageModel->addTeamImage($id, WEBSITE_URL . 'img/' . $filename);
            }else{
                $result = $playerImageModel->addPlayerImage($id, WEBSITE_URL . 'img/' . $filename);
            }
            
            if($result > 0){
                echo '0';
            }else{
                echo '2';
            }
        }else{
            echo '3';
        }
	} else {
		echo '4';
	}
}else{
    echo '5';
}
?>