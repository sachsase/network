<?php
include_once(dirname(__FILE__) . "/cdyn_includes/database/db.php");
include_once(dirname(__FILE__) ."/cdyn_includes/cdyn_phputil.php");
include_once(dirname(__FILE__) ."/cdyn_includes/cdyn_printform.php");
include_once(dirname(__FILE__) . "/cdyn_includes/cdyn_phpvalidation_class.php");

$current_logged_member=(isset($_SESSION[USR_SESSION]['members']) && is_array($_SESSION[USR_SESSION]['members']) && $_SESSION[USR_SESSION]['members']['member_id']>0)?$_SESSION[USR_SESSION]['members']['member_id']:0;

include_once("cdyn_includes/templates/group_check.php");

if($current_logged_member!=$group_rec['group_owner'] || $group_rec['group_type']==2 || $group_rec['group_level']>=6) {
header("location:groups_dashboard.php?grp".$group_rec['group_id']);exit;
}


$pageName="groups_create_group.php";
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
$arr["group_name"]=$postarr["group_name"]=$cdyn_utilobj->chkSavePostInput("group_name");
$arr["group_type"]=1;
$valid_elem=array();
$valid_elem["group_name"]=array(
"value"=>$postarr["group_name"],
"label"=>"Group Name",
"validation"=>array(
"required" => true,
"min_char"=> 3,
"max_char"=> 100
)
);

$validate->checkErrors($valid_elem);
$error.= $validate->getError();
if($error=="") {
$print_emailobj=new CDYNprintEmailFormData();
$print_emailobj->textbox("group_name","Group Name");
$cdyn_emaildata=$print_emailobj->printFormData();
/* //Print Form data
echo $cdyn_emaildata;*/

$arr['group_owner']=$current_logged_member;
$arr['group_level']=$group_rec['group_level']+1;
$arr['parent_groupid']=$group_rec['group_id'];
$arr['level1_groupid']=$group_rec['level1_groupid'];

 	 


$message="Post form data successully";
$insert_status=0;
//$db->debug_mode=true;
$insert_status=$db->insert($arr,"groups");
if($insert_status) {
header("location:groups_grouplist.php?added=success&grp=".$group_rec['group_id']);exit;


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