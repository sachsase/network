<?php
if(isset($groupid) && $groupid>0 && $group_rec==true && is_array($group_rec) && count($group_rec)>0) {
echo '<pre>';
print_r($group_rec);
echo '</pre>';
?>
<div class="headertabs">
<ul>
<li><a href="<?php echo SITE_PATH; ?>groups_dashboard.php?grp=<?php echo $groupid;?>">Live Wall</a></li>
<li><a href="<?php echo SITE_PATH; ?>create_group_post.php?grp=<?php echo $groupid;?>">Create Post</a></li>
<li><a href="<?php echo SITE_PATH; ?>groups_member_list.php?grp=<?php echo $groupid;?>">Members List</a></li>
<?php if(isset($current_logged_member) && $group_rec['group_owner']==$current_logged_member) {?>
<li><a href="<?php echo SITE_PATH; ?>groups_add_member.php?grp=<?php echo $groupid;?>">Add Member</a></li>
<?php } ?>
<?php
if(isset($group_rec) && is_array($group_rec) &&  $group_rec['group_type']==1 && $group_rec['group_level']<=5) {
?>
<li><a href="<?php echo SITE_PATH; ?>groups_create_group.php?grp=<?php echo $groupid;?>">Create Group</a></li>
<li><a href="<?php echo SITE_PATH; ?>groups_grouplist.php?grp=<?php echo $groupid;?>">Group List</a></li>
<?php } ?>
</ul>
</div><br/>

<?php } ?>