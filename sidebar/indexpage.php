<?php  require_once(TEMPLATEPATH."/sidebar/blocks/google_ads_1.php"); ?>
<?php  require_once(TEMPLATEPATH."/sidebar/blocks/submitform.php"); ?>
<?php  //require_once(TEMPLATEPATH."/sidebar/blocks/popular_coupons.php"); ?>
<div id="top_slide">
<?php  //require_once(TEMPLATEPATH."/sidebar/blocks/top_coupons.php"); ?>
<?php  //require_once(TEMPLATEPATH."/sidebar/blocks/top_samples.php"); ?>
<?php // require_once(TEMPLATEPATH."/sidebar/blocks/top_blogs.php"); ?>
<?php // require_once(TEMPLATEPATH."/sidebar/blocks/top_contests.php"); ?>
<?php  require_once(TEMPLATEPATH."/sidebar/random_output.php"); 
$random = new random_output();
$random->getRand();
?>
    
    
    <?php /* 
srand((float) microtime() * 10000000);
$input = array(1,2,3,4,5);
$rand_keys = array_rand($input, 2);
//if (($input[$rand_keys[0]]!=$input[$rand_keys[1]])){
if ($input[$rand_keys[0]]==1) require_once(TEMPLATEPATH."/sidebar/blocks/top_samples.php");
if ($input[$rand_keys[0]]==2) require_once(TEMPLATEPATH."/sidebar/blocks/top_coupons.php");
if ($input[$rand_keys[0]]==3) require_once(TEMPLATEPATH."/sidebar/blocks/top_blogs.php");
if ($input[$rand_keys[0]]==4) require_once(TEMPLATEPATH."/sidebar/blocks/top_contests.php");
if ($input[$rand_keys[0]]==5) require_once(TEMPLATEPATH."/sidebar/blocks/top_sales.php");
if ($input[$rand_keys[1]]==1) require_once(TEMPLATEPATH."/sidebar/blocks/top_samples.php");
if ($input[$rand_keys[1]]==2) require_once(TEMPLATEPATH."/sidebar/blocks/top_coupons.php");
if ($input[$rand_keys[1]]==3) require_once(TEMPLATEPATH."/sidebar/blocks/top_blogs.php");
if ($input[$rand_keys[1]]==4) require_once(TEMPLATEPATH."/sidebar/blocks/top_contests.php");
if ($input[$rand_keys[1]]==5) require_once(TEMPLATEPATH."/sidebar/blocks/top_sales.php");
//}
*/
?>
    
    
    

</div>
