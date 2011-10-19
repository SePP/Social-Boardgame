<?php include_partial("fb_login", array("facebook" => $facebook)); ?>
<?php 
$totaldata = count($friends['data']) * 2;
$adder = round((300 / $totaldata), 2); 
//echo $totaldata;
?>
<div style="border-width:1px; border-style:solid; border-color:black; width:300px; height:20px; display:block;">
<div id="filler" style="background-color:red; display:block; width:0px; height:20px;"></div>
</div>
<em>Fetching data from your friends. This can take a while.</em>
<?php 
foreach ($friends['data'] as $friend)
{
	echo "<h1>";
	echo $friend["name"];
	echo "</h1>";
	echo "<img src='https://graph.facebook.com/".$friend['id']."/picture?type=small' />";
?>
<script language="Javascript">
	$.ajax({
		url: "<?php echo url_for("init/getinfo?uid=".$friend['id']); ?>",
		success: function(data) {
	  		$('#info<?php echo $friend['id']?>').html(data);
	  		var newwidth = Math.round(($('#filler').width() + <?php echo $adder; ?>)*10)/10;
	  		$('#filler').width(newwidth);
		}
	});
</script>
<h3>Friend Info:</h3>
<?php
	echo "<div id=info".$friend['id']."><img src='http://www.viewscreen.nl/ajax-loader.gif' /></div>";
?>
<script language="Javascript">
	$.ajax({
		url: "<?php echo url_for("init/getlikes?uid=".$friend['id']); ?>",
		success: function(data) {
	  		$('#likes<?php echo $friend['id']?>').html(data);
	  		var newwidth = Math.round(($('#filler').width() + <?php echo $adder; ?>)*10)/10;
	  		$('#filler').width(newwidth);
		}
	});
</script>
<h3>Top like Categories:</h3>
<?php
	echo "<div id=likes".$friend['id']."><img src='http://www.viewscreen.nl/ajax-loader.gif' /></div>";
}
?>
