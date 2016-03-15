<?php $this_author=new User(); if($this_author->has_posts()){ ?>

<div class="ad-2"></div>
<!--Ad-3-slider-->
<?php include (TEMPLATEPATH . '/author/seo-description-author_v2.php'); ?> 
<!--<div align="justify" class="ad3-slider-v2">-->
<div id="top_slide_one">
<?php require_once(TEMPLATEPATH."/sidebar/random_output.php");
$random = new random_output();
$random->getRand(1); ?>

<!--/Ad-3-slider--> 
</div>
<?php } ?>