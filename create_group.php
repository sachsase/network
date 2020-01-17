<?php
include_once(dirname(__FILE__) . "/cdyn_includes/database/db.php");
include_once(dirname(__FILE__)."/cdyn_includes/cdyn_phputil.php");
$utilobj=new cdyn_phputility();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<script type="text/javascript" src="cdyn_includes/plugins/jquery/jquery-1.10.2.js"></script>
<link rel="stylesheet" href="cdyn_includes/cdyn_formutil.css">
<link rel="stylesheet" href="cdyn_includes/cdyn_formthemes.css">
<script type="text/javascript" src="cdyn_includes/cdyn_util.js"></script>
<meta name="generator" content="create-dynamic.com Form Generator">
<meta name="designer" content="SASIKUMAR PHP Developer">
</head>
<body>
<div class="createdynamicdiv cdynstyle7">
<form class="cdynforms" name="cdynform" id="cdynform" action="create_group_action.php" method="post" enctype="multipart/form-data" >
<div class="cdynformdiv">
<?php include_once("cdyn_includes/templates/header.php");?>

<div class="cdynformelementsdiv">
<?php include_once("cdyn_includes/templates/member_links.php");?>

<h4>Create Group:</h4><br/>
<div class="cdynerror" id="cdynerror" style="display:none;"><ul><li><strong>Error :</strong></li><?php //echo $error;?></ul> </div>
<div id="cdynsuccess" style="display:none;">Your form data saved successfully</div>

<div class="cdyninput_elements label_left medium" >
<label>Group Name </label><span>
<input type="text" placeholder="" name="group_name" id="group_name" value="" maxlength="100" >
</span>
</div>

<div class="cdyninput_elements label_left medium" >
<label class="choicemain_label">Group Type </label>
<select name="group_type" id="group_type" >
<option value="1">Page</option>
<option value="2">Chat</option></select>
</div>

<div class="cdyninput_elements" >
<div class="submitbtn">
<input type="submit" name="cdynsubmit" id="cdynsubmit" value="Submit" />
<input type="reset" name="cdynreset" id="cdynreset" value="Reset" />
</div>
</div>

</div>
</div>
</form>
</div>
<script type="text/javascript">
$(document).ready(function() {
<?php
if(isset($error) && $error!="") {
echo '$(this).injectMessage("rawformerror","'.$error.'");';
}
if(isset($_GET["success"])) { echo '$(this).injectMessage("rawsuccess","Data Saved Successfully");';}
if(isset($_POST) && is_array($_POST) && count($_POST)>0) {
echo '$("#group_name").val("'.$_POST["group_name"].'");';
echo '$(this).loadCheckboxMultiSelectDefault("mulselect","'.$utilobj->chkSavePostInput("group_type").'","group_type");';
}
?>
});
</script>

<script type="text/javascript" src="cdyn_includes/cdyn_events.js"></script>
<script type="text/javascript" src="cdyn_includes/cdyn_formutil.js"></script>
<script type="text/javascript">
$(document).ready(function() {
var userform=document.getElementById("cdynform"),_submit=userform.cdynsubmit;
//_submit.addEventListener("click",function(e) {
userform.addEventListener("submit",function(e) {
cdynVal.init();
cdynVal.addElements({ name: 'group_name', id: 'group_name', label: 'Group Name', elemtype: 'text', validation: {
required: {msg: ''}
,minlength: {msg: '',num:3}
,maxlength: {msg: '',num:100}
} });
cdynVal.addElements({ name: 'group_type', id: 'group_type', label: 'Group Type', elemtype: 'select',multiple: 0, validation: { required: {msg: ''}
} });
var valobj=cdynVal.validate();
var errobj=document.getElementById("cdynerror"),successobj=document.getElementById("cdynsuccess");
errobj.style.display="none";
successobj.style.display="none";
errobj.innerHTML="";
//console.log(cdynVal.ajaxdata);
if(valobj!=true && valobj.error!=null && valobj.error.length>0){
errobj.innerHTML="<ul><li>" +valobj.error.join("</li><li>") +"</li></ul>";
errobj.style.display="block";
//alert(valobj.error.join("\n "));
e.preventDefault();
return false;
}
},false);
});
</script>
</body>
</html>