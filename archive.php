<?php get_header(); ?>
<div id="col-1">
<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args=array( 'paged' => $paged, 

'meta_query' => array(
       array(
           'key' => 'visibility',
           'value' => 'firstnotdisplay',
           'compare' => 'NOT LIKE',
       )
	)
);

$arhivequery = new WP_Query($args); ?> 
<?php if ($arhivequery->have_posts()) :?>
<div class="post-heading">


 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h5>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h5>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h5>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h5>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h5>Archive for <?php the_time('F jS, Y'); ?></h5>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h5>Archive for <?php the_time('F, Y'); ?></h5>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h5 class="pagetitle">Archive for <?php the_time('Y'); ?></h5>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h5 class="pagetitle">Author Archive</h5>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h5 class="pagetitle">Blog Archives</h5>
			
			<?php } ?>
                                
                                
  </div>                              
<div id="index-content">

<?php  while ($arhivequery->have_posts()) : $arhivequery->the_post(); ?>
<?php global $post, $this_post; $this_post=new Post(); $post_cat=$this_post->getPostMeta('post-type');   ?>

<?php  include (TEMPLATEPATH . '/index/'.$post_cat.'.php' ); ?>
<?php endwhile; ?>
</div>
<div  id="MainNav">
<?php next_posts_link('Next') ?>

</div>	

<?php else : ?>
<h2>Not Found</h2>
<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
