<?php $pagenumber=preg_match('#page\/(\d+)#', $_SERVER['REQUEST_URI'], $mtch);
if(empty($mtch)){
$counter=0;
}
else{
$counter=$mtch[1]-1;
}

if($counter==0){
	$google_ad_slot=3253815361;
	$google_ad_width = 300;
    $google_ad_height = 250;
	
}
if($counter==1){
	
	$google_ad_slot=6207281763;
	$google_ad_width = 300;
    $google_ad_height = 600;
	
}
if($counter==2){
	$google_ad_slot=9300348968;
	$google_ad_width = 300;
    $google_ad_height = 250;
}

?>

<div class="contest-post">
<div class="entry-post" id="contestgoogleads<?php echo $counter; ?>" >

<div class="googleads-post" id="contestgoogleads<?php echo $counter; ?>"></div>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5393530392305555";
google_ad_slot = '<?php echo $google_ad_slot; ?>';
google_ad_width = <?php echo $google_ad_width; ?>;
google_ad_height = <?php echo $google_ad_height; ?>; 
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<?php  ?>
<p><input type="text" style="width:150px" class="google_ad_slot" value="google_ad_slot <?php echo $google_ad_slot; ?>" /> </p>
<p><input type="text" class="google_ad_slot" value="google_ad_width <?php echo $google_ad_width; ?>" /> </p>
<p><input type="text" class="google_ad_slot" value="google_ad_height <?php echo $google_ad_height; ?>" /> </p>
<?php  ?>
  </div><!--/entry-post-->
  </div><!--/contest-post--> 
  
