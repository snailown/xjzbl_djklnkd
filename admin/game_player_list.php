<?php
include_once 'script/common.php';
requireLogin();

$title = '选手列表';

include_once 'model/PlayerModel.php';
include_once 'model/RaceModel.php';
include_once 'script/page.class.php';

$raceModel = new RaceModel();
$races = $raceModel->getAllList();

$race_id = intval($_REQUEST['race_id']);

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo TITLE . '-' . $title;?></title>
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
<script type='text/javascript'>
function setStyle(obj){
	var tobj = document.getElementById(obj);
	if(tobj.style.display == '') 
		tobj.style.display = 'none';
	else
		tobj.style.display = '';
}
function check(id){
    document.getElementById('race_id').value = id;
    document.getElementById('myform').submit();
//    alert(id);
}
</script>
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
            <a href="#" class="btn btn-white hidden-phone">Last month</a>
            <a href="#" class="btn btn-white">Last week</a>
            <a href="#" class="btn btn-white ">Today</a>
            <a href="#" class="btn btn-white" id="daterange"><i class='icon-calendar'></i>
                <span class='hidden-phone'>Custom</span>
                <b class='caret'></b>
            </a>
        </div>
    </div>
</div>
<div style="height:55px">
    <div class='alert alert-info' id="alert" style="display:none;">
        <a class='close' data-dismiss='alert' href='#'>&times;</a>
        <strong id="msg"></strong>
    </div>  
</div>
    <table width="100%" cellpadding="1" cellspacing="1" style="border:1px solid #CCCCCC;">
		<tr>
			<td height="30" style="cursor:pointer;font-size:14px;font-weight:bold;background-color:#CCCCCC;padding-left:5px;" onclick="setStyle('ibody');">
				选择种族
				<span style="font-size:14px;font-weight:bold;color:#FF0000;padding-left:10px;"><?php echo $msg;?></span>
			</td>
		</tr>
        <tr id="ibody" style="display:<?php if($race_id == 0){ echo 'none';} ?>">
			<td>
				
				<form  enctype="multipart/form-data" name="ibodyform" id='myform' style="margin-bottom: 0;" method="post" class="form form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" accept-charset="UTF-8"><div style="margin:0;padding:0;display:inline"><input type="hidden" value="✓" name="utf8"><input type="hidden" value="CFC7d00LWKQsSahRqsfD+e/mHLqbaVIXBvlBGe/KP+I=" name="authenticity_token"></div>	
                    <div class="control-group" >
                        <label class="control-label">种族</label>
                        <div class="controls">
                            <div class="row-fluid">
                                <div class='span6'>
                                    <div class='row-fluid'>
                                        <select class='select2 input-block-level'  placeholder='请输入种族...'  onchange="check(this.value);" >
                                            <optgroup label='所有种族'>
                                                <?php 
                                                    foreach($races as $arr){
                                                        if($arr[RaceModel::_id] == $race_id){
                                                            echo '<option value=\''. $arr[RaceModel::_id] .'\' selected />' . $arr[RaceModel::_name]; 
                                                        }else{
                                                            echo '<option value=\''. $arr[RaceModel::_id] .'\' />' . $arr[RaceModel::_name]; 
                                                        }
                                                        
                                                    }
                                                ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="control-group" style="margin-left:100px;margin-right: 100px;">
                        <?php 
                            foreach($races as $arr){
                                ?>
                                    <button type="button" class="btn" onclick='return check(<?php echo $arr[RaceModel::_id]; ?>);' style="margin-left:10px;margin-top: 10px;"><?php echo $arr[RaceModel::_name];?></button>
                                <?php
                            }
                        ?>
                        
                        <input type="hidden" name='race_id' id='race_id' value="<?php echo $race_id; ?>" />
                    </div>  
				</form>
			</td>
		</tr>
	</table><br/>
	<?php 
    if($race_id == 0){
        $race_id = 1;
    }
    @$param = $key . '=' . $_REQUEST[$key] . '&race_id=' . $race_id;
	$playerModel = new PlayerModel();
//    $raceModel = new RaceModel();
    $count = $playerModel->getCounts($_REQUEST[$key], $race_id);
//    echo $count;exit;
	$page = new page($count, $_REQUEST, $param);
//    echo $page->getShowrows();exit;
    $playerModel->setPage($page);
    $result = $playerModel->getList($race_id);
	?>
	<div class="pages" style="float:right;"><?php $page->showPage();//显示分页信息?></div>
	<table width="100%" cellpadding="1" cellspacing="1" style="border:1px solid #CCCCCC;text-align:center">
		<tr bgcolor="<?php echo $page->getTitleColor();?>">
			<th height="30">ID</th>
            <th>名字</th>
			<th>选手ID</th>
			<th>外号</th>
			<th>种族</th>
            <th>战队</th>
            <th>曾效力战队</th>
            <!--<th title="点击操作">推荐状态</th>-->
		</tr>
		<?php
		foreach ($result as $arr){
		?>
		<tr bgcolor="<?php echo $page->getColor();?>">
			<td height="25"><?php echo $arr[PlayerModel::_id]; ?></td>
            <td><a href="player_details.php?id=<?php echo $arr[PlayerModel::_id]; ?>"><img style="height:15px;" src="<?php echo $arr[PlayerModel::_avatar]; ?>" border='0'/><?php echo $arr[PlayerModel::_name]; ?></a></td>
			<td><?php echo $arr[PlayerModel::_game_id]; ?></td>
			<td><?php echo $arr[PlayerModel::_nick]; ?></td>
            <td><?php echo $raceModel->getRaceName($arr[PlayerModel::_race]);?></td>
            <td><?php echo $arr[PlayerModel::_team]; ?></td>
            <td><?php echo $arr[PlayerModel::_preteam]; ?></td>
            
		</tr>
		<?php 
		}
		?>
	</table>
    
</div>
</div>
</div>
</section>
</div>
<script type="text/javascript">
    function showError(msg){
        if(msg){
            $("#msg").html(msg);
            $("#alert").fadeIn(1000, function(){
                $("#alert").fadeOut(2000);
            });
        }else{
            $("#msg").html("");
            $("#alert").hide();
        }
    }
    function setTop(id){
        handleTop(id, 'set');
    }
    
    function cancelTop(id){
        handleTop(id, 'cancel');
    }
    
    function handleTop(id, flag){

        $.ajax({
            type:   "post",
            url :   "script/api.php",
            dataType:   'json',
            data:   'action=handleTop&id=' + id + '&flag=' + flag,
            success:function(json){
                if(json == null){
                    showError("系统繁忙请稍候再试...");
                    return;
                }
                if(json.result == '0' ){
                    if(flag == 'cancel'){
                        var htmls = '<span onclick="setTop(' + id + ');" title="点击推荐" style="color:orange;cursor:pointer;">未推荐</span>';
                    }else{
                        var htmls = '<span onclick="cancelTop(' + id + ');" title="点击取消推荐" style="color:green;cursor:pointer;">已推荐</span>';
                    }
                    showError("操作成功...");
					$('#td' + id).html(htmls);
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
</script>    

</body>
</html>