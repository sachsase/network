<?php
include_once(dirname(__FILE__) . "/cdyn_includes/database/db.php");
include_once(dirname(__FILE__)."/cdyn_includes/cdyn_phputil.php");
$utilobj=new cdyn_phputility();

$current_logged_member=(isset($_SESSION[USR_SESSION]['members']) && is_array($_SESSION[USR_SESSION]['members']) && $_SESSION[USR_SESSION]['members']['member_id']>0)?$_SESSION[USR_SESSION]['members']['member_id']:0;

include_once("cdyn_includes/templates/group_check.php");


if(isset($_POST['setfriend']) && $_POST['setfriend']>0 && $current_logged_member==$group_rec['group_owner']) {
$select_mem=intval($_POST['setfriend'],10);
if($select_mem>0) {
$member_rec=$db->getSingleRec("members","member_id=$select_mem AND member_id!=$current_logged_member");
//print_r($member_rec);
if($member_rec==true && is_array($member_rec) && count($member_rec)>0) {
$check_friend_exists=$db->getSingleRec("group_members","group_id=".$group_rec['group_id']." AND member_id=$select_mem");

if(isset($check_friend_exists) && $check_friend_exists==true && is_array($check_friend_exists) && count($check_friend_exists)>0) {
	header("location:groups_add_member.php?grp=".$group_rec['group_id']."&friend=already");exit;
}else {


$marr=array();
$marr['group_id']=$group_rec['group_id'];
$marr['member_id']=$select_mem;
$marr['created_at']=date("Y-m-d H:i:s");

$insert_status=$db->insert($marr,"group_members");

header("location:groups_add_member.php?grp=".$group_rec['group_id']."&added=success");exit;
}

}

}
}

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
<form class="cdynforms" name="cdynform" id="cdynform" action="groups_add_member.php?grp=<?php echo $group_rec['group_id'];?>" method="post" enctype="multipart/form-data" >
<div class="cdynformdiv">
<?php include_once("cdyn_includes/templates/header.php");?>
<div class="cdynformelementsdiv">
<?php //include_once("cdyn_includes/templates/member_links.php");?>

<h4>Groups &raquo; <?php echo $group_rec['group_name'];?> &raquo; Add/Invite Members:</h4><br/>

<?php include_once("cdyn_includes/templates/group_links.php");?>

<?php

$sql="SELECT * FROM group_members WHERE group_id=".$group_rec['group_id']."  ORDER BY ABS(groupmember_id) ASC";
$grpmembers_arr=$db->getRecords($sql,"groupmember_id","member_id");

//echo '<pre>';
//print_r($friends_arr);
//echo '</pre>';

$sqlcsv=(is_array($grpmembers_arr) && count($grpmembers_arr)>0)?" AND member_id NOT IN(".implode(",",$grpmembers_arr).")":"";
?>

<div class="cdyninput_elements label_left medium" >
<label class="choicemain_label">Tag Friend/Member </label>
<select name="setfriend" id="setfriend">
<option value="#">Add Member</option>
<?php echo $utilobj->getSelectOptions("SELECT member_id,name FROM members WHERE member_id!=".$group_rec['group_owner']." $sqlcsv","member_id","name");?>
</select>
</div>

<div class="cdyninput_elements" >
<div class="submitbtn">
<input type="submit" name="cdynsubmit" id="cdynsubmit" value="Connect" />
</div>
</div>


</div>
</div>
</form>
</div>
</body>
</html>