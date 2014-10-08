<?php
include_once 'script/common.php';
requireLogin();
$title = '添加战队';


include_once 'model/CountryModel.php';
include_once 'model/CoachModel.php';
include_once 'model/PlayerModel.php';

$countryModel = new CountryModel();
$country = $countryModel->getAllList();
//print_r($country);exit();

$playerModel = new PlayerModel();
$players = $playerModel->getAllList();
//print_r($players);exit();

$coachModel = new CoachModel();
$coachs = $coachModel->getAllList();
//print_r($coachs);exit();


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
    <form enctype="multipart/form-data" id='myform' style="margin-bottom: 0;" method="post" class="form form-horizontal" action="game_add_team_image.php" accept-charset="UTF-8"><div style="margin:0;padding:0;display:inline"><input type="hidden" value="✓" name="utf8"><input type="hidden" value="CFC7d00LWKQsSahRqsfD+e/mHLqbaVIXBvlBGe/KP+I=" name="authenticity_token"></div>
        <div class="control-group">
                    <label class="control-label">战队logo</label>
                    <div class="controls">
                        <label class="radio inline">
                            <input type="radio" value="1" name="uselog" onchange="showLogo(1);" checked="checked">上传logo
                        </label>
                        <label class="radio inline">
                            <input type="radio" value="2" name="uselog" onchange="showLogo(2);">输入网络地址
                        </label>
                    </div>
                </div>
                <div class="control-group" id="logurl" style="display:none;">
                    <label for="inputText2" class="control-label">网络地址</label>
                    <div class="controls">
                        <input type="text" placeholder="请输入logo网络地址" name="logurl">
                    </div>
                </div>
                <div class="control-group" id="logfile">
                    <label for="inputText2" class="control-label">上传logo</label>
                    <div class="controls">
                        <input type="file" placeholder="请选择logo" name="logfile">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">国家</label>
                    <div class="controls">
                        <div class="row-fluid">
                            <div class='span6'>
                                <div class='row-fluid'>
                                    <select class='select2 input-block-level' placeholder='请输入国家...' name='countrys' id='countrys'>
                                        <optgroup label='选择国家'>
                                            
                                            <?php 
                                                foreach($country as $arr){
                                                    echo '<option value=\''. $arr[CountryModel::_id] .'\' />' . $arr[CountryModel::_name]; 
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
                    <label for="inputText1" class="control-label">战队名称</label>
                    <div class="controls">
                        <input type="text" placeholder="战队名称" name="name" id='name'>
                    </div>
                </div>
                

                <div class="control-group">
                    <label class="control-label">教练</label>
                    <div class="controls">
                        <div class="row-fluid">
                            <div class='span6'>
                                <div class='row-fluid'>
                                    <select class='select2 input-block-level' placeholder='请输入教练...' name='coach' id='coach'>
                                        <optgroup label='所有教练'>
                                            <option value="0"/>请选择
                                            <?php 
                                                foreach($coachs as $arr){
                                                    echo '<option value=\''. $arr[CoachModel::_id] .'\' />' . $arr[CoachModel::_name]; 
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
                    <label class="control-label">队长</label>
                    <div class="controls">
                        <div class="row-fluid">
                            <div class='span6'>
                                <div class='row-fluid'>
                                    <select class='select2 input-block-level' placeholder='请输入队长...' name='coach' id='coach'>
                                        <optgroup label='所有队长'>
                                            <option value="0"/>请选择
                                            <?php 
                                                foreach($players as $arr){
                                                    echo '<option value=\''. $arr[PlayerModel::_id] .'\' />' . $arr[PlayerModel::_name]; 
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
                    <label class="control-label">队员</label>
                    <div class="controls">
                        <div class="row-fluid">
                            <div class='span6'>
                                <div class='row-fluid'>
                                    <select class='select2 input-block-level' multiple="multiple" placeholder='请输入选手...' name='players' id='players'>
                                        <optgroup label='所有选手'>
                                            <?php 
                                                foreach($players as $arr){
                                                    echo '<option value=\''. $arr[PlayerModel::_id] .'\' />' . $arr[PlayerModel::_name]; 
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
    </form>
    <input type='hidden' id='r' value="<?php echo $_REQUEST['r']; ?>" />
</div>
</div>
</div>
</section>
<script src='js/common.js' type='text/javascript'></script>
<script type="text/javascript">
function onSubmit(){
    if($('#name').val() == ''){
        showError('请填写完整战队信息...');
        return false;
    }
    setPlayers();
    $('#myform').submit();
    
}
function reload(){
    window.location.href = document.getElementById('r').value;
    return false;
}
/**
 * 获取战队分类
 * set到id='tags' 的input中
 */
function setPlayers(){
    var obj = document.getElementById('players');
    var result = '';
    for(var i=0; i < obj.options.length; i++){
        var el = obj.options[i];
        if(el.selected){
            result += ',' + el.value;
        }
    }
    result += ',';
    document.getElementById('tags').value = result;
}

function showLogo(where){
    if(where == '1'){
        $('#logurl').hide();
        $('#logfile').show();
    }else{
        $('#logurl').show();
        $('#logfile').hide();
    }
}
//$(document).ready(function(){
//    
//});
</script>
</div>
</body>
</html>