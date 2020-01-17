<?php
$groupid=(isset($_GET['grp']) && $_GET['grp']>0)?intval($_GET['grp'],10):0;
$group_rec=false;

if($groupid>0) {
$group_rec=$db->getSingleRec("groups","group_id=$groupid");
}

if($groupid<1 || $group_rec===false || !is_array($group_rec) || count($group_rec)<1) {
header("location:groups_list.php?groups=nil");exit;
}
?>