<?php get_header(); ?>
<?php $term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' )); $cat=new Category();?>
<?php
$cat->getSubTaxonomy($term, 'local');
 ?>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php // include (TEMPLATEPATH . '/tools/top-brands.php' ); ?>
<?php //include (TEMPLATEPATH . '/tools/social-connect.php' ); ?>
<?php get_footer(); ?>