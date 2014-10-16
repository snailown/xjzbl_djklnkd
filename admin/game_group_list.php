<?php
include_once 'script/common.php';
requireLogin();

$title = '比赛场次';

include_once 'model/GroupModel.php';
include_once 'controller/GroupController.php';

include_once 'model/FixturesModel.php';
include_once 'model/FixturesGroupModel.php';

include_once 'script/page.class.php';

$fixturesModel = new FixturesModel();
$fixtures = $fixturesModel->getAllList();
//print_r($fixtures);exit;
$fixturesGroupModel = new FixturesGroupModel();
$fixturesGroup = $fixturesGroupModel->getAllList();
//print_r($fixturesGroup);exit;
function getItem($id, $key, $item){
    $result = '--';
    foreach($item as $arr){
        if($arr['id'] == $id){
            $result = $arr[$key];
            break;
        }
    }
    return $result;
}

$action = $_REQUEST['action'];
$id = $_REQUEST['id'];
if($action == 'update'){
    $groupModel = new GroupModel();
    $arrs = $groupModel->get($id);
//    print_r($arrs);
}
if($_REQUEST['add'] == '1'){//add
    $groupController = new GroupController($_REQUEST, $_FILES);
    if($groupController->addGroup() > 0){
        $msg = '添加成功';
    }else{
        $msg = '添加失败';
    }
}
if($_REQUEST['update'] == '1'){//update
    $groupController = new GroupController($_REQUEST, $_FILES);
    if($groupController->updateGroup() > 0){
        $msg = '修改成功';
    }else{
        $msg = '修改失败';
    }
}
if($_REQUEST['cancel'] == '1'){
    unset($action);
}

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
    <script src='js/common.js' type='text/javascript'></script>
