<?php
include_once 'script/common.php';
requireLogin();
$title = '选手详情';

include_once 'model/PlayerModel.php';
include_once 'model/TeamModel.php';
include_once 'model/DescantModel.php';
include_once 'model/MapModel.php';

include_once 'model/VideoModel.php';
include_once 'controller/VideoController.php';

$mapModel = new MapModel();
$maps = $mapModel->getAllList();

$descantModel = new DescantModel();
$descants = $descantModel->getAllList();

$playerModel = new PlayerModel();
$players = $playerModel->getAllList();

$teamModel = new TeamModel();
$teams = $teamModel->getAllList();

$id = intval($_REQUEST['id']);

if(@$_REQUEST['action'] == 'addVideo'){//add video
//    print_r($_REQUEST);
    $videoController = new VideoController($_REQUEST, $_FILES);
    $id = $videoController->addVideo();
}
if($id == 0){
    header('Location:err_404.html');
}

$videoModel = new VideoModel();
$video = $videoModel->get($id);

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo TITLE?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport' />
    
    <!--[if lt IE 9]>
    <script src='assets/javascripts/html5shiv.js' type='text/javascript'></script>
    <![endif]-->
    <link href='assets/stylesheets/bootstrap/bootstrap.css' media='all' rel='stylesheet' type='text/css' />
    <link href='assets/stylesheets/bootstrap/bootstrap-responsive.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / jquery ui -->
    <link href='assets/stylesheets/jquery_ui/jquery-ui-1.10.0.custom.css' media='all' rel='stylesheet' type='text/css' />
    <link href='assets/stylesheets/jquery_ui/jquery.ui.1.10.0.ie.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / switch buttons -->
    <link href='assets/stylesheets/plugins/bootstrap_switch/bootstrap-switch.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / xeditable -->
    <link href='assets/stylesheets/plugins/xeditable/bootstrap-editable.css' media='all' rel='stylesheet' type='text/css' />
    <link href='assets/stylesheets/plugins/common/bootstrap-wysihtml5.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / wysihtml5 (wysywig) -->
    <link href='assets/stylesheets/plugins/common/bootstrap-wysihtml5.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / jquery file upload -->
    <link href='assets/stylesheets/plugins/jquery_fileupload/jquery.fileupload-ui.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / full calendar -->
    <link href='assets/stylesheets/plugins/fullcalendar/fullcalendar.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / select2 -->
    <link href='assets/stylesheets/plugins/select2/select2.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / mention -->
    <link href='assets/stylesheets/plugins/mention/mention.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / tabdrop (responsive tabs) -->
    <link href='assets/stylesheets/plugins/tabdrop/tabdrop.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / jgrowl notifications -->
    <link href='assets/stylesheets/plugins/jgrowl/jquery.jgrowl.min.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / datatables -->
    <link href='assets/stylesheets/plugins/datatables/bootstrap-datatable.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / dynatrees (file trees) -->
    <link href='assets/stylesheets/plugins/dynatree/ui.dynatree.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / color picker -->
    <link href='assets/stylesheets/plugins/bootstrap_colorpicker/bootstrap-colorpicker.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / datetime picker -->
    <link href='assets/stylesheets/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.min.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / daterange picker) -->
    <link href='assets/stylesheets/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / flags (country flags) -->
    <link href='assets/stylesheets/plugins/flags/flags.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / slider nav (address book) -->
    <link href='assets/stylesheets/plugins/slider_nav/slidernav.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / fuelux (wizard) -->
    <link href='assets/stylesheets/plugins/fuelux/wizard.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / flatty theme -->
    <link href='assets/stylesheets/light-theme.css' id='color-settings-body-color' media='all' rel='stylesheet' type='text/css' />
    <!-- / demo -->
    <link href='assets/stylesheets/demo.css' media='all' rel='stylesheet' type='text/css' />
    
    
    <!-- / jquery -->
    <script src='assets/javascripts/jquery/jquery.min.js' type='text/javascript'></script>
    <!-- / jquery mobile events (for touch and slide) -->
    <script src='assets/javascripts/plugins/mobile_events/jquery.mobile-events.min.js' type='text/javascript'></script>
    <!-- / jquery migrate (for compatibility with new jquery) -->
    <script src='assets/javascripts/jquery/jquery-migrate.min.js' type='text/javascript'></script>
    <!-- / jquery ui -->
    <script src='assets/javascripts/jquery_ui/jquery-ui.min.js' type='text/javascript'></script>
    <!-- / bootstrap -->
    <script src='assets/javascripts/bootstrap/bootstrap.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/flot/excanvas.js' type='text/javascript'></script>
    <!-- / sparklines -->
    <script src='assets/javascripts/plugins/sparklines/jquery.sparkline.min.js' type='text/javascript'></script>
    <!-- / flot charts -->
    <script src='assets/javascripts/plugins/flot/flot.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/flot/flot.resize.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/flot/flot.pie.js' type='text/javascript'></script>
    <!-- / bootstrap switch -->
    <script src='assets/javascripts/plugins/bootstrap_switch/bootstrapSwitch.min.js' type='text/javascript'></script>
    <!-- / fullcalendar -->
    <script src='assets/javascripts/plugins/fullcalendar/fullcalendar.min.js' type='text/javascript'></script>
    <!-- / datatables -->
    <script src='assets/javascripts/plugins/datatables/jquery.dataTables.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js' type='text/javascript'></script>
    <!-- / wysihtml5 -->
    <script src='assets/javascripts/plugins/common/wysihtml5.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/common/bootstrap-wysihtml5.js' type='text/javascript'></script>
    <!-- / select2 -->
    <script src='assets/javascripts/plugins/select2/select2.js' type='text/javascript'></script>
    <!-- / color picker -->
    <script src='assets/javascripts/plugins/bootstrap_colorpicker/bootstrap-colorpicker.min.js' type='text/javascript'></script>
    <!-- / mention -->
    <script src='assets/javascripts/plugins/mention/mention.min.js' type='text/javascript'></script>
    <!-- / input mask -->
    <script src='assets/javascripts/plugins/input_mask/bootstrap-inputmask.min.js' type='text/javascript'></script>
    <!-- / fileinput -->
    <script src='assets/javascripts/plugins/fileinput/bootstrap-fileinput.js' type='text/javascript'></script>
    <!-- / modernizr -->
    <script src='assets/javascripts/plugins/modernizr/modernizr.min.js' type='text/javascript'></script>
    <!-- / retina -->
    <script src='assets/javascripts/plugins/retina/retina.js' type='text/javascript'></script>
    <!-- / fileupload -->
    <script src='assets/javascripts/plugins/fileupload/tmpl.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/fileupload/load-image.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/fileupload/canvas-to-blob.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/fileupload/jquery.iframe-transport.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/fileupload/jquery.fileupload.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/fileupload/jquery.fileupload-fp.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/fileupload/jquery.fileupload-ui.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/fileupload/jquery.fileupload-init.js' type='text/javascript'></script>
    <!-- / timeago -->
    <script src='assets/javascripts/plugins/timeago/jquery.timeago.js' type='text/javascript'></script>
    <!-- / slimscroll -->
    <script src='assets/javascripts/plugins/slimscroll/jquery.slimscroll.min.js' type='text/javascript'></script>
    <!-- / autosize (for textareas) -->
    <script src='assets/javascripts/plugins/autosize/jquery.autosize-min.js' type='text/javascript'></script>
    <!-- / charCount -->
    <script src='assets/javascripts/plugins/charCount/charCount.js' type='text/javascript'></script>
    <!-- / validate -->
    <script src='assets/javascripts/plugins/validate/jquery.validate.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/validate/additional-methods.js' type='text/javascript'></script>
    <!-- / naked password -->
    <script src='assets/javascripts/plugins/naked_password/naked_password-0.2.4.min.js' type='text/javascript'></script>
    <!-- / nestable -->
    <script src='assets/javascripts/plugins/nestable/jquery.nestable.js' type='text/javascript'></script>
    <!-- / tabdrop -->
    <script src='assets/javascripts/plugins/tabdrop/bootstrap-tabdrop.js' type='text/javascript'></script>
    <!-- / jgrowl -->
    <script src='assets/javascripts/plugins/jgrowl/jquery.jgrowl.min.js' type='text/javascript'></script>
    <!-- / bootbox -->
    <script src='assets/javascripts/plugins/bootbox/bootbox.min.js' type='text/javascript'></script>
    <!-- / inplace editing -->
    <script src='assets/javascripts/plugins/xeditable/bootstrap-editable.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/xeditable/wysihtml5.js' type='text/javascript'></script>
    <!-- / ckeditor -->
    <script src='assets/javascripts/plugins/ckeditor/ckeditor.js' type='text/javascript'></script>
    <!-- / filetrees -->
    <script src='assets/javascripts/plugins/dynatree/jquery.dynatree.min.js' type='text/javascript'></script>
    <!-- / datetime picker -->
    <script src='assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js' type='text/javascript'></script>
    <!-- / daterange picker -->
    <script src='assets/javascripts/plugins/bootstrap_daterangepicker/moment.min.js' type='text/javascript'></script>
    <script src='assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js' type='text/javascript'></script>
    <!-- / max length -->
    <script src='assets/javascripts/plugins/bootstrap_maxlength/bootstrap-maxlength.min.js' type='text/javascript'></script>
    <!-- / dropdown hover -->
    <script src='assets/javascripts/plugins/bootstrap_hover_dropdown/twitter-bootstrap-hover-dropdown.min.js' type='text/javascript'></script>
    <!-- / slider nav (address book) -->
    <script src='assets/javascripts/plugins/slider_nav/slidernav-min.js' type='text/javascript'></script>
    <!-- / fuelux -->
    <script src='assets/javascripts/plugins/fuelux/wizard.js' type='text/javascript'></script>
    <!-- / flatty theme -->
    <script src='assets/javascripts/nav.js' type='text/javascript'></script>
    <script src='assets/javascripts/tables.js' type='text/javascript'></script>
    <script src='assets/javascripts/theme.js' type='text/javascript'></script>
    <!-- / demo -->
    <script src='assets/javascripts/demo/jquery.mockjax.js' type='text/javascript'></script>
    <script src='assets/javascripts/demo/inplace_editing.js' type='text/javascript'></script>
    <script src='assets/javascripts/demo/charts.js' type='text/javascript'></script>
    <script src='assets/javascripts/demo/demo.js' type='text/javascript'></script>
    
