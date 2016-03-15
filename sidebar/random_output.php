<?php if(!is_single()) { ?>
<script type='text/javascript' src="<?php bloginfo('template_url'); ?>/js/sidebar_slide.js"></script>
<?php } ?>
<?php

class random_output{
    
public function getRand($count=0){
        
        
srand((float) microtime() * 10000000);
$input = array(1,2,3,4,5);
$rand_keys = array_rand($input, 2);


if ($count==0){
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
}
if ($count==1){
if ($input[$rand_keys[0]]==1) require_once(TEMPLATEPATH."/sidebar/blocks/top_samples.php");
if ($input[$rand_keys[0]]==2) require_once(TEMPLATEPATH."/sidebar/blocks/top_coupons.php");
if ($input[$rand_keys[0]]==3) require_once(TEMPLATEPATH."/sidebar/blocks/top_blogs.php");
if ($input[$rand_keys[0]]==4) require_once(TEMPLATEPATH."/sidebar/blocks/top_contests.php");
if ($input[$rand_keys[0]]==5) require_once(TEMPLATEPATH."/sidebar/blocks/top_sales.php");      
}   


}
    
    
    
}
?>