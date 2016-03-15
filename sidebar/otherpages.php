<?php require_once(TEMPLATEPATH . "/sidebar/blocks/google_ads_1.php"); ?>
<?php if (is_author()) {
    require_once(TEMPLATEPATH . "/sidebar/blocks/submitform.php");
} ?>


<?php
$cat = new Category();

wp_reset_query();
$page = get_page_by_title('Free Samples');
$portfolio = get_page_by_title('Free Samples');
$my_wp_query = query_posts(array('post_type' => 'page', 'post_parent' => $portfolio->ID));
$arr[] = 'Free Samples';
if (have_posts()) {
    while (have_posts()) {
        the_post();
        global $post;
        $arr[] .= $post->post_title;
    }
} else {
    
}
wp_reset_query();
$stop = '';
if (is_page($arr)) $stop = '_stop';
?>
<div id="top_slide<?php echo $stop; ?>">

    <?php
    if (is_page($arr)) {
        require_once(TEMPLATEPATH . "/sidebar/free_samples_bar.php");
        $samples_list = new free_samples_bar();
        $samples_list->getSamplesList();
        ?>
    <?php } ?>
    <?php
    if (!is_author()) {
        require_once(TEMPLATEPATH . "/sidebar/random_output.php");

        $random = new random_output();
        if (!is_page($arr)) {

            $random->getRand();
        }
    }
    ?>
</div>
