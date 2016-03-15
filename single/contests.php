<?php $this_post=new Post(); 
$views=$this_post->getPostViews();  

//7) 
//8) Install Forum
//9) Should do something with expired (add display checkbox) and where to display should I move into expired?

 ?>
<!--content-->
  <div id="content">
	<!--Contest Post Page-->
    <div id="contst-post">
    
    <a rel="nofollow" target="_blank" href="<?php  echo $this_post->getHyperLinkExpired(); ?>">
    <h2><?php echo $this_post->getTitle(); ?></h2></a>
      <p class="deatails" id="deatails">
          <span class="date"><?php echo get_the_date(); ?></span>  
          <span><?php //$cat=get_the_category($this_post->post_id); echo $cat[0]->cat_name;  ?>
              <?php echo $this_post->showExpiredDate();
                         ?></span> 
     </p>
    <div style="top: 17px;" class="<?php echo Images::get_expired($this_post->compareDate()); ?>"></div>
    <div class="contest-post-image">
        <a rel="nofollow" target="_blank" href="<?php  echo $this_post->getHyperLinkExpired(); ?>">
        <img class="contest-image" src="<?php 
    
    if ($this_post->getPostImage()==FALSE) 
        { $im=new Images();
        if (($im->get_thumb_470())==FALSE){
            echo Images::get_thumb_300(FALSE);}
        else{echo Images::get_thumb_470(FALSE);}
        } 
        else
            { echo $this_post->getPostImage(FALSE, FALSE, $this_post->compareDate());}
       
        
    
    //echo Images::getOtherImage ($this_post->getPostImage(FALSE, FALSE, $this_post->compareDate()), 470);
    //echo $this_post->getPostImage(); 
    ?>" alt=""></a></div>
    <p><?php echo $this_post->getContent(); ?></p>
       <div class="clear"></div>
       <p><a rel="nofollow" target="_blank" class="content_share" href="<?php  echo $this_post->getHyperLinkExpired(); ?>"><?php echo $this_post->getHyperLinkText(); ?></a></p>
      <div class="share-contest">
     <label>Share this contest</label><div style="margin-left: 100px;">
     <?php SocialMedia::getShareButtons(); ?></div>
     </div>
    <div class="facebook-comment"><?php SocialMedia::getFBCommentBox(512); ?></div>
    <div class="social-feeds"><?php SocialMedia::getVerticalFeed();?></div>
    </div>
  
    
    
    
    <div class="clear"></div>
    
  <div class="contest-tab"><a href="<?php $nav=new Navigation(); echo $nav->getLink('Contests', 'page'); ?>" class="back-main-contest"></a></div>    
    <div class="clear"></div>
    <!--/Contest Post Page-->
  
  </div>
  <!--/content--> 