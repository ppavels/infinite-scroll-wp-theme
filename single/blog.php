<?php $this_post=new Post(); 
$views=$this_post->getPostViews(); 

 ?> 
<div class="article-head">
<h1><?php echo $this_post->getTitle() ;?></h1>
   <p class="deatails" id="deatails">
          <span class="date"><?php echo get_the_date(); ?>, BY <?php the_author_posts_link(); ?></span>
          <span><?php //$cat=get_the_category($this_post->post_id); echo $cat[0]->cat_name;  ?>
              <?php echo $this_post->showExpiredDate();
                         ?></span> 
     </p>
</div>
<div class="article-post">
<?php echo $this_post->getContent() ;?>
    <div style="margin:50px 0 0 -40px;  height:50px; width:700px">
 <?php  $nav=new Navigation(); $nav->get_next_post('Blog'); ?>
  <?php  $nav->get_previous_post('Blog');  ?>
  </div>
<div style="margin-left:130px; margin-bottom:-35px;  border-bottom: none; height:70px; width:500px;" class="share-feed"><h5>Share this!</h5><?php echo $this_post->getIndexPageFeed(); ?></div>
 
</div>
<div class="clearfix" style="height:25px"></div>

<?php  include (TEMPLATEPATH.'/related/blog.php');  ?>     
 <div class="clearfix"></div>      
<div class="facebook-comment"><?php SocialMedia::getFBCommentBox(697); ?></div>