<?php get_header(); ?>
<?php echo "taxonomy-coupons.php"?>

<?php $term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' )); 
 //$coupons_subcats = get_terms('coupons', 'hide_empty=1'); 
/*echo "<pre>".print_r($coupons_subcats,TRUE)."</pre>";*/
/*echo "TERM IS ".$term->slug; */ ?>
<?php $category=new Category(); $category->getCoupons($term->slug); ?>
<?php $category->getBackToTop('coupons'); ?>

<?php get_footer(); ?>