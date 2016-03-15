<div id="interior" style="float:right;  margin-left:0px;  padding-top:10px; width:310px; ">
	<?php if(get_option('adjump_facebook_link')!=""){ ?>
<a class="media" href="<?php echo (!empty($facebook_id)) ? $facebook_url : get_option('adjump_facebook_link'); ?>  " title="Facebook" target="_blank" rel="nofollow"><div id="fb_button"></div></a>
	<?php }?>
    	<?php if(get_option('adjump_twitter_link')!=""){ ?>
           <a class="media"  href="<?php echo (!empty($twitter_id)) ? $twitter_url : get_option('adjump_twitter_link'); ?>" title="Twitter" target="_blank" rel="nofollow"><div id="tw_button"></div></a>
           <?php }?>
       <?php if(get_option('adjump_rss_link')==""){ ?>
<a class="media" href="<?php bloginfo('rss2_url'); ?>" title="RSS"  target="_blank"><div id="rss_button"></div></a>
<?php } else{ ?>
<a class="media" href="<?php echo get_option('adjump_rss_link'); ?>" title="RSS" target="_blank"><div id="rss_button"></div></a>
 <?php }?>
           <a class="media" href="javascript:addBookmark('<?php bloginfo('name'); ?>','<?php echo  strtolower  (get_bloginfo('url'))?>');" title="Add to Favorites"><div id="fv_button"></div></a>
           <?php if(get_option('adjump_youtube_link')!=''){ ?>
           <a rel="nofollow" class="media" href="<?php echo get_option('adjump_youtube_link'); ?>" title="<?php bloginfo('name'); ?> on Youtube"><div id="ut_button"></div></a>
           <?php }?>
		<div class="clearer"></div>
<?php if(get_option('adjump_facebook_link')!=""){ ?>
<div style="text-align:left; margin:15px 0; position:relative; z-index:1; padding-left:3px"><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php echo get_option('adjump_facebook_link'); ?>" layout="standart" width="265" show_faces="no" ></fb:like></div>
<?php } ?>
<?php echo(get_post_meta($post->ID, "postdescription", true)); ?>
   </div>