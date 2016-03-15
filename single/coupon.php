<?php $this_post=new Post(); 
$views=$this_post->getPostViews(); 
$content=get_the_content();
$excerpt = get_the_excerpt();
$content=preg_replace('#<p>([^<]*?)</p>#msi', '$1',$content);
$save_text=$this_post->getSaveText();

//Questions:
/*
1) We have now Title, content (in coupon single page we also have two types 1 could be content instead of that we could you exerpt and what should we use for the second title? Should I create some cudtom value?

2) We have coupon types (what link should we use for them) horisontal icons?
3) The same I can see only two Visit, Print (vertical)
4)Links for facebook pinterest twitter and email buttons in the body of coupon?
5)Should image be clickable and if yes, what link should I use?


*/

 ?>
 <!--Coupons Post Page-->
 
  
  <div class="coupon-deal-head">
      <a rel="nofollow" target="_blank" href="<?php echo $this_post->getHyperLinkExpired(); ?>">
      <h1><?php echo $this_post->getTitle(); ?></h1></div>
 </a>
    
  <div style="margin-top: 50px;" class="coupon-inner-post post-<?php the_id(); ?>">

  <div class="coupon-slide">
  <div class="coupon-single ">
  
  <?php if($save_text) { ?>
  <div class="save-coupons"><p>save<span style="font-size:18px"><?php echo $this_post->getSaveText(); ?></span></p></div>
  <?php } ?>
  <div class="<?php echo Images::get_expired($this_post->compareDate()); ?>"></div>
  <div class="coupon-image">
      <a rel="nofollow" class="" target="_blank" href="<?php echo $this_post->getHyperLinkExpired(); ?>">
      <img width="300" height="250" src="<?php 
  if ($this_post->getPostImage()==FALSE) {echo Images::get_featured_image(FALSE,TRUE);
    }else{ echo $this_post->getPostImage(TRUE, FALSE, $this_post->compareDate());}
  ?>" alt="<?php echo $this_post->getTitle(); ?>" title="<?php echo $this_post->getTitle(); ?>"></a></div>
  <div class="coupon-text" style="height:1px; ">
   
  </div>
    
  </div>
 <div class="clearfix"></div> 
 
 
 
 
<div style="margin:50px 0 0 -40px;  height:50px; width:700px">
    
    
    
    
    
    
 <?php  $nav=new Navigation(); $nav->get_next_post('Coupons'); ?>
  <?php  $nav->get_previous_post('Coupons');  ?>
  </div>
  <div style="margin-left:130px; margin-bottom:-35px;  border-bottom: none; height:70px; width:500px;" class="share-feed"><h5>Share this!</h5><?php echo $this_post->getIndexPageFeed(); ?></div>
 </div>
  <div class="coupon-detail">
       <p class="deatails" id="deatails" style="margin-bottom: -170px !important;">
          <span class="date"><?php echo get_the_date(); ?></span>  

          <span>
              <?php echo $this_post->showExpiredDate();
                         ?></span> 
     </p>
  <h2><?php //echo $this_post->getTitle(); ?></h2> 
   <?php if (($this_post->compareDate())==FALSE){ ?>
  <p>&nbsp;</p>
   
  <p style="max-height: 170px;margin-top: -20px; overflow:hidden;"><?php echo $this_post->getContent();?></p>
  <a rel="nofollow" target="_blank" style="margin-top: -10px;" href="<?php echo $this_post->getHyperLinkExpired(); ?>" class="view-web"></a>

<?php } else{ ?> 
<p><?php echo $this_post->getContent(); ?></p>
 
  <a rel="nofollow" target="_blank" style="margin-top: -10px;" href="<?php //echo $this_post->getHyperLinkExpired(); ?>"></a>
<?php } ?>
  </div>
      
  <div class="clear"></div>
  </div>
  

   
  <?php  include (TEMPLATEPATH.'/related/coupon.php');  ?> 
    
   
    
  