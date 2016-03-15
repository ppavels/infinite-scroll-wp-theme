<?php $this_post=new Post(); ?> 
 <div class="index-post-300  post"> 
        <div class="post-image-300"><a href="<?php echo $this_post->getPermalink(); ?>"><img width="300" height="250" src="<?php echo $this_post->getPostImage(); ?>" alt="<?php echo $this_post->getTitle(); ?>" title="<?php echo $this_post->getTitle(); ?>" border="0"></a></div>
        <div class="post-entry-300" style=" ">
           <a href="<?php echo $this_post->getPermalink(); ?>"><h6><?php echo $this_post->getTitle(); ?></h6></a>
          <a href="<?php echo $this_post->getPermalink(); ?>" class="get-btn" title="<?php echo $this_post->getButtonText('Blog'); ?>"><?php echo $this_post->getButtonText('Blog'); ?></a>
          <p ><?php echo $this_post->getExcerpt(); ?></p>
          <?php /*$this_post->getBrandLink(TRUE);*/ ?> 
          
          <?php /* $terms = wp_get_post_terms($this_post->post_id,'brands'); echo "<pre>".print_r($terms, TRUE)."</pre>";*/ ?>
        
        </div>
        <div class="counts">
        <p><span class="cmnt-bg"><?php $this_post->getCommentsCount(); ?></span>comments</p>
        <?php if ($this_post->getPostViews()) { ?>
        <p><span class="views"></span><br><?php echo $this_post->getPostViews(); ?></p>
        <?php } ?>
        
        </div>
        <div class="clearfix"></div>
        <div class="feeds"><?php /* $this_post->getIndexPageFeed(); */ ?></div>
        
        <?php $this_post->getExclusiveOffer(); ?> 
        <?php /*  $this_post->showExpiredDate(); */  ?> 
 </div>