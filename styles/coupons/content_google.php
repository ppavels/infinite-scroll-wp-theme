<?php $pagenumber=preg_match('#page\/(\d+)#', $_SERVER['REQUEST_URI'], $mtch);
$themeoptions=new ThemeOptions();
if(empty($mtch)){
$counter=0;
}
else{
$counter=$mtch[1]-1;
}
$google_id='div-gpt-ad-'.$themeoptions->get_google_ads('coupons_loop_channel').'-'.$counter.'';
?>

<!--coupon-->				 
  <div class="coupon post">
 
  
  <div class="coupon-text" style="width:300px; padding-left:0"  > 
 	<div class="googleads-post" id="contestgoogleads<?php echo $counter; ?>"></div>

<div id='<?php echo $google_id; ?>' style='width:300px; height:250px;'>

<?php if($google_id=='div-gpt-ad-'.$themeoptions->get_google_ads('coupons_loop_channel').'-0'){ ?>
<?php display_google_ads($placement='style_header', $identyfier='coupons') ?>
<?php } ?>
</div></div>
    
  </div>
 <!--/coupon-->

<?php

 ?>