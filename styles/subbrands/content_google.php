<?php $pagenumber=preg_match('#page\/(\d+)#', $_SERVER['REQUEST_URI'], $mtch);
if(empty($mtch)){
$counter=1;
}
else{
$c=$mtch[1]-1;
}


if($c!=0){
?>
<div class="post google728inpost"> 
<div class="post-entry">
<?php $themeoptions=new ThemeOptions(); ?>
<div id='div-gpt-ad-<?php echo stripslashes($themeoptions->get_google_ads('free_loop_channel'));?>-<?php echo $c; ?>' style='width:728px; height:90px;'>
<?php /*if($counter==0){ ?>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1377094926922-0'); });
</script>
<?php } */ ?>
</div>

</div>
     
<div class="clearfix"></div>
        
</div>

<?php } ?>