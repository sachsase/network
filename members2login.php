<?php
include_once(dirname(__FILE__) . "/cdyn_includes/database/db.php");
include_once(dirname(__FILE__)."/cdyn_includes/cdyn_phputil.php");
$utilobj=new cdyn_phputility();

if(isset($_POST['setmembers']) && $_POST['setmembers']>0) {
$select_mem=intval($_POST['setmembers'],10);
if($select_mem>0) {
$rec=$db->getSingleRec("members","member_id=$select_mem");

//echo '<pre>';
//print_r($rec);
//echo '</pre>';

$_SESSION[USR_SESSION]['members']=$rec;
header("location:members_dashboard.php?loggedin=success");exit;

}
}

if(isset($_GET['logout']) && $_GET['logout']==1) {
if(isset($_SESSION[USR_SESSION]['members']) && is_array($_SESSION[USR_SESSION]['members']) && $_SESSION[USR_SESSION]['members']['member_id']>0) {
unset($_SESSION[USR_SESSION]);
header("location:index.php?logout=success");exit;
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
<form class="cdynforms" name="cdynform" id="cdynform" action="members2login.php" method="post" enctype="multipart/form-data" >
<div class="cdynformdiv">
<?php include_once("cdyn_includes/templates/header.php");?>
<div class="cdynformelementsdiv">
<h4>Members:</h4><br/><br/><br/><br/>

<?php
$current_logged_member=(isset($_SESSION[USR_SESSION]['members']) && is_array($_SESSION[USR_SESSION]['members']) && $_SESSION[USR_SESSION]['members']['member_id']>0)?$_SESSION[USR_SESSION]['members']['member_id']:0;
?>

<div class="cdyninput_elements label_left medium" >
<label class="choicemain_label">Set Session </label>
<select name="setmembers" id="setmembers">
<option value="#">Select Members</option>
<?php echo $utilobj->getSelectOptions("SELECT member_id,CONCAT(name,'(',email,')') AS details FROM members","member_id","details",$current_logged_member);?>
</select>
</div>

<div class="cdyninput_elements" >
<div class="submitbtn">
<input type="submit" name="cdynsubmit" id="cdynsubmit" value="Set Session" />
</div>
</div>


</div>
</div>
</form>
</div>
</body>
</html>