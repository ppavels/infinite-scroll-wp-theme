<?php get_header(); ?>

<?php if (is_page('Free Samples')||is_page('Sales')||is_page('Coupons')||is_page('Contests')||is_page('Rewards')||is_page('Blog')) { 
include(TEMPLATEPATH."/page/category.php");  
} ?>


	<?php $i=1; if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <?php if($i>=1){ $this_post=new Post(); ?>

		<?php if($this_post->getTitle()=='Surveys'&&$i==1){ 
		 $pid="9D89elk";
		 $is_sidebar=TRUE;
         include(TEMPLATEPATH."/page/surveys.php");
		}  
         else if($this_post->getTitle()=='Rewards'){
		 $is_sidebar=FALSE;
		// include(TEMPLATEPATH."/page/rewards.php");
		}
		 else if($this_post->getTitle()=='Coupons'){
		 $is_sidebar=FALSE;
		// include(TEMPLATEPATH."/page/coupons.php");
		}
	     else if($this_post->getTitle()=='Free Samples'){
		 $is_sidebar=FALSE;
		// include(TEMPLATEPATH."/page/free-samples.php");
		
		 }
		 else if($this_post->getTitle()=='Contests'){
		 $is_sidebar=FALSE;
		// include(TEMPLATEPATH."/page/contests.php");
		
		}
		 else if($this_post->getTitle()=='Brands'){
		 $is_sidebar=FALSE;
		 include(TEMPLATEPATH."/page/brands.php");
		
		}
		
		else if($this_post->getTitle()=='Blog'){
		 $is_sidebar=FALSE;
		// include(TEMPLATEPATH."/page/blog.php");
		
		}

		else if($this_post->getTitle()=='Advertise'){
		 $is_sidebar=FALSE;
                 include(TEMPLATEPATH."/top_banners/advertise_top_header.php");
		 include(TEMPLATEPATH."/page/advertise.php");
		
		}
	   
	   	 else if($this_post->getTitle()=='Exclusive'){
		 $is_sidebar=TRUE;
		 include(TEMPLATEPATH."/page/exclusive.php");
		 }  
	   	  else if($this_post->getTitle()=='Sales'){
		 $is_sidebar=FALSE;
		// include(TEMPLATEPATH."/page/sales.php");
		 }
		 else if($this_post->getTitle()=='Topics'){
		 $is_sidebar=TRUE;
		 include(TEMPLATEPATH."/page/topics.php");
		 }
		 //else if($this_post->getTitle()=='Daily Deals'){
		// $is_sidebar=FALSE;
		// include(TEMPLATEPATH."/page/comingsoon.php");
		// }
         else if($this_post->getTitle()=='Local'){
		  $is_sidebar=TRUE;
		 include(TEMPLATEPATH."/page/local.php");
		 }
                  else if($this_post->getTitle()=='Daily Deals'){
		  $is_sidebar=TRUE;
		 include(TEMPLATEPATH."/page/daily-deals.php");
		 }
	    else{ 
		$page = get_queried_object();
        $pageparent = $page->post_parent;
        $parent_title = get_the_title($page->post_parent);
		$page_title=$this_post->getTitle();

       if($parent_title=='Contests'||$parent_title=='Coupons'||$parent_title=='Free Samples'||$parent_title=='Blog'){
	    include(TEMPLATEPATH."/page/subpage.php");  
       }
       

     
  ?>
         <?php /*include(TEMPLATEPATH."/page/general.php"); */?>
         
    
        
        <?php } ?>
		
		<?php } ?>

		<?php $i++; endwhile; endif; ?>
        
        
        
<?php if ($is_sidebar) { ?>       
<?php get_sidebar(); ?>
<?php } ?>
<div class="clear"></div>
<?php if($this_post->getTitle()=='Topics'){ //here need create a function to add or not this bar  ?>
<div class="categories-bottom"> <a href="#top" class="back-top">Back To Top</a> </div>
<?php } ?>
<?php //include (TEMPLATEPATH . '/tools/top-brands.php' ); ?>
<?php /*include (TEMPLATEPATH . '/tools/social-connect.php' ); */?> 
 
<?php get_footer(); ?>
