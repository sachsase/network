<?php
include_once(dirname(__FILE__) . "/cdyn_includes/database/db.php");
include_once(dirname(__FILE__)."/cdyn_includes/cdyn_phputil.php");
$utilobj=new cdyn_phputility();

$current_logged_member=(isset($_SESSION[USR_SESSION]['members']) && is_array($_SESSION[USR_SESSION]['members']) && $_SESSION[USR_SESSION]['members']['member_id']>0)?$_SESSION[USR_SESSION]['members']['member_id']:0;


if(isset($_GET['rem']) && $_GET['rem']>0) {
$select_mem=intval($_GET['rem'],10);

$sql="SELECT tab1.member_id FROM members tab1 INNER JOIN member_friends tab2 ON tab1.member_id=tab2.friend_id AND tab2.member_id=$current_logged_member AND tab2.friend_id=$select_mem ORDER BY name ASC";
$friends_arr=$db->getRecords($sql,"member_id","member_id");

if(is_array($friends_arr) && count($friends_arr)>0) {
$db->delRecord("member_friends","member_id=$current_logged_member AND friend_id=$select_mem");
$db->delRecord("member_friends","member_id=$select_mem AND friend_id=$current_logged_member");
header("location:friends_list.php?removed=success");exit;
}
header("location:friends_list.php");exit;
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

<h4>Friends List:</h4><br/>
<div class="post_list">

<?php

$sql="SELECT tab1.member_id,tab1.name FROM members tab1 INNER JOIN member_friends tab2 ON tab1.member_id=tab2.friend_id AND tab2.member_id=$current_logged_member  ORDER BY name ASC";
$friends_arr=$db->getRecords($sql,"member_id","name");

if(is_array($friends_arr) && count($friends_arr)>0) {

$tr='';
$i=1;

foreach($friends_arr as $member_id=>$name) {
$tr.='<tr><td>'.$i.'</td><td>'.$name.'</td><td><a href="friends_list.php?rem='.$member_id.'">Disconnect</a></td></tr>';
$i++;
}

if($tr!='') { echo '<table border="0" cellpadding="2" cellspacing="0">'.$tr.'</table>'; }

}else {
	echo "No friends to show.  <a href='add_friends.php'><strong>Add Friend</strong></a>";
}
?>

</div>
<br/><br/>

</div>
</div>
</form>
</div>
</body>
</html>