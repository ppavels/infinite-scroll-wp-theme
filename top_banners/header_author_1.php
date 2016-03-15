<?php $this_author=new User(); if($this_author->has_posts()){ ?>

<div class="ad-2"></div>
<!--Ad-3-slider-->
<div align="justify" class="ad3-slider">

<?php 
//include (TEMPLATEPATH . '/top_banners/seo-description-author.php'); ?>
<div class="ad-3">
 <?php include (TEMPLATEPATH . '/googleads/300_250_slider.php'); ?> 
 </div>  
</div>
<!--/Ad-3-slider--> 
<?php } ?>