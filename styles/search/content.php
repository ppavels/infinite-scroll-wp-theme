<?php $this_post=new Post(); ?>
 <div class="free-samples-post free-samples-post-v2 post" style="width: 700px;">
 
 
  <div class="post-image-225"><a href="<?php echo $this_post->getPermalink(); ?>"><img width="225" height="188" src="<?php 
      
     if ($this_post->getPostImage()==FALSE) {
         if(Images::getContestFirstImage()!=''){
         echo Images::getContestFirstImage();}else{
             echo Images::get_thumb_225(FALSE,TRUE);
         }
     
     }else{ echo $this_post->getPostImage();}
        
            
        ?>" alt="<?php echo $this_post->getTitle(); ?>" title="<?php echo $this_post->getTitle(); ?>" border="0"></a></div>
        
     <div style="float:left; width:320px; height: 200px;font-weight: normal; font-size: 14px">
        
         <div class="post_box_v2">
           <a href="<?php echo $this_post->getPermalink(); ?>"><h6><?php echo $this_post->getTitle(); ?></h6></a>
           <p class="deatails" id="deatails">
          <span class="date"><?php echo get_the_date(); ?></span>  
          <span><?php //$cat=get_the_category($this_post->post_id); echo $cat[0]->cat_name;  ?>
              <?php echo $this_post->showExpiredDate();
                         ?></span> 
     </p>
          <p><?php echo $this_post->getExcerpt(150); ?></p>
         
          <?php $this_post->getBrandLink(TRUE); ?> 
          </div>
 
       <a href="<?php echo $this_post->getPermalink(); ?>" class="get-btn" title="<?php echo $this_post->getButtonText('Freebies'); ?>"><?php echo $this_post->getButtonText('Freebies'); ?></a> 
   
        
        
        </div>
  
        <div class="counts" >
        <p><span class="cmnt-bg"><?php $this_post->getCommentsCount(); ?></span>comments</p>
        <?php if ($this_post->getPostViews()) { ?>
        <p><span class="views"></span><br><?php echo $this_post->getPostViews(); ?></p>
        <?php } ?>
        
        </div> 
        
       <div class="clearfix"></div>
      
      <?php $this_post->getExclusiveOffer(); ?>  
        
    
   
 </div> <!-- free-samples-post--> 
 