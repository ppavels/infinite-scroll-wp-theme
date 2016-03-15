<?php //this should fix offset and extra pages http://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination?>
<?php get_header(); ?>
<?php $author_name="";  
     // global $post; 
	  $this_author = new User();
      $author_name= $this_author->user_name(); 
      $author_id=$this_author->user_id(TRUE);
	  

?>

<?php $themeoptions=new ThemeOptions(); ?>
<div id="col-1">
<?php if($this_author->has_posts()){ ?>
<div class="post-heading">
<h1>Author Archives: <?php echo $author_name; ?></h1>
</div>
    <div id='div-gpt-ad-<?php echo (stripslashes($themeoptions->get_google_ads('blog_loop_channel'))); ?>-0' style='width:728px; height:90px; margin-bottom:20px; '>
<?php display_google_ads($placement='style_header', $identyfier='author') ?>
</div>
<?php } ?>
<div id="index-content">
<?php /*$args=array( 'meta_key' => 'visibility', 'meta_value' => 'firstnotdisplay', 'meta_compare' => '!='  ); */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//$author=$id->author_id();echo $author;
$args=array( 'paged' => $paged, 
'author' => $author_id,
/*'meta_query' => array(
       array(
           'key' => 'visibility',
           'value' => 'firstnotdisplay',
           'compare' => 'NOT LIKE',
       )
	)*/
);
global $counter; //hmr210813
$counter=0;

$authorquery = new WP_Query($args); 
if ($authorquery->have_posts()) : while ($authorquery->have_posts()) : $authorquery->the_post();

?>
<?php global $post, $this_post; $this_post=new Post(); $post_cat=$this_post->getPostMeta('post-type');   ?>
<?php /*$is_in_contests=$this_post->isInCategory('contests'); if(!$is_in_contests) { */ ?>
<?php ?>
<?php  
if($counter==2&&$post_cat!='coupon'){
include (TEMPLATEPATH . '/index_v2/google_728_90.php' ); 
}

include (TEMPLATEPATH . '/index_v2/'.$post_cat.'.php' ); 
?>
<?php /* } */ ?>
<?php $counter++;?>
<?php endwhile; ?>
</div>
<div  id="MainNav">
<?php next_posts_link('Next') ?>


<?php else : ?>
    <div class="brand-inner-title customblue">
<h2>No archive found for <?php echo $author_name; ?></h2>
</div>
<?php endif; ?>

</div>	
</div>



<?php get_sidebar(); ?>
<div class="clear"></div>
<?php /* include (TEMPLATEPATH . '/tools/top-brands.php' ); */ ?>
<?php  /*include (TEMPLATEPATH . '/tools/social-connect.php' ); */ ?>
<?php get_footer(); ?>
