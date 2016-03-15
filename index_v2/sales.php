<?php $this_post=new Post(); ?>
<?php // if (($this_post->compareDate())==FALSE){?>
 <div class="index-post-225 post">
        <div class="post-image-225"><a href="<?php echo $this_post->getPermalink(); ?>"><img width="225" height="188" src="<?php if ($this_post->getPostImage()==FALSE) {echo Images::get_thumb_225(FALSE,TRUE);}else{ echo $this_post->getPostImage(TRUE);} ?>" alt="<?php echo $this_post->getTitle(); ?>" title="<?php echo $this_post->getTitle(); ?>" border="0"></a></div>
        <div class="post-entry-300 post-entry-300-v2">
        <div class="post_box_v2">
         <a href="<?php echo $this_post->getPermalink(); ?>"><h6><?php echo $this_post->getTitle(); ?></h6></a>
             <p class="deatails" id="deatails">
          <span class="date"><?php echo get_the_date(); ?></span>  
          <span><?php //$cat=get_the_category($this_post->post_id); echo $cat[0]->cat_name;  ?>
              <?php echo $this_post->showExpiredDate();
                         ?></span> 
     </p>
          <p><?php echo $this_post->getExcerpt(150); ?></p>
          </div>
          <?php $this_post->getBrandLink(TRUE); ?> 
          <a href="<?php echo $this_post->getPermalink(); ?>" class="get-btn" title="<?php echo $this_post->getButtonText('Sales'); ?>"><?php echo $this_post->getButtonText('Sales'); ?></a>
        </div>
        <div class="counts">
        <p><span class="cmnt-bg"><?php $this_post->getCommentsCount(); ?></span>comments</p>
        <?php if ($this_post->getPostViews()) { ?>
        <p><span class="views"></span><br><?php echo $this_post->getPostViews(); ?></p>
        <?php } ?>
        
        </div>
        <div class="clearfix"></div>
        <div class="feeds"><?php /*$this_post->getIndexPageFeed(); */ ?></div>
        
        <?php $this_post->getExclusiveOffer(); ?> 
        <?php /*  $this_post->showExpiredDate(); */  ?> 
 </div>       <?php // }