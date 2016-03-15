<?php get_header(); ?>
<?php $the_query = new WP_Query(); $catname = wp_title('', false);
$the_query->query('category_name=Contests&showposts=2&paged=TRUE'); if ($the_query->have_posts()) : ?>
<?php global $post; $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>
<div id="content">
<?php  $cat=new Category(); $cat_name=$cat->getSingleCatTitle(); $cat_name=str_replace(' ', '-', $cat_name); ?>
<?php if(file_exists(TEMPLATEPATH . '/category/'.$cat_name.'.php')) {             
include (TEMPLATEPATH . '/category/'.$cat_name.'.php' ); 
}
else{
	//echo 'File '.TEMPLATEPATH . '/category/'.$cat_name.'.php doesn\'t exist.' ;
	/*the generic category page should be added*/
}
 
 /* If this is a category archive */ } ?>

<?php $cat->getBackToTop($cat_name);  ?>
</div>
<?php else : ?>

<h2>Nothing found</h2>

<?php endif; ?>

<?php // include (TEMPLATEPATH . '/tools/top-brands.php' ); ?>
<?php  //include (TEMPLATEPATH . '/tools/social-connect.php' ); ?>

<?php  ?>
<?php get_footer(); ?>
