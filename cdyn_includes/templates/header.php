<div class="cdynformheaderdiv">
<div  style="float:left;">
<h2>Bee Network</h2>
</div>

<div  style="float:right;">
<?php
if(isset($_SESSION[USR_SESSION]['members']) && is_array($_SESSION[USR_SESSION]['members']) && $_SESSION[USR_SESSION]['members']['member_id']>0) {

echo 'Welcome <a href="'.SITE_PATH.'members_dashboard.php"><strong>'.$_SESSION[USR_SESSION]['members']['name'].'</strong></a>';
echo ' | <a href="'.SITE_PATH.'members2login.php?logout=1" >Logout</a>';
?>

<?php } else echo 'Welcome Guest | <a href="'.SITE_PATH.'members2login.php"><strong>Login</strong></a>';?>

</div>

<div style="clear:both;"></div>

<div class="headertabs">
<ul>
<li><a href="<?php echo SITE_PATH; ?>index.php">Home</a></li>
</ul>
</div>


<style type="text/css">

.headertabs ul li{display:inline-block; padding:3px; border:1px solid #999; background-color:#F7F7F7;}
.headertabs ul li a {  }

</style>

</div>