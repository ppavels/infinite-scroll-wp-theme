<script src="<?php bloginfo('template_url'); ?>/js/masonry.pkgd.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_url'); ?>/js/infintescrolling.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_url'); ?>/js/imagesloaded.js" type="text/javascript"></script>

<?php
global $post;
if (is_category('contests') || is_page('Contests')) {
    include (TEMPLATEPATH . '/tools/i_scroll/contests.php');
} else if (is_page() && (get_page($post->post_parent)->post_title=='Contests')) {
    include (TEMPLATEPATH . '/tools/i_scroll/contests.php');
}else if (is_category('coupons') || is_page('Coupons')) {
    include (TEMPLATEPATH . '/tools/i_scroll/coupons.php');
}else if (is_category('sales') || is_page('Sales')) {
    include (TEMPLATEPATH . '/tools/i_scroll/sales.php');
} else if (is_category('free-samples') || is_page('Free Samples')) {
    include (TEMPLATEPATH . '/tools/i_scroll/free-samples.php');
} else if (is_category('rewards') || is_page('Rewards')) {
    include (TEMPLATEPATH . '/tools/i_scroll/rewards.php');
} else if (is_category('blog') || is_page('Blog')) {
    include (TEMPLATEPATH . '/tools/i_scroll/blog.php');
} else if (is_page('brands')) {
    include (TEMPLATEPATH . '/tools/i_scroll/brands.php');
} else if (is_page('exclusive')) {
    include (TEMPLATEPATH . '/tools/i_scroll/exclusive.php');
}
//else if(is_page('Local')){ include (TEMPLATEPATH . '/tools/i_scroll/local.php'); }  
else if (is_author()) {
    include (TEMPLATEPATH . '/tools/i_scroll/author.php');
} else if (is_home()) {
    include (TEMPLATEPATH . '/tools/i_scroll/index.php');
} else if (is_taxonomy('brands')) {
    include (TEMPLATEPATH . '/tools/i_scroll/free-samples.php');
}else{
}
;
?>