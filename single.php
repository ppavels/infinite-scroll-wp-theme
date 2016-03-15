<?php get_header(); ?>
<div id="col-1">

<?php if (have_posts()) : while (have_posts()) : the_post(); global $post; ?>
<?php global $post, $this_post; $this_post=new Post(); $post_cat=$this_post->getPostMeta('post-type');   ?>
<?php include (TEMPLATEPATH . '/single/'.$post_cat.'.php' ); ?>

<?php endwhile; ?>
<?php else : ?>
<h2>Not Found</h2>
<?php endif; ?>
</div>
   



<?php get_sidebar(); ?>
<?php if($post_cat=='blog'||$post_cat=='free-samples'){ ?>

<div class="clear" height="20px"></div>
<?php if($post_cat=='blog') { ?>
<div class="red-tab-full"> <a href="<?php $nav=new Navigation(); echo $nav->getLink('Blog', 'page'); ?>" class="back-to-frugal"></a> </div> 
<?php } ?>
<?php // include (TEMPLATEPATH . '/tools/top-brands.php' ); ?>
<?php //include (TEMPLATEPATH . '/tools/social-connect.php' ); ?>   
<?php } ?>
<?php get_footer(); ?>