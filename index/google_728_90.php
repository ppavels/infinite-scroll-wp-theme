<?php $pagenumber=preg_match('#page\/(\d+)#', $_SERVER['REQUEST_URI'], $mtch);
if(empty($mtch)){
$counter=0;
}
else{
$counter=$mtch[1]-1;
}



?>
<div class="index-post post" style="width:728px; height:100px; padding:10px 0;  margin-top:-15px"> 
<div class="post-entry">
  <?php $themeoptions=new ThemeOptions(); ?>
<div id='div-gpt-ad-<?php echo stripslashes($themeoptions->get_google_ads('free_loop_channel'));?>-<?php echo $counter; ?>' style='width:728px; height:90px;'>
<?php if($counter==0){ ?>
<?php display_google_ads($placement='style_header', $identyfier='index') ?>
<?php } ?>
</div>

</div>
     
        <div class="clearfix"></div>
        
 </div>