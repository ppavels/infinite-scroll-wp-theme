<?php get_header(); ?>
<div id="col-1" style="min-height:800px">
	<?php if (have_posts()) : ?>
<div class="brand-inner-title customblue customblue_daily_deals" style="margin-left: 20px;">
		<h2>Search Results for <?php echo $_GET['s']; ?></h2></div>

		<?php include (TEMPLATEPATH . '/styles/search/header.php' ); ?>

		<?php while (have_posts()) : the_post(); ?>
<?php $this_post=new Post(); ?>
<?php
    $key_1_values = '';
    $key_1_values = get_post_meta($post->ID, 'desktop', true);
    if($key_1_values != 'not_display'){
?>
 <?php if  (($this_post->compareDate())==FALSE){?>
			<?php include (TEMPLATEPATH . '/styles/search/content.php' ); ?>
  <?php } ?>
<?php } ?>
		<?php endwhile; ?>

	<?php include (TEMPLATEPATH . '/styles/search/footer.php' ); ?>

	<?php else : ?>
<div class="brand-inner-title customblue customblue_daily_deals" style="margin-left: 20px;">
		<h2>No posts found</h2></div>

	<?php endif; ?>
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
