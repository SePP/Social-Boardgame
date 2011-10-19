<?php include_partial("fb_login", array("facebook" => $facebook)); ?>
<?php 
if($user != ""){
	echo link_to("get friends data","init/friends");
}
?>