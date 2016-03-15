<?php get_header(); ?>
    <div id="col-1">
        <div class="post-heading">
            <h1><?php $themeoptions = new ThemeOptions();
                echo stripslashes($themeoptions->get_theme_settings('homepage_title')); ?></h1>
        </div>
        <?php $themeoptions = new ThemeOptions(); ?>
        <div id='div-gpt-ad-<?php echo stripslashes($themeoptions->get_google_ads('free_loop_channel')); ?>-0'
             style='width:728px; height:90px; margin-bottom:20px; '>
            <?php display_google_ads($placement = 'style_header', $identyfier = 'index') ?>
        </div>
        <div id="index-content">
            <?php

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $today = date('Y, d m');
            $excludeposts = $wpdb->get_col("SELECT  DISTINCT `post_id`
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '" . $today . "', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000");

            $args = array(
                'paged'          => $paged,
                'post__not_in'   => $excludeposts,
                'posts_per_page' => 4,
                'meta_query'     => array('relation' => 'AND',
                    //         array('key' => 'expired-date','value' => date("m/d/Y"),'compare' => '>='),
                    array('key' => 'visibility', 'value' => 'firstnotdisplay', 'compare' => 'NOT LIKE')
                ),

            );
            global $counter;
            $counter = 0;
            $wp_query = new WP_Query($args);
            if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) : $wp_query->the_post();

                global $post, $this_post;
                $key_1_values = '';
                $key_1_values = get_post_meta($post->ID, 'desktop', true);
                if ($key_1_values != 'not_display') {
                    $this_post = new Post();
                    $post_cat = $this_post->getPostMeta('post-type'); ?>


                    <?php include(TEMPLATEPATH . '/index_v2/' . $post_cat . '.php'); ?>



                    <?php
                    if ($counter == 0) {
                        include(TEMPLATEPATH . '/index_v2/google_728_90.php');
                    }
                    $counter++;
                }
            endwhile; ?>
        </div>


        <div id="MainNav">
            <?php next_posts_link('Next') ?>
            <?php /* posts_nav_link('&nbsp;', '<span class="back" title="Back">Back</span>', '<span class="see-more" title="See More">See More</span>'); */ ?>
        </div>

    <?php else : ?>
        <h2>Not Found</h2>
    <?php endif; ?>
    </div>




<?php get_sidebar(); ?>
    <div class="clear"></div>
<?php /* include (TEMPLATEPATH . '/tools/top-brands.php' ); */ ?>
<?php /*include (TEMPLATEPATH . '/tools/social-connect.php' ); */ ?>
<?php get_footer(); ?>