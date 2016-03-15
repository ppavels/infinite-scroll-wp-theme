<?php $this_post=new Post(); 
$views=$this_post->getPostViews(); 

//7) 
//8) Install Forum
//9) Should do something with expired (add display checkbox) and where to display should I move into expired?


 ?> 
 <div class="coupon-post">
        <div class="post-image"><a rel="nofollow" target="_blank" href="<?php the_permalink(); ?>"><img src="<?php echo Images::getPostImageUrl(); ?>" alt="<?php the_title() ;?>" title="<?php the_title() ;?>" border="0"></a></div>
        <div class="post-entry">
          <h6><?php the_title() ;?></h6>
          <a rel="nofollow" target="_blank" href="<?php the_permalink(); ?>" class="get-dash-btn" title="<?php echo $this_post->getButtonText(); ?>" ><?php echo $this_post->getButtonText(); ?></a>
          <p><?php the_content() ;?></p>
          <p><?php $cat =new Category(); $cat->getBrandLink(); ?></p>
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