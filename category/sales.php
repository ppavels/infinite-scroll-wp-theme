<?php /* include (TEMPLATEPATH . '/styles/coupons/header.php' ); ?>
<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
<?php  include (TEMPLATEPATH . '/styles/coupons/content.php' ); ?>
<?php endwhile; 
wp_reset_query();
wp_reset_postdata();
?>
<?php  include (TEMPLATEPATH . '/styles/coupons/footer.php' ); */ ?>
<?php  $category=new Category(); $category->getSales();?>