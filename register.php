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
<form class="cdynforms" name="cdynform" id="cdynform" action="register2save.php" method="post" enctype="multipart/form-data" >
<div class="cdynformdiv">
<?php include_once("cdyn_includes/templates/header.php");?>
<div class="cdynformelementsdiv">
<h4>Registration:</h4><br/><br/><br/><br/>

<div class="cdynerror" id="cdynerror" style="display:none;"><ul><li><strong>Error :</strong></li><?php //echo $error;?></ul> </div>
<div id="cdynsuccess" style="display:none;">Your form data saved successfully</div>


<div class="cdyninput_elements label_left medium" >
<label>Name </label><span>
<input type="text" placeholder="" name="name" id="name" value="" maxlength="40" >
</span>
</div>
<div class="cdyninput_elements label_left medium" >
<label>Email </label><span>
<input type="text" placeholder="" name="email" id="email" value="" maxlength="45" >
</span>
</div>



<div class="cdyninput_elements" >
<div class="submitbtn">
<input type="submit" name="cdynsubmit" id="cdynsubmit" value="Register" />
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
echo '$("#name").val("'.$_POST["name"].'");';
echo '$("#email").val("'.$_POST["email"].'");';
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
cdynVal.addElements({ name: 'name', id: 'name', label: 'Name', elemtype: 'text', validation: {
required: {msg: ''}
,minlength: {msg: '',num:3}
,maxlength: {msg: '',num:40}
} });
cdynVal.addElements({ name: 'email', id: 'email', label: 'Email', elemtype: 'text', validation: {
required: {msg: ''}
,minlength: {msg: '',num:5}
,maxlength: {msg: '',num:45}
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