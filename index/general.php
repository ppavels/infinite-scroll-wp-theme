<?php $this_post=new Post();
$views=$this_post->getPostViews(); 

 ?>
 <div class="index-post post">
        <div class="post-image"><a href="<?php the_permalink(); ?>"><img src="<?php echo Images::getPostImageUrl(); ?>" alt="<?php the_title() ;?>" title="<?php the_title() ;?>" border="0"></a></div>
        <div class="post-entry">
         <a href="<?php echo $this_post->getPermalink(); ?>"><h6><?php echo $this_post->getTitle(); ?></h6></a>
          <a href="<?php the_permalink(); ?>" class="get-dash-btn" title="<?php echo $this_post->getButtonText(); ?>"><?php echo $this_post->getButtonText(); ?></a>
          <p><?php the_content() ;?></p>
          <?php $this_post->getBrandLink(TRUE); ?> 
        </div>
        <div class="counts">
        <p><span class="cmnt-bg"><?php FBcomments::getCommentCount(); ?></span>comments</p>
        <?php if ($views) { ?>
        <p><span class="views"></span><br><?php echo $views; ?></p>
        <?php } ?> 
        
        </div>
        <div class="clearfix"></div>
        <div class="feeds"><?php include (TEMPLATEPATH . '/socialmedia/index_post.php' ); ?></div>
        
        <?php $this_post->getExclusiveOffer(); ?> 
        <?php /*  $this_post->showExpiredDate(); */  ?> 
 </div>