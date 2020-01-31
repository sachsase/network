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
<form class="cdynforms" name="cdynform" id="cdynform" action="members2login.php" method="post" enctype="multipart/form-data" >
<div class="cdynformdiv">
<?php include_once("cdyn_includes/templates/header.php");?>
<div class="cdynformelementsdiv">
<h4>Home:</h4><br/><br/>

<p>Welcome to BEE NETWORK</p>

<p>Please <a href="<?php echo SITE_PATH; ?>members2login.php"><strong>Login</strong></a> to access our Network</p>

<p>If you dont have an account, Please  <a href="<?php echo SITE_PATH; ?>register.php"><strong>Register</strong></a> to access our Network</p>

<br/>
<br/>

</div>
</div>
</form>
</div>
<div>Updated by sasi2</div>

<footer>Created By sasikumar.Software Engineer.</footer>

</body>
</html>