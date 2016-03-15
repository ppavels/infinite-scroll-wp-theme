<?php $this_post=new Post(); ?> 
<div class="contest-post post" style='margin-right: 20px; '>
 <div class="saleflap"> </div>
 <div class="featured-image">


    <a href="<?php echo $this_post->getPermalink(); ?>">
        <img src="<?php if ($this_post->getPostImage()==FALSE) {$img = Images::get_featured_image(FALSE,TRUE);
        echo /*'http://womenfreebies.net/tools/watermark/wm.php?lang=salesfree&src='.*/$img;
        
        }else{ echo $this_post->getPostImage(TRUE);} ?>" width="300" height="250" alt="<?php 
            echo $this_post->getTitle(); ?>" title="<?php echo $this_post->getTitle(); ?>"></a>

  <div class="hover-bg">
  <?php echo $this_post->getShareButtons('Sales'); ?>

  
  </div><!--/hover-bg-->
  
  </div><!--/featured-image-->
 
   <p class="deatails" id="deatails" style="margin-top:-5px; margin-bottom: 5px !important;">
          <span class="date"><?php echo get_the_date(); ?></span>  
         <span>
              <?php echo $this_post->showExpiredDate();
                         ?></span>  
     </p>
  <div class="entry-post" style="margin-top: 10px;">
           <a href="<?php echo $this_post->getPermalink(); ?>" class="get-btn-sales" title="<?php echo $this_post->getButtonText('Sales'); ?>"><?php echo $this_post->getButtonText('Sales'); ?></a>

  
  </div><!--/entry-post-->
  </div><!--/contest-post-->
