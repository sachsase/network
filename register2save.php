<?php
include_once(dirname(__FILE__) . "/cdyn_includes/database/db.php");
include_once(dirname(__FILE__) ."/cdyn_includes/cdyn_phputil.php");
include_once(dirname(__FILE__) ."/cdyn_includes/cdyn_printform.php");
include_once(dirname(__FILE__) . "/cdyn_includes/cdyn_phpvalidation_class.php");
$pageName="register.php";
$datastorage="insert";$error="";$ajaxmethod=0;
if(strtolower($_SERVER["REQUEST_METHOD"])!=="post") {
header("location:".$pageName);exit;
}
if(isset($_POST["ajaxmethod"]) && $_POST["ajaxmethod"]==1) {
$ajaxmethod=1;
header("Content-type:application/json");
}
$validate=new CDYN_FormValidation();
$cdyn_utilobj=new cdyn_phputility();
$arr=$postarr=array();
$arr["name"]=$postarr["name"]=$cdyn_utilobj->chkSavePostInput("name");
$arr["email"]=$postarr["email"]=$cdyn_utilobj->chkSavePostInput("email");
$valid_elem=array();
$valid_elem["name"]=array(
"value"=>$postarr["name"],
"label"=>"Name",
"validation"=>array(
"required" => true,
"min_char"=> 3,
"max_char"=> 40
)
);
$valid_elem["email"]=array(
"value"=>$postarr["email"],
"label"=>"Email",
"validation"=>array(
"required" => true,
"min_char"=> 5,
"max_char"=> 45
)
);


$validate->checkErrors($valid_elem);

//$db->debug_mode=true;
$member_rec=$db->getSingleRec("members","email='".$arr["email"]."'","member_id");

if($member_rec==true && is_array($member_rec) && count($member_rec)>0) {
$validate->addError("Email already registered.Please use another","Email");
}



$error.= $validate->getError();



if($error=="") {
$print_emailobj=new CDYNprintEmailFormData();
$print_emailobj->textbox("name","Name");
$print_emailobj->textbox("email","Email");
$cdyn_emaildata=$print_emailobj->printFormData();
/* //Print Form data
echo $cdyn_emaildata;*/

$message="Post form data successully";
$insert_status=0;
//$db->debug_mode=true;
$insert_status=$db->insert($arr,"members");
if($insert_status) {

header("location:members2login.php?saved=success");exit;

$message="Form data saved successfully";
}
if($ajaxmethod==1){
echo "{ \"error\":0,\"success\":1,\"type\":\"insert\",\"msg\":\"".$message."\"}";
exit;}else {
echo $message;
//header("location:$pageName"."?success=1");
exit;}
}else {
if($ajaxmethod==1) {
echo "{ \"error\":1,\"success\":0,\"type\":\"insert\",\"msg\":\"$error\"}";
}
else {
include_once($pageName);
}
}
?>