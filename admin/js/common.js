function setStyle(obj){
	var tobj = document.getElementById(obj);
	if(tobj.style.display == '') 
		tobj.style.display = 'none';
	else
		tobj.style.display = '';
}
function cfmDel(){
	return confirm('确定要删除此信息吗？');
}
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