<script src='js/common.js' type='text/javascript'></script>
<script src="upload/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="upload/uploadify.css">  

    
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>



<body class='contrast-red '>
<?php 
    include_once 'header.php';
?>
<div id='wrapper'>
<div id='main-nav-bg'></div>

<?php
    include_once 'nav.php';
?>
<section id='content'>
<div class='container-fluid'>
<div class='row-fluid' id='content-wrapper'>
<div class='span12'>
    
<div class='page-header'>
    <h1 class='pull-left'>
        <i class='icon-dashboard'></i>
        <span><?php echo $title; ?></span>
    </h1>
    <div class='pull-right'>
        <div class='btn-group'>
            <button class='btn btn-warning cancel' type='back' id="back">
                <i class='icon-ban-circle icon-white'></i>
                <span>Back</span>
            </button>
        </div>
    </div>
</div>
<div class='alert alert-info' id="alert" style="display:none;">
    <a class='close' data-dismiss='alert' href='#'>&times;</a>
    <strong id="msg"></strong>
</div>
    <form enctype="multipart/form-data" id='myform' style="margin-bottom: 0;" method="post" class="form form-horizontal" action="" accept-charset="UTF-8"><div style="margin:0;padding:0;display:inline"><input type="hidden" value="✓" name="utf8"><input type="hidden" value="CFC7d00LWKQsSahRqsfD+e/mHLqbaVIXBvlBGe/KP+I=" name="authenticity_token"></div>
                <div class="control-group">
                    <label for="inputText1" class="control-label">视频地址</label>
                    <div class="controls">
                        <input type="text" placeholder="视频地址" name="url" id='url' value="<?php echo @$video[VideoModel::_url];?>">
                    </div>
                </div>
        <div class="control-group">
                    <label for="inputText1" class="control-label">标题</label>
                    <div class="controls">
                        <input type="text" placeholder="标题" name="title" id='title' value="<?php echo @$video[VideoModel::_name];?>">
                    </div>
                </div>
        <div class="control-group">
                    <label for="inputText1" class="control-label">缩略图</label>
                    <div class="controls" id="logo_view">
                        <image border="0" src="<?php echo $video[VideoModel::_thumbnails]?>" style="float:left;margin-right:10px;max-height:30px;"/>
                    </div>
                </div> 
        <div class="control-group" id="logurl" >
                    <label for="inputText2" class="control-label">缩略图地址</label>
                    <div class="controls">
                        <input type="text" placeholder="请输缩略图地址" name="logourl" id="logourl" value="<?php echo $video[VideoModel::_thumbnails]?>">
                    </div>
                </div>
        <div class="control-group">
                    <label class="control-label">选手</label>
                    <div class="controls">
                        <div class="row-fluid">
                            <div class='span6'>
                                <div class='row-fluid'>
                                    <select class='select2 input-block-level' placeholder='请输入选手...' name='player1' id='player1' style="width:200px;">
                                        <optgroup label='选择选手'>
                                            <option value="0"/>请选择
                                            <?php 
                                                function isEqual($id, $ids){
                                                    if($id == $ids){
                                                        return 'selected';
                                                    }
                                                }
                                                foreach($players as $arr){
                                                    echo '<option value=\''. $arr[PlayerModel::_id] .'\' '. isEqual($arr[PlayerModel::_id], $video[VideoModel::_player_one]) . ' />' . $arr[PlayerModel::_name]; 
                                                }
                                            ?>
                                        </optgroup>
                                    </select> 
                                    VS
                                    <select class='select2 input-block-level' placeholder='请输入选手...' name='player2' id='player2' style="width:200px;">
                                        <optgroup label='选择选手'>
                                            <option value="0"/>请选择
                                            <?php 
                                                foreach($players as $arr){
                                                    echo '<option value=\''. $arr[PlayerModel::_id] .'\' '. isEqual($arr[PlayerModel::_id], $video[VideoModel::_player_two]) . '/>' . $arr[PlayerModel::_name]; 
                                                }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>   
        <div class="control-group">
                    <label class="control-label">战队</label>
                    <div class="controls">
                        <div class="row-fluid">
                            <div class='span6'>
                                <div class='row-fluid'>
                                    <select class='select2 input-block-level' placeholder='请输入战队...' name='team1' id='team1' style="width:200px;">
                                        <optgroup label='选择战队'>
                                            <option value="0"/>请选择
                                            <?php 
                                                foreach($teams as $arr){
                                                    echo '<option value=\''. $arr[TeamModel::_id] .'\' '. isEqual($arr[TeamModel::_id], $video[VideoModel::_team_one]) . '/>' . $arr[TeamModel::_name]; 
                                                }
                                            ?>
                                        </optgroup>
                                    </select> 
                                    VS
                                    <select class='select2 input-block-level' placeholder='请输入战队...' name='team2' id='team2' style="width:200px;">
                                        <optgroup label='选择战队'>
                                            <option value="0"/>请选择
                                            <?php 
                                                foreach($teams as $arr){
                                                    echo '<option value=\''. $arr[TeamModel::_id] .'\' '. isEqual($arr[TeamModel::_id], $video[VideoModel::_team_two]) . '/>' . $arr[TeamModel::_name]; 
                                                }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>  
        <div class="control-group">
                    <label class="control-label">解说</label>
                    <div class="controls">
                        <div class="row-fluid">
                            <div class='span6'>
                                <div class='row-fluid'>
                                    <select class='select2 input-block-level' placeholder='请输入解说...' name='descant' id='descant' >
                                        <optgroup label='选择解说'>
                                            <option value="0"/>请选择
                                            <?php 
                                                foreach($descants as $arr){
                                                    echo '<option value=\''. $arr[DescantModel::_id] .'\' '. isEqual($arr[DescantModel::_id], $video[VideoModel::_descant]) . '/>' . $arr[DescantModel::_name]; 
                                                }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>  
        
        <div class="control-group">
                    <label class="control-label">地图</label>
                    <div class="controls">
                        <div class="row-fluid">
                            <div class='span6'>
                                <div class='row-fluid'>
                                    <select class='select2 input-block-level' placeholder='请输入地图...' name='map' id='map' >
                                        <optgroup label='选择地图'>
                                            <option value="0"/>请选择
                                            <?php 
                                                foreach($maps as $arr){
                                                    echo '<option value=\''. $arr[MapModel::_id] .'\' '. isEqual($arr[MapModel::_id], $video[VideoModel::_map]) . '/>' . $arr[MapModel::_name]; 
                                                }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> 
                <div class="form-actions">
                    <button type="button" class="btn btn-primary" id="save" onclick='onSubmit();'>
                        <i class="icon-save"></i>
                        Save
                    </button>
                    <button type="button" class="btn" id="cancel" onclick='return reload();'>Cancel</button>
                </div>
        <input type='hidden' name='tags' id='tags' value="" />
        <input type='hidden' value='<?php echo $id;?>' id='cid' />
    </form>
    <input type='hidden' id='r' value="<?php echo $_REQUEST['r']; ?>" />
       
