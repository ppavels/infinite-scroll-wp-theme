<?php $this_post =new Post();?>
<p style="width:697px;">
<span><a href="<?php echo $this_post->getPermalink(); ?>"><?php echo $this_post->getTitle(); ?></a></span>
<?php echo $this_post->getExcerpt(); ?>
</p>
 <!--/brand-->

