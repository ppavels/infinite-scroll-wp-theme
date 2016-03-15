<div class="ad-2"></div>
<!--Ad-3-slider-->
<?php include (TEMPLATEPATH . '/page/about.php'); ?> 
<!--<div align="justify" class="ad3-slider-v2">-->
<div id="top_slide_one" style="width: 300px;float: left;margin-top: 20px; ">
<?php require_once(TEMPLATEPATH."/sidebar/random_output.php");
$random = new random_output();
$random->getRand(1);
?>

<?php require_once(TEMPLATEPATH."/sidebar/blocks/google_ads_1.php"); 
require_once(TEMPLATEPATH."/sidebar/blocks/submitform.php"); ?>
</div>
