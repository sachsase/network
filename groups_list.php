<?php
include_once(dirname(__FILE__) . "/cdyn_includes/database/db.php");
include_once(dirname(__FILE__)."/cdyn_includes/cdyn_phputil.php");
$utilobj=new cdyn_phputility();

$current_logged_member=(isset($_SESSION[USR_SESSION]['members']) && is_array($_SESSION[USR_SESSION]['members']) && $_SESSION[USR_SESSION]['members']['member_id']>0)?$_SESSION[USR_SESSION]['members']['member_id']:0;

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

<h4>Groups List:</h4><br/>
<div class="post_list">

<?php

$sql="SELECT group_id,group_name,group_type FROM groups WHERE group_owner=$current_logged_member  ORDER BY ABS(group_type) ASC,group_name ASC";
$groups_arr=$db->getRecords($sql,"group_id");

if(is_array($groups_arr) && count($groups_arr)>0) {

$tr='';
$i=1;

foreach($groups_arr as $group_id=>$arr) {
$tr.='<tr><td>'.$i.'</td><td>'.$arr['group_name'].'</td><td>'.$CDYN_ARR['group_type'][$arr['group_type']].'</td><td><a href="groups_dashboard.php?grp='.$arr['group_id'].'">View</a></td></tr>';
$i++;
}

if($tr!='') { echo '<table border="0" cellpadding="5" cellspacing="5"><tr><th>SNO</th><th>Group Name</th><th>Group Type</th><th>View</th></tr>'.$tr.'</table>'; }

}else {
	echo "No groups to show.  <a href='create_group.php'><strong>Add Group</strong></a>";
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