<script type='text/javascript'>
function setStyle(obj){
	var tobj = document.getElementById(obj);
	if(tobj.style.display == '') 
		tobj.style.display = 'none';
	else
		tobj.style.display = '';
}
function onSubmit(){
    if($('#item').val() == '' || 
            $('#time').val() == '' ||
            $('#name').val() == ''
            ){
        showError('请填写完整赛程信息...');
        return false;
    }
    if($('#action').val() == 'update'){
        $('#update').val("1");
        $('#add').val("0");
        $('#cancel').val("0");
    }else{
        $('#update').val("0");
        $('#add').val("1");
        $('#cancel').val("0");
    }
    $('#myform').submit();
    
}
function reload(){
    $('#action').val("cancel");
    $('#cancel').val("1");
    $('#update').val("0");
    $('#add').val("0");
    $('#myform').submit();
    return false;
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
<div class='alert alert-info' id="alert" style="display:none;">
    <a class='close' data-dismiss='alert' href='#'>&times;</a>
    <strong id="msg"></strong>
</div>
    
    <table width="100%" cellpadding="1" cellspacing="1" style="border:1px solid #CCCCCC;">
		<tr>
			<td height="30" style="cursor:pointer;font-size:14px;font-weight:bold;background-color:#CCCCCC;padding-left:5px;" onclick="setStyle('ibody');">
				<?php if($action != "update"){?>添加<?php echo $title; }else{?>修改<?php echo $title;}?>
				<span style="font-size:14px;font-weight:bold;color:#FF0000;padding-left:10px;"><?php echo $msg;?></span>
			</td>
		</tr>
        <tr id="ibody" style="display:<?php if($action == ''){ echo 'none';} ?>">
			<td>
				<form enctype="multipart/form-data" id='myform' name="ibodyform" style="margin-bottom: 0;" method="post" class="form form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" accept-charset="UTF-8">
                    <div style="margin:0;padding:0;display:inline"><input type="hidden" value="✓" name="utf8"><input type="hidden" value="CFC7d00LWKQsSahRqsfD+e/mHLqbaVIXBvlBGe/KP+I=" name="authenticity_token"></div>
					
                    <div class="control-group">
                        <label class="control-label">赛程</label>
                        <div class="controls">
                            <div class="row-fluid">
                                <div class='span6'>
                                    <div class='row-fluid'>
                                        <select class='select2 input-block-level' placeholder='请输入赛程...' name='item' id='item'>
                                            <optgroup label='选择赛程'>
                                                <option value="0" />请选择
                                                <?php 
                                                function isEqual($id, $ids){
                                                    if($id == $ids){
                                                        return 'selected';
                                                    }
                                                }
                                                foreach($fixtures as $arr){
                                                    echo '<option value=\''. $arr[FixturesModel::_id] .'\' ' . isEqual($arr[FixturesModel::_id], $arrs[GroupModel::_fixtures_id]) . ' />' . $arr[FixturesModel::_name]; 
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
                        <label class="control-label">分组</label>
                        <div class="controls">
                            <div class="row-fluid">
                                <div class='span6'>
                                    <div class='row-fluid'>
                                        <select class='select2 input-block-level' placeholder='请输入分组...' name='time' id='time'>
                                            <optgroup label='选择分组'>
                                                <option value="0" />请选择
                                                <?php 
                                                
                                                foreach($fixturesGroup as $arr){
                                                    echo '<option value=\''. $arr[FixturesGroupModel::_id] .'\' ' . isEqual($arr[FixturesGroupModel::_id], $arrs[GroupModel::_name_id]) . ' />' . $arr[FixturesGroupModel::_name]; 
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
                        <label for="inputText1" class="control-label">比赛场次</label>
                        <div class="controls">
                            <input type="text" placeholder="比赛场次" name="name" id='name' value="<?php echo $arrs[GroupModel::_name]?>">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-primary" id="save" onclick='onSubmit();'>
                            <i class="icon-save"></i>
                            Save
                        </button>
                        <button type="button" class="btn" id="cancel" onclick='return reload();'>Cancel</button>
                        <input type="hidden" id="action" name="action" value="<?php echo $action;?>"/>
                        <input type="hidden" name="id" value="<?php echo $id;?>"/>
                        <input type="hidden" id="add" name="add" value="0"/>
                        <input type="hidden" id="update" name="update" value="0"/>
                        <input type="hidden" id="cancel" name="cancel" value="0"/>
                    </div>
				</form>
			</td>
		</tr>
	</table><br/>	
	<?php 
    
    @$param = $key . '=' . $_REQUEST[$key];
	$groupModel = new GroupModel();
    $count = $groupModel->getCounts($_REQUEST[$key]);
	$page = new page($count, $_REQUEST, $param);

    $groupModel->setPage($page);
    $result = $groupModel->getList();
    
    
	?>
	<div class="pages" style="float:right;"><?php $page->showPage();//显示分页信息?></div>
    
    
	<table width="100%" cellpadding="1" cellspacing="1" style="border:1px solid #CCCCCC;text-align:center">
		<tr bgcolor="<?php echo $page->getTitleColor();?>">
			<th height="30">ID</th>
			<th><?php echo $title;?>名称</th>
			<th>赛程</th>
            <th>分组名称</th>
            <th title="点击操作">操作</th>
		</tr>
		<?php
            foreach ($result as $arr){
		?>
            <tr bgcolor="<?php echo $page->getColor();?>">
                <td height="25"><?php echo $arr[GroupModel::_id]; ?></td>
                <td><?php echo $arr[GroupModel::_name]; ?></td>
                <td><?php echo getItem($arr[GroupModel::_fixtures_id], FixturesModel::_name, $fixtures) ; ?></td>
                <td><?php echo getItem($arr[GroupModel::_name_id], FixturesGroupModel::_name, $fixturesGroup) ; ?></td>
                <td>
                    <a href="<?php echo $_SERVER['PHP_SELF'];?>?action=update&id=<?php echo $arr[GroupModel::_id] . $page->getParams();?>">修改</a>
                </td>
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

</body>
</html>