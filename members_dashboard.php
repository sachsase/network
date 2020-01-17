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
<link rel="stylesheet" href="cdyn_includes/templates/style.css">

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
<?php include_once("cdyn_includes/templates/member_links.php");?>



<h4>Member Dashboard:</h4><br/>


<?php

$sql="SELECT * FROM posts WHERE posts_owner=".$_SESSION[USR_SESSION]['members']['member_id']."  ORDER BY ABS(posts_id) DESC";
$post_arr=$db->getRecords($sql);

if(is_array($post_arr) && count($post_arr)>0) {
?>

<div class="post_list">
<?php
foreach($post_arr as $posts) {

$post_title=($posts['post_title']!='')?'<h4>'.stripslashes($posts['post_title']).'</h4>':'';
$post_content=($posts['post_content']!='')?'<p>'.nl2br(stripslashes($posts['post_content'])).'</p>':'';

echo '<div class="post" >'.$post_title.'<br/>'.$post_content.'</div>';

}
?>

</div>
<?php } else { ?>

<p>No Post Here.<a href="create_post.php">Click here to add post</a></p>

<?php } ?>
</div>
</div>
</form>

<br/><br/>
</div>
</body>
</html>