</div>
</div>
</div>
</section>
<script src='js/common.js' type='text/javascript'></script>
<script type="text/javascript">
function onSubmit(){
    if($('#name').val() == '' || 
            $('#gameid').val() == '' ||
            $('#nickname').val() == ''
            ){
        showError('请填写完整应用信息...');
        return false;
    }
    $.ajax({
            type:   "post",
            url :   "script/api.php",
            dataType:   'json',
            data:   'action=modifiedVideo&id=' + $('#cid').val() + '&url=' + $('#url').val() + '&title=' + $('#title').val() 
            + '&logourl=' + $('#logourl').val() + '&player1=' + $('#player1').val() + '&player2=' + $('#player2').val()
            + '&team1=' + $('#team1').val() + '&team2=' + $('#team2').val() + '&descant=' + $('#descant').val() + '&map=' + $('#map').val()
            ,
            success:function(json){
                if(json == null){
                    showError("系统繁忙请稍候再试..");
                    return;
                }
                if(json.result == '0' ){
                    showError("操作成功...");
                    
				}else{
					if(json.result == '1'){
						showError("操作失败...");
					}else{
					  	showError("系统繁忙请稍候再试...");
					} 
				}
			}
    });
    
}
function reload(){
    window.location.href = document.getElementById('r').value;
    return false;
}


</script>
</div>
</body>
</html>