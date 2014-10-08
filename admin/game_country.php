<?php
include_once 'script/common.php';
requireLogin();

$title = '国家';

include_once 'model/CountryModel.php';
include_once 'controller/CountryController.php';
include_once 'script/page.class.php';
$action = $_REQUEST['action'];
$id = $_REQUEST['id'];
if($action == 'update'){
    $countryModel = new CountryModel();
    $arrs = $countryModel->getCountry($id);
//    print_r($arrs);
}
if(isset($_REQUEST['add'])){//add
    $countryController = new CountryController($_REQUEST, $_FILES);
    if($countryController->addCountry() > 0){
        $msg = '添加成功';
    }else{
        $msg = '添加失败';
    }
}
if(isset($_REQUEST['update'])){//update
    $countryController = new CountryController($_REQUEST, $_FILES);
    if($countryController->updateCountry() > 0){
        $msg = '修改成功';
    }else{
        $msg = '修改失败';
    }
}
if(isset($_REQUEST['cancel'])){
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
<script type='text/javascript'>
function setStyle(obj){
	var tobj = document.getElementById(obj);
	if(tobj.style.display == '') 
		tobj.style.display = 'none';
	else
		tobj.style.display = '';
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
				<form name="ibodyform" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
					<table width="100%" cellpadding="1" cellspacing="1">
						<tr>
							<td height="30" width="45%" align="right" style="padding-right:10px;"><?php echo $title;?>名称：</td>
							<td height="30"><input type="text" name="name" value="<?php echo @$arrs[CountryModel::_name];?>" style="width:250px;margin:0"/></td>
						</tr>
                        <tr>
							<td height="30" width="45%" align="right" style="padding-right:10px;"><?php echo $title;?>备注：</td>
							<td height="30"><input type="text" name="remark" value="<?php echo @$arrs[CountryModel::_remark];?>" style="width:250px;margin:0"/></td>
						</tr>
						<tr>
							<td colspan="2" height="30" align="center">
							<?php if($action == "update"){?>
								<input type="hidden" name="id" value="<?php echo $id;?>"/>
								<input type="submit" name="update" value="修改"/>
								<input type="submit" name="cancel" value="取消"/>
							<?php }else{?>
								<input type="hidden" name="action" value="<?php echo $action;?>"/>
								<input type="submit" name="add" value="提交"/>
							<?php }?>
							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table><br/>	
	<?php 
    
    @$param = $key . '=' . $_REQUEST[$key];
	$countryModel = new CountryModel();
    $count = $countryModel->getCounts($_REQUEST[$key]);
	$page = new page($count, $_REQUEST, $param);

    $countryModel->setPage($page);
    $result = $countryModel->getList();
    
    
	?>
	<div class="pages" style="float:right;"><?php $page->showPage();//显示分页信息?></div>
    
    
	<table width="100%" cellpadding="1" cellspacing="1" style="border:1px solid #CCCCCC;text-align:center">
		<tr bgcolor="<?php echo $page->getTitleColor();?>">
			<th height="30">ID</th>
			<th><?php echo $title;?>名称</th>
			<th>备注</th>
            <th title="点击操作">操作</th>
		</tr>
		<?php
            foreach ($result as $arr){
		?>
            <tr bgcolor="<?php echo $page->getColor();?>">
                <td height="25"><?php echo $arr[CountryModel::_id]; ?></td>
                <td><?php echo $arr[CountryModel::_name]; ?></td>
                <td><?php echo $arr[CountryModel::_remark]; ?></td>
                <td>
                    <a href="<?php echo $_SERVER['PHP_SELF'];?>?action=update&id=<?php echo $arr[CountryModel::_id] . $page->getParams();?>">修改</a>
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