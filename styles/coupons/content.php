<?php $this_post=new Post(); 
$views=$this_post->getPostViews(); 
$content=get_the_content();
$excerpt = get_the_excerpt();
$content=preg_replace('#<p>([^<]*?)</p>#msi', '$1',$content);
$save_text=$this_post->getSaveText();
global $counts;
$is_display=$this_post->isShowCoupons($filter);
//if($is_display){		
?>
<?php // if (($this_post->compareDate())==FALSE){?>
<!--coupon-->				 
  <div class="coupon post <?php the_id(); ?>">
  <?php if($save_text){ ?>
  <div class="save-coupons"><p>save<span><?php echo $save_text; ?></span></p></div>
 <?php } ?>
  <div class="coupon-image"><a href="<?php the_permalink(); ?>"><img width="300" height="250" src="<?php 
     if ($this_post->getPostImage()==FALSE) {echo Images::get_featured_image(FALSE,TRUE);}else{ echo $this_post->getPostImage(TRUE);} 
  ?>" alt="<?php the_title() ;?>"></a></div>
  
      <p class="deatails" id="deatails" style="height: 5px;">
          <span class="date"><?php echo get_the_date(); ?></span>  
         <span><?php echo $this_post->showExpiredDate();              ?></span>  
     </p>
  <div class="coupon-text" style=" padding-bottom:5px; overflow:hidden; margin-top: -5px;" > 
  <p style="line-height:1.3em; font-weight:bold"><?php the_title() ;?></p></div>
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
//}
 ?> <?php // }