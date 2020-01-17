<?php
include_once(dirname(__FILE__) . "/cdyn_includes/database/db.php");
include_once(dirname(__FILE__)."/cdyn_includes/cdyn_phputil.php");
$utilobj=new cdyn_phputility();

$current_logged_member=(isset($_SESSION[USR_SESSION]['members']) && is_array($_SESSION[USR_SESSION]['members']) && $_SESSION[USR_SESSION]['members']['member_id']>0)?$_SESSION[USR_SESSION]['members']['member_id']:0;

if(isset($_POST['setfriend']) && $_POST['setfriend']>0) {
$select_mem=intval($_POST['setfriend'],10);
if($select_mem>0) {
$member_rec=$db->getSingleRec("members","member_id=$select_mem AND member_id!=$current_logged_member");

if($member_rec==true && is_array($member_rec) && count($member_rec)>0) {
$check_friend_exists=$db->getSingleRec("member_friends","member_id=$current_logged_member AND friend_id=$select_mem");

if(isset($check_friend_exists) && $check_friend_exists==true && is_array($check_friend_exists) && count($check_friend_exists)>0) {
	header("location:add_friends.php?friend=already");exit;
}else {


$marr=array();
$marr[0]['member_id']=$current_logged_member;
$marr[0]['friend_id']=$select_mem;
$marr[0]['invite_status']=1;

$marr[1]['member_id']=$select_mem;
$marr[1]['friend_id']=$current_logged_member;
$marr[1]['invite_status']=1;

$db->insert_multiple("member_id,friend_id,invite_status",$marr,"member_friends");

header("location:add_friends.php?added=success");exit;
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
<form class="cdynforms" name="cdynform" id="cdynform" action="add_friends.php" method="post" enctype="multipart/form-data" >
<div class="cdynformdiv">
<?php include_once("cdyn_includes/templates/header.php");?>
<div class="cdynformelementsdiv">
<?php include_once("cdyn_includes/templates/member_links.php");?>

<h4>Add Friend:</h4><br/>

<?php

$sql="SELECT * FROM member_friends WHERE member_id=$current_logged_member  ORDER BY ABS(member_id) ASC";
$friends_arr=$db->getRecords($sql,"prime_id","friend_id");

//echo '<pre>';
//print_r($friends_arr);
//echo '</pre>';

$sqlcsv=(is_array($friends_arr) && count($friends_arr)>0)?" AND member_id NOT IN(".implode(",",$friends_arr).")":"";
?>

<div class="cdyninput_elements label_left medium" >
<label class="choicemain_label">Tag Friend </label>
<select name="setfriend" id="setfriend">
<option value="#">Add Friend</option>
<?php echo $utilobj->getSelectOptions("SELECT member_id,name FROM members WHERE member_id!=$current_logged_member $sqlcsv","member_id","name");?>
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