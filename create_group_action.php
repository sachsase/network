<?php
include_once(dirname(__FILE__) . "/cdyn_includes/database/db.php");
include_once(dirname(__FILE__) ."/cdyn_includes/cdyn_phputil.php");
include_once(dirname(__FILE__) ."/cdyn_includes/cdyn_printform.php");
include_once(dirname(__FILE__) . "/cdyn_includes/cdyn_phpvalidation_class.php");
$pageName="create_group.php";
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
$arr["group_type"]=$postarr["group_type"]=$cdyn_utilobj->chkSavePostInput("group_type");
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
$valid_elem["group_type"]=array(
"value"=>$postarr["group_type"],
"label"=>"Group Type",
"validation"=>array(
"required" => true
)
);
$validate->checkErrors($valid_elem);
$error.= $validate->getError();
if($error=="") {
$print_emailobj=new CDYNprintEmailFormData();
$print_emailobj->textbox("group_name","Group Name");
$print_emailobj->select("group_type","Group Type");
$cdyn_emaildata=$print_emailobj->printFormData();
/* //Print Form data
echo $cdyn_emaildata;*/

$arr['group_owner']=$_SESSION[USR_SESSION]['members']['member_id'];

if($arr["group_type"]==1) {
	$arr['group_level']=1;
	//$arr['parent_groupid']=0;
	//$arr['level1_groupid']=0;
}

 	 


$message="Post form data successully";
$insert_status=0;
//$db->debug_mode=true;
$inserted_group_id=$db->insert($arr,"groups",true);
if($inserted_group_id>0) {

//Page Type
if($arr["group_type"]==1) {

$update_arr=array();
$update_arr['level1_groupid']=$inserted_group_id;
$db->update($update_arr,"group_id=".$inserted_group_id,"groups");

}


header("location:groups_list.php?added=success");exit;


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