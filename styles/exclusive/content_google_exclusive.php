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
<div id='div-gpt-ad-<?php echo stripslashes($themeoptions->get_google_ads('exclusive_loop_channel'));?>-<?php echo $c; ?>' style='width:728px; height:90px;'>

</div>

</div>
     
<div class="clearfix"></div>
        
</div>

<?php } ?>