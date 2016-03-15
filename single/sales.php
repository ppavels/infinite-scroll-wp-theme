<?php $this_post=new Post(); ?>

     <div class="top-what-heading">
         <a href="<?php echo $this_post->getHyperLinkExpired(); ?>" target="_blank" rel="nofollow">  <h5><?php echo $this_post->getTitle(); ?></h5>
      </a></div>
      <div id="top-freebies"> 


      <div id="freebies-banner" class="we-banner">

      
      
      
      
     <div class="sales-post">
         <div style="top: 17px;" class="<?php echo Images::get_expired($this_post->compareDate()); ?>"></div>
        <div class="post-image-300"><a rel="nofollow" target="_blank" href="<?php echo $this_post->getHyperLinkExpired(); ?>"><img width="300" height="250" src="<?php 
        
     if ($this_post->getPostImage()==FALSE) {echo Images::get_featured_image(FALSE,TRUE);}else{ echo $this_post->getPostImage(TRUE, FALSE, FALSE);}
       
        ?>" alt="<?php echo $this_post->getTitle(); ?>" title="<?php echo $this_post->getTitle(); ?>" border="0"></a></div>
        <div class="post-entry-300">
          <p class="deatails" id="deatails" style="margin-top: 0px; height: 25px;">
          <span class="date"><?php echo get_the_date(); ?></span>  
          <span><?php //$cat=get_the_category($this_post->post_id); echo $cat[0]->cat_name;  ?>
              <?php echo $this_post->showExpiredDate();
                         ?></span> 
     </p>
           <p style="max-height: 170px; overflow:hidden;"><?php echo $this_post->getContent(); ?></p>
           <a rel="nofollow" target="_blank" href="<?php echo $this_post->getHyperLinkExpired(); ?>" class="get-btn" title="<?php echo $this_post->getHyperLinkText(); ?>"><?php echo $this_post->getHyperLinkText(); ?></a>
         
           <?php //$this_post->getBrandLink(TRUE); ?> 
        </div>
        <div class="counts">
        <p><span class="cmnt-bg"><?php $this_post->getCommentsCount(); ?></span>comments</p>
        <?php if ($this_post->getPostViews()) { ?>
        <p><span class="views"></span><br><?php echo $this_post->getPostViews(); ?></p>
        <?php } ?>
        
        </div>
        <div class="clearfix"></div>
        <div class="feeds"><?php /*$this_post->getIndexPageFeed();*/ ?></div>
        
        <?php// $this_post->getExclusiveOffer(); ?> 
       
 </div>  
      
     <div class="we-banner-text">




     </div> 
      
      
      
      
      
      
      
      
      
      
 <div class="clearfix"></div> 
<div style="margin:50px 0 0 -40px;  height:50px; width:700px">
 <?php  $nav=new Navigation(); $nav->get_next_post('Sales'); ?>
  <?php  $nav->get_previous_post('Sales');  ?>
  </div>
<div style="margin-left:130px; margin-bottom:-35px;  border-bottom: none; height:70px; width:500px;" class="share-feed"><h5>Share this!</h5><?php echo $this_post->getIndexPageFeed(); ?></div>

</div>
 </div> 
<?php  include (TEMPLATEPATH.'/related/sales.php');  ?>     
 <div class="clearfix"></div>      
<div class="facebook-comment" style="margin-bottom:25px"><?php SocialMedia::getFBCommentBox(697); ?></div>

   
   

    
   
    
  