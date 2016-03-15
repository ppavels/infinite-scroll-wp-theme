<?php global $counts; $this_post=new Post() ?>		
<?php // if (($this_post->compareDate())==FALSE){?>
<div class="contest-post">
 <div class="featured-image"><a href="<?php echo $this_post->getPermalink(); ?>"><img src="<?php    
 if ($this_post->getPostImage()==FALSE) {echo Images::get_thumb_300();}else{ echo $this_post->getPostImage();} 
 ?>" width='300' alt="<?php echo $this_post->getTitle(); ?>" title="<?php echo $this_post->getTitle(); ?>"></a>
  
  <div class="hover-bg">
  <?php echo $this_post->getShareButtons('Contests'); ?>

  
  </div><!--/hover-bg-->
  
  </div><!--/featured-image-->
   <p class="deatails" id="deatails">
          <span class="date"><?php echo get_the_date(); ?></span>  
         <span>
              <?php echo $this_post->showExpiredDate();
                         ?></span>  
     </p>
  <div class="entry-post" style="margin-top: 10px"><a href="<?php echo $this_post->getPermalink(); ?>">
  <h6><?php echo $this_post->getTitle()
          //. ' title '.$topic_name
          ;?></h6></a>
  <p><?php   /*echo $this_post->getContent(); */?></p>
  
  </div><!--/entry-post-->
  </div><!--/contest-post--> 
   <?php // }
