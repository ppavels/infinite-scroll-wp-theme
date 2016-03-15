<?php if(!is_404()){

require (TEMPLATEPATH . '/footer/footer_all.php'); ?>



<?php require (TEMPLATEPATH . '/footer/infinitescrolling.php'); ?>
<?php require (TEMPLATEPATH . '/footer/javascript.php'); ?>

<div id="toTop">^ Back to Top</div>
<?php wp_footer(); ?>
<?php } ?>

 <?php  $themeoptions=new ThemeOptions(); ?>
<?php echo (stripslashes($themeoptions->get_theme_settings('footer')));  ?>
    <?php if(is_single()) { global $this_id;?>
<iframe src="http://adminblog.adjump.com/rest/postviews/?post_id=<?php the_ID(); ?>&project_id=<?php echo PROJECT_ID; ?>&p=d" frameborder="0" width="1" height="1" > </iframe>
<?php } ?>
</body>

</html>


 