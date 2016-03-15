<?php $this_post=new Post(); 
$views=$this_post->getPostViews(); 
$content=get_the_content();
$excerpt = get_the_excerpt();
$content=preg_replace('#<p>([^<]*?)</p>#msi', '$1',$content);
$save_text=$this_post->getSaveText();
global $counts;
$is_display=$this_post->isShowCoupons($filter);
if($is_display){		
?>

<!--coupon-->				 
  <div class="coupon post <?php the_id(); ?>">
  <?php if($save_text){ ?>
  <div class="save-coupons"><p>save<span><?php echo $save_text; ?></span></p></div>
 <?php } ?>
  <div class="coupon-image"><a href="<?php the_permalink(); ?>"><img width="300" height="250" src="<?php echo $this_post->getPostImage(TRUE); ?>" alt="<?php the_title() ;?>"></a></div>
  <div class="coupon-text" style="height:295px; padding-bottom:5px; overflow:hidden" > 
  <p style="line-height:1.3em; font-weight:bold"><?php the_title() ;?>
	<!--<span style="font-size:11px" ><?php //echo $excerpt; ?></span>--></p></div>
    <!--<div class="social-connect">
    <?php //$this_post->getCouponTypeIcons(); ?> 
    
    <?php 
	//share buttons
	//include (TEMPLATEPATH . '/tools/share_buttons.php' );
	//share buttons
	
	?>
    
    </div>-->
  </div>
 <!--/coupon-->

<?php
}
 ?>