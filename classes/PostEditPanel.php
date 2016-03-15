<?php

class PostEditPanel
{
    public $arr_key, $meta_boxes, $elements, $devices;
    private $coupon_style, $contest_style;

    function __construct($args = array())
    {
        $this->elements = new HTMLElements;
        $this->arr_key = "Post-settings";

        $this->meta_boxes = array(

            "post-type" => array(
                "name" => "post-type",
                "title" => "Post Format",
                "description" => "Select post type.",
                "option" => array('contests', 'coupon', 'free-samples', 'blog', 'sales', 'rewards')),

            "coupon-type" => array(
                "name" => "coupon-type",
                "title" => "Coupon Type",
                "description" => "Select coupon type.",
                "option" => array('print', 'mail', 'online')),


            "rewards-type" => array(
                "name" => "rewards-type",
                "title" => "Rewards Payout",
                "description" => "Select rewards type.",
                "option" => array('gift cards', 'prizes', 'cash', 'add points', 'freebies', 'cool stuff', 'coupons', 'PayPal')),


            "coupon-save-text" => array(
                "name" => "coupon-save-text",
                "title" => "Save Text"
            ),
            "coupon-code" => array(
                "name" => "coupon-code",
                "title" => "Coupon Code"
            ),
            "reward-save-text" => array(
                "name" => "reward-save-text",
                "title" => "Reward 1"
            ),
            "reward-code" => array(
                "name" => "reward-code",
                "title" => "Reward 2"
            ),
            "localtext" => array(
                "name" => "localbtntext",
                "title" => "Local link Text"
            ),
            "hypertext" => array(
                "name" => "hypertext",
                "title" => "Hyperlink Text"
            ),
            "hyperlink" => array(
                "name" => "hyperlink",
                "title" => "Hyper Link"
            ),


// metadata
            "meta-data" => array(
                "name" => "meta-data",
                "title" => "Meta Data",
            ),

            "meta-title" => array(
                "name" => "meta-title",
                "title" => "Title",
            ),
            "meta-desc" => array(
                "name" => "meta-desc",
                "title" => "Description",
            ),
            "sidebar-title" => array(
                "name" => "sidebar-title",
                "title" => "Sidebar Title",
            ),
            "title-tag" => array(
                "name" => "page-title-tag",
                "title" => "Title Tag",
            ),
            "h1_title" => array(
                "name" => "page-h1-title",
                "title" => "H1 Title",
            ),
            "h2_title" => array(
                "name" => "page-h2-title",
                "title" => "H2 Title",
            ),
            "page-description" => array(
                "name" => "page-description",
                "title" => "Page Description",
            ),
            "page-meta-description" => array(
                "name" => "page-meta-description",
                "title" => "Meta Description",
            ),

            "expired-date" => array(
                "name" => "expired-date",
                "title" => "Set Date",
                "option" => array('date', 'display')
            ),
            "newsfeed" => array(
                "name" => "firstnotdisplay",
                "title" => "Hide from the first page"
            ),

            "contest-prize-value" => array(
                "name" => "prize-value",
                "title" => "Prize Value",

            ),
            "contest-privacy-policy" => array(
                "name" => "privacy-policy",
                "title" => "Privacy Policy",

            ),
            "contest-terms-and-conditions" => array(
                "name" => "terms-and-conditions",
                "title" => "Terms and Conditions",
            ),
            "contest-entry-frequency" => array(
                "name" => "entry-frequency",
                "title" => "Entry Frequency",
                "option" => array('daily', 'weekly', 'monthly', 'unlimited', 'instant-win', 'hourly')
            ),

            "contest-entry-type" => array(
                "name" => "entry-type",
                "title" => "Entry Type",
                "option" => array('facebook', 'raffle-copter', 'blogs', 'twitter', 'pinterest', 'download', 'mobile', 'other', 'creative-entry')
            ),
            "mobile-friendly" => array(
                "name" => "mobile-friendly",
                "title" => "Mobile Friendly"
            ),

            "draw-date" => array(
                "name" => "draw-date",
                "title" => "Draw Date"
            ),

            "restrictions" => array(
                "name" => "restrictions",
                "title" => "Restrictions"
            ),
            "exclusive" => array(
                "name" => "is-exclusive",
                "title" => "Exclusive"
            ),
            "sticky" => array(
                "name" => "is-sticky",
                "title" => "Sticky Free Sample"
            ),
            "top_post" => array(
                "name" => "top_post",
                "title" => "Top Post"
            ),

//adding devices
            "top_post" => array(
                "name" => "devices-targeting",
                "title" => "Devices Targeting"
            ),

        );

        $this->devices = array(
            array('title' => 'Desktop', 'name' => 'desktop'),
            array('title' => 'Tablet App', 'name' => 'tablet'),
            array('title' => 'Tablet Web', 'name' => 'tablet_web'),//new
            array('title' => 'Android App', 'name' => 'android'),
            array('title' => 'Android Web', 'name' => 'android_web'),//new
            array('title' => 'Other Mobile Platforms', 'name' => 'mobile'),
            array('title' => 'iPhone App', 'name' => 'iphone'),
            array('title' => 'iPhone Web', 'name' => 'iphone_web'),//new
            array('title' => 'iPad App', 'name' => 'ipad'),
            array('title' => 'iPad Web', 'name' => 'ipad_web'),//new
            array('title' => 'BlackBerry', 'name' => 'blackberry'),
        );

        add_action('add_meta_boxes', array($this, 'create_meta_box'));
        add_action('admin_menu', array($this, 'create_meta_box'));
        add_action('save_post', array($this, 'save_meta_box'));

    }

    public function create_meta_box()
    {


        if (function_exists('add_meta_box')) {
            global $post;
            $data = get_post_meta($post->ID, $this->arr_key, true);
//echo "<pre>".print_r($data, TRUE)."</pre>";


            add_meta_box('postformat-meta-boxes', ucfirst($arr_key) . 'Post Format', array($this, 'display_postformat_meta_box'), 'post', 'side', 'high');
            add_meta_box('postsettings-meta-boxes', ucfirst($arr_key) . 'Post Settings', array($this, 'display_postsettings_meta_box'), 'post', 'normal', 'high');
            add_meta_box('pagesettings-meta-boxes', ucfirst($arr_key) . 'Page Settings', array($this, 'display_pagesettings_meta_box'), 'page', 'normal', 'high');

            add_meta_box('contests-format-meta-boxes', ucfirst($arr_key) . 'Contests Options', array($this, 'display_contest_meta_box'), 'post', 'normal');
            add_meta_box('rewards-format-meta-boxes', ucfirst($arr_key) . 'Rewards Options', array($this, 'display_rewards_meta_box'), 'post', 'normal');


            add_meta_box('coupons-format-meta-boxes', ucfirst($arr_key) . 'Coupons Options', array($this, 'display_coupon_meta_box'), 'post', 'normal');


        }


    }

    public function display_postformat_meta_box()
    {

        global $post; ?>
        <div class="form-wrap">
            <h4>Post Format</h4>
        </div>
        <?php
        wp_nonce_field(plugin_basename(__FILE__), $this->arr_key . '_wpnonce', false, true);
        $meta_post_type = $this->get_custom_post_meta('post-type');
        $meta_coupon_type = $this->get_custom_post_meta('coupon-type');
        $itest = 0;
        foreach ($this->meta_boxes as $meta_box) {
            $data = get_post_meta($post->ID, $this->arr_key, true);
            if (!$meta_post_type) {
                $data['post-type'] = $this->meta_boxes['post-type']['option'][0];

                $this->coupon_style = ' style="display:none" ';

            }
            if ($data['post-type'] == $this->meta_boxes['post-type']['option'][0]) {
                $data['coupon-save-text'] = "";
                $data['coupon-code'] = "";
                $data['reward-save-text'] = "";
                $data['reward-code'] = "";
                $data['coupon-type'] = "";
                $data['rewards-type'] = "";
                $this->coupon_style = ' style="display:none" ';
            } else if ($data['post-type'] == $this->meta_boxes['post-type']['option'][1]) {
                $this->contest_style = ' style="display:none" ';

            } else if ($data['post-type'] == $this->meta_boxes['post-type']['option'][2]) {
                $data['coupon-save-text'] = "";
                $data['coupon-code'] = "";
                $data['reward-save-text'] = "";
                $data['reward-code'] = "";
                $data['coupon-type'] = "";
                $data['rewards-type'] = "";
                $this->coupon_style = ' style="display:none" ';
                $this->contest_style = ' style="display:none" ';
            }
            if ($itest == 0) {
                //echo "<pre>".print_r($data, TRUE)."</pre>";
            }


            if ($meta_box['name'] == 'post-type') { ?>

                <ul>
                <?php foreach ($this->meta_boxes['post-type']['option'] as $option) { ?>
                    <?php
                    if ($option == $this->meta_boxes['post-type']['option'][0]) {
                        $func = "onClick=showContests();";
                    } else if ($option == $this->meta_boxes['post-type']['option'][1]) {
                        $func = "onClick=showCoupon();";
                    } else if ($option == $this->meta_boxes['post-type']['option'][2]) {
                        $func = " ";
                        $func = "onClick=hideAll();";
                    } else if ($option == $this->meta_boxes['post-type']['option'][3]) {
                        $func = " ";
                        $func = "onClick=hideAll();";

                    } else if ($option == $this->meta_boxes['post-type']['option'][4]) {
                        $func = " ";
                        $func = "onClick=hideAll();";

                    } else if ($option == $this->meta_boxes['post-type']['option'][5]) {
                        $func = " ";
                        $func = "onClick=showRewards();";

                    }
                    if ($option == $data['post-type']) {

                        $checked = ' checked="checked" ';
                    } else {
                        $checked = " ";
                    }
                    $title = ucwords(str_replace('-', ' ', $option));
                    ?>
                    <li><label for="<?php echo $option; ?>">
                            <input <?php echo $func; ?> type="radio" name="<?php echo $meta_box['name']; ?>"
                                                        id="<?php echo $option; ?>"
                                                        value="<?php echo htmlspecialchars($option); ?>" <?php echo $checked; ?> />
                            <?php echo $title; ?>
                        </label></li>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        </ul>
    <?php } //function's end

    public function testOfClassHTMLElement()
    {
        $element = 'input';
        $attributes = array('type' => 'text', 'id' => 'test', 'class' => 'noclass cool');
        $this->elements->getElement($element, $attributes);


    }

    public function display_rewards_meta_box()
    {
        global $post;
        wp_nonce_field(plugin_basename(__FILE__), $this->arr_key . '_wpnonce', false, true);
        $meta_post_type = $this->get_custom_post_meta('post-type');
        $meta_coupon_type = $this->get_custom_post_meta('rewards-type');
        $itest = 0;
        foreach ($this->meta_boxes as $meta_box) {
            $data = get_post_meta($post->ID, $this->arr_key, true);

            ?>
            <table>

            <?php
            if ($meta_box['name'] == 'rewards-type') { ?>

                <tr>
                    <td colspan="2"><h4>Rewards</h4></td>
                </tr>
                <?php foreach ($this->meta_boxes['rewards-type']['option'] as $option) {

                    ?>

                    <tr>
                    <td style="width:135px"><label for="<?php
                        echo $option; ?>">
                            <?php echo ucfirst($option); ?>
                        </label></td>
                    <td>
                        <input id="<?php
                        echo $option; ?>" type="checkbox" <?php
                        echo $checked[$option]; ?>  name="<?php
                        echo $meta_box['name']; ?>[<?php
                        echo $option; ?>]" value="<?php
                        echo $option; ?>" <?php
                        if (!empty($data['rewards-type'][$option])) {
                            echo($data['rewards-type'][$option] == $option ? ' checked="checked" ' : ' ');
                        } ?> /></td>

                    <?php
                    if (!empty($data['rewards-type'][$option])) {
                        if ($data['rewards-type'][$option] == $option) {
                            $this->update_custom_fields('rewards-type', $option, TRUE);
                        }
                    }
                }
                ?>
                </tr>
            <?php } else if ($meta_box['name'] == 'reward-save-text') { ?>
                <tr>
                    <td style="width:150px"><label>
                            <?php echo $meta_box['title']; ?>
                        </label></td>
                    <td><input style="width:700px" id="<?php echo $meta_box['name']; ?>" class="newtag form-input-tip"
                               type="text" size="16" name="<?php echo $meta_box['name']; ?>"
                               value="<?php echo $data['reward-save-text']; ?>"/>
                    </td>
                </tr>
            <?php } else if ($meta_box['name'] == 'reward-code') { ?>
                <tr>
                <tr>
                    <td style="width:150px"><label><?php echo $meta_box['title']; ?>
                        </label></td>
                    <td><input style="width:700px" id="<?php echo $meta_box['name']; ?>" class="newtag form-input-tip"
                               type="text" size="16" name="<?php echo $meta_box['name']; ?>"
                               value="<?php echo $data['reward-code']; ?>"/>
                    </td>
                </tr>
            <?php } else if ($meta_box['name'] == 'reward-save-text') { ?>
                <tr>
                <tr>
                    <td style="width:150px"><label><?php echo $meta_box['title']; ?>
                        </label></td>
                    <td><input style="width:700px" id="<?php echo $meta_box['name']; ?>" class="newtag form-input-tip"
                               type="text" size="16" name="<?php echo $meta_box['name']; ?>"
                               value="<?php echo $data['reward-save-text']; ?>"/>
                    </td>
                </tr>


            <?php } ?>






        <?php } //foreach
        ?>
        </table>
    <?php }


    public function display_coupon_meta_box()
    {
        global $post;
        wp_nonce_field(plugin_basename(__FILE__), $this->arr_key . '_wpnonce', false, true);
        $meta_post_type = $this->get_custom_post_meta('post-type');
        $meta_coupon_type = $this->get_custom_post_meta('coupon-type');
        $itest = 0;
        foreach ($this->meta_boxes as $meta_box) {
            $data = get_post_meta($post->ID, $this->arr_key, true);

            ?>
            <table>

            <?php
            if ($meta_box['name'] == 'coupon-type') { ?>

                <tr>
                    <td colspan="2"><h4>Coupon Type</h4></td>
                </tr>
                <?php foreach ($this->meta_boxes['coupon-type']['option'] as $option) {

                    ?>

                    <tr>
                    <td style="width:135px"><label for="<?php
                        echo $option; ?>">
                            <?php echo ucfirst($option); ?>
                        </label></td>
                    <td>
                        <input id="<?php
                        echo $option; ?>" type="checkbox" <?php
                        echo $checked[$option]; ?>  name="<?php
                        echo $meta_box['name']; ?>[<?php
                        echo $option; ?>]" value="<?php
                        echo $option; ?>" <?php
                        if (!empty($data['coupon-type'][$option])) {
                            echo($data['coupon-type'][$option] == $option ? ' checked="checked" ' : ' ');
                        } ?> /></td>

                    <?php
                    if (!empty($data['coupon-type'][$option])) {
                        if ($data['coupon-type'][$option] == $option) {
                            $this->update_custom_fields('coupon-type', $option, TRUE);
                        }
                    }
                }
                ?>
                </tr>
            <?php } else if ($meta_box['name'] == 'coupon-save-text') { ?>
                <tr>
                    <td style="width:150px"><label>
                            <?php echo $meta_box['title']; ?>
                        </label></td>
                    <td><input style="width:700px" id="<?php echo $meta_box['name']; ?>" class="newtag form-input-tip"
                               type="text" size="16" name="<?php echo $meta_box['name']; ?>"
                               value="<?php echo $data['coupon-save-text']; ?>"/>
                    </td>
                </tr>
            <?php } else if ($meta_box['name'] == 'coupon-code') { ?>
                <tr>
                <tr>
                    <td style="width:150px"><label><?php echo $meta_box['title']; ?>
                        </label></td>
                    <td><input style="width:700px" id="<?php echo $meta_box['name']; ?>" class="newtag form-input-tip"
                               type="text" size="16" name="<?php echo $meta_box['name']; ?>"
                               value="<?php echo $data['coupon-code']; ?>"/>
                    </td>
                </tr>
            <?php } else if ($meta_box['name'] == 'coupon-save-text') { ?>
                <tr>
                <tr>
                    <td style="width:150px"><label><?php echo $meta_box['title']; ?>
                        </label></td>
                    <td><input style="width:700px" id="<?php echo $meta_box['name']; ?>" class="newtag form-input-tip"
                               type="text" size="16" name="<?php echo $meta_box['name']; ?>"
                               value="<?php echo $data['coupon-save-text']; ?>"/>
                    </td>
                </tr>


            <?php } ?>






        <?php } //foreach
        ?>
        </table>
    <?php }


    public function display_contest_meta_box()
    {
        global $post; ?>

        <?php
        wp_nonce_field(plugin_basename(__FILE__), $this->arr_key . '_wpnonce', false, true);
        $meta_post_type = $this->get_custom_post_meta('post-type');
        $meta_coupon_type = $this->get_custom_post_meta('coupon-type');
        $itest = 0;///////////
///////
        ?>
        <table>
            <?php
            $itest = 0;
            foreach ($this->meta_boxes as $meta_box) {


                $data = get_post_meta($post->ID, $this->arr_key, true);
                if ($itest == 0) {
                    //echo "<pre>".print_r($data, TRUE)."</pre>";
                }

                //echo "<pre>".print_r($meta_box, TRUE)."</pre>";

                if ($meta_box['name'] == 'prize-value') { ?>
                    <tr>
                        <td><label class='contest-value' style=" margin-right:10px"
                                   for="<?php echo $meta_box['name']; ?>"><?php echo $meta_box['title']; ?></label></td>
                        <td colspan="9">$<input size="20" type="text" id="<?php echo $meta_box['name']; ?>"
                                                name="<?php echo $meta_box['name']; ?>"
                                                value="<?php echo $data[$meta_box['name']]?>"/></td>
                    </tr>
                    <?php
                    $this->checkDate();

                }
                if ($meta_box['name'] == 'privacy-policy') { ?>
                    <tr>
                        <td><label class='contest-value' style=" margin-right:10px"
                                   for="<?php echo $meta_box['name']; ?>"><?php echo $meta_box['title']; ?></label></td>
                        <td colspan="9"><input style="width:330px; margin-left:7px" size="20" type="text"
                                               id="<?php echo $meta_box['name']; ?>"
                                               name="<?php echo $meta_box['name']; ?>"
                                               value="<?php echo $data[$meta_box['name']]?>"/></td>
                    </tr>
                <?php }
                if ($meta_box['name'] == 'terms-and-conditions') { ?>
                    <tr>
                        <td><label class='contest-value' style=" margin-right:10px"
                                   for="<?php echo $meta_box['name']; ?>"><?php echo $meta_box['title']; ?></label></td>
                        <td colspan="9"><input style="width:330px; margin-left:7px" size="20" type="text"
                                               id="<?php echo $meta_box['name']; ?>"
                                               name="<?php echo $meta_box['name']; ?>"
                                               value="<?php echo $data[$meta_box['name']]?>"/></td>
                    </tr>
                <?php }

                if ($meta_box['name'] == 'entry-frequency') { ?>
                    <tr>
                        <td><?php echo $meta_box['title']; ?></td>
                        <?php foreach ($this->meta_boxes['contest-entry-frequency']['option'] as $option) { ?>
                            <td><label for="<?php echo $option; ?>">
                                    <input type="radio" name="<?php echo $meta_box['name'] ?>"
                                           id="<?php echo $option; ?>"
                                           value="<?php echo htmlspecialchars($option); ?>" <?php echo($data[$meta_box['name']] == $option ? ' checked="checked" ' : ' ') ?> />
                                    <?php echo ucfirst($option); ?>
                                </label></td>
                        <?php } ?>
                    </tr>
                <?php }
//this is radio button
                if ($meta_box['name'] == 'entry-type') { ?>
                    <tr>
                        <td><?php echo $meta_box['title']; ?></td>
                        <?php foreach ($this->meta_boxes['contest-entry-type']['option'] as $option) {
                            if (!empty($checked[$option])) {

                                $checked_option = $checked[$option];
                            }

                            if (!empty($data[$meta_box['name']][$option])) {

                                $name_option = $data[$meta_box['name']][$option];
                            }


                            ?>
                            <td><input class="<?php echo $meta_box['name']; ?>" id="<?php echo $option; ?>"
                                       type="checkbox" <?php echo $checked_option; ?>
                                       name="<?php echo $meta_box['name']; ?>[<?php echo $option; ?>]"
                                       value="<?php echo $option; ?>" <?php echo($name_option == $option ? ' checked="checked" ' : ' ') ?> />
                                <label style=" margin-right:1px" for="<?php echo $option; ?>">
                                    <?php echo ucfirst($option); ?>
                                </label></td>
                        <?php } ?>
                    </tr>
                <?php }

                if ($meta_box['name'] == 'mobile-friendly') { ?>
                    <tr>
                        <td><label style=" margin-right:1px" for="<?php echo $meta_box['name']; ?>">
                                <?php echo $meta_box['title']; ?>
                            </label></td>
                        <td colspan="9"><input id="<?php echo $meta_box['name']; ?>"
                                               type="checkbox" <?php /*echo $checked[$option];*/ ?>
                                               name="<?php echo $meta_box['name']; ?>"
                                               value="<?php echo $meta_box['name']; ?>" <?php echo($data[$meta_box['name']] == $meta_box['name'] ? ' checked="checked" ' : ' ') ?> />
                        </td>

                        <?php ?>
                        <?php

                        if ($data[$meta_box['name']] == $meta_box['name']) {
                            $this->update_custom_fields('mobile-friendly', 'yes');
                            update_post_meta($post->ID, 'mobile-friendly', 'yes');
                        } else {
                            update_post_meta($post->ID, 'mobile-friendly', 'no');
                            $this->update_custom_fields('mobile-friendly');

                        } ?>
                    </tr>
                <?php }

                if ($meta_box['name'] == 'draw-date') { ?>
                    <tr>
                        <td><label class='contest-value' style=" margin-right:10px"
                                   for="<?php echo $meta_box['name']; ?>"><?php echo $meta_box['title']; ?></label></td>
                        <td colspan="9"><input style="margin-left:7px" size="20" type="text"
                                               id="<?php echo $meta_box['name']; ?>"
                                               name="<?php echo $meta_box['name']; ?>"
                                               value="<?php echo $data[$meta_box['name']]?>"/></td>
                    </tr>
                <?php }

                if ($meta_box['name'] == 'restrictions') { ?>
                    <tr>
                        <td><label class='contest-text' style=" margin-right:10px"
                                   for="<?php echo $meta_box['name']; ?>"><?php echo $meta_box['title']; ?></label></td>
                        <td colspan="9"><textarea style="margin-left:7px; width:700px; height:100px" cols="30"
                                                  id="<?php echo $meta_box['name']; ?>"
                                                  name="<?php echo $meta_box['name']; ?>"/><?php echo $data[$meta_box['name']]?></textarea>
                        </td>
                    </tr>
                <?php }


                $itest++;
            }//foreach
            ?>
        </table>
    <?php
    }


    public function get_custom_post_meta($meta_name = null, $post_id = NULL, $single = TRUE)
    {

        if (empty($post_id)) {
            global $post;
            $post_id = $post->ID;
        }

        $data = get_post_meta($post_id, $this->arr_key, $single);
        if (!$meta_name) {
            $output = $data;
        } else {
            $output = $data[$meta_name];
        }
        return $output;
    }

    public function checkDate()
    {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array( //'paged' => $paged,

            'meta_query' => array(
                array(
                    'key' => 'expired-date',

                )
            )
        );
//$query = new WP_Query( 'meta_key=expired-date' );  
//$arhivequery = new WP_Query($args); 
        ?><!--<pre>--><?php // print_r(query_posts($args));
        ?><!--</pre>--><?php
    }


    public function update_custom_fields($opt_name, $opt_value = NULL, $add = FALSE)
    {
        global $post;
        if (!empty($opt_name) && !empty($opt_value) && current_user_can('edit_post', $post->ID)) {
            if (!$add) {
                update_post_meta($post->ID, $opt_name, $opt_value);
            } else {
                add_post_meta($post->ID, $opt_name, $opt_value);
            }
        } else {
            delete_post_meta($post->ID, $opt_name);
        }
    }

    public function display_pagesettings_meta_box()
    {
        global $post;
        wp_nonce_field(plugin_basename(__FILE__), $this->arr_key . '_wpnonce', false, true);

        $itest = 0;
        foreach ($this->meta_boxes as $meta_box) {
            $data = get_post_meta($post->ID, $this->arr_key, true);
            if ($itest == 0) {
                //echo "<pre>".print_r($data, TRUE)."</pre>";

            }
//echo $this->meta_boxes['post-type']['option'][0];

//echo '<pre>'. $meta_box[ 'name'] . '</pre>';
            ?>

            <table>

            <?php if ($meta_box['name'] == 'sidebar-title') { ?>

                <tr>
                    <td style="width:150px">
                        <label for="<?php echo $meta_box['name']; ?>">

                            <?php echo $meta_box['title']; ?>
                        </label>
                    </td>
                    <td><input style="width:700px" id="sidebar_title" type="text" size="29"
                               name="<?php echo $meta_box['name']; ?>" value="<?php echo $data[$meta_box['name']]; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><p class="description countdown sidebar"></p></td>
                </tr>
            <?php }
            if ($meta_box['name'] == 'page-title-tag') { ?>
                <tr>
                    <td colspan="2"><h4>Page Metadata</h4></td>
                </tr>
                <tr>
                    <td style="width:150px">
                        <label for="<?php echo $meta_box['name']; ?>">

                            <?php echo $meta_box['title']; ?>
                        </label>
                    </td>
                    <td><input style="width:700px" id="meta-title" type="text" size="29"
                               name="<?php echo $meta_box['name']; ?>" value="<?php echo $data[$meta_box['name']]; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><p class="description countdown title"></p></td>
                </tr>
            <?php }
            if ($meta_box['name'] == 'page-h1-title') { ?>
                <tr>
                    <td style="width:150px">
                        <label for="<?php echo $meta_box['name']; ?>">
                            <?php echo $meta_box['title']; ?>
                        </label>
                    </td>
                    <td><input style="width:700px" id="<?php echo $meta_box['name']; ?>" type="text" size="29"
                               name="<?php echo $meta_box['name']; ?>" value="<?php echo $data[$meta_box['name']]; ?>"/>
                    </td>
                </tr>
            <?php }
            if ($meta_box['name'] == 'page-h2-title') { ?>
                <tr>
                    <td style="width:150px">
                        <label for="<?php echo $meta_box['name']; ?>">
                            <?php echo $meta_box['title']; ?>
                        </label>
                    </td>
                    <td><input style="width:700px" id="<?php echo $meta_box['name']; ?>" type="text" size="29"
                               name="<?php echo $meta_box['name']; ?>" value="<?php echo $data[$meta_box['name']]; ?>"/>
                    </td>
                </tr>
            <?php }
            if ($meta_box['name'] == 'page-description') { ?>
                <tr>
                    <td style="width:150px">
                        <label for="<?php echo $meta_box['name']; ?>">
                            <?php echo $meta_box['title']; ?>
                        </label>
                    </td>
                    <td><textarea style="width:700px" id="<?php echo $meta_box['name']; ?>" type="text" size="29"
                                  name="<?php echo $meta_box['name']; ?>"><?php echo $data[$meta_box['name']]; ?></textarea>
                    </td>
                </tr>

            <?php }
            if ($meta_box['name'] == 'page-meta-description') { ?>
                <tr>
                    <td style="width:150px">
                        <label for="<?php echo $meta_box['name']; ?>">
                            <?php echo $meta_box['title']; ?>
                        </label>
                    </td>
                    <td><textarea style="width:700px" id="meta-desc" type="text" size="29"
                                  name="<?php echo $meta_box['name']; ?>"><?php echo $data[$meta_box['name']]; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><p class="description countdown desc"></p></td>
                </tr>
            <?php } ?>
            <?php $itest++;
        } ?>
        </table>
    <?php } //function's end

    public function display_postsettings_meta_box()
    {
        global $post;
        wp_nonce_field(plugin_basename(__FILE__), $this->arr_key . '_wpnonce', false, true);
        $meta_post_type = $this->get_custom_post_meta('post-type');
        $meta_coupon_type = $this->get_custom_post_meta('coupon-type');
        $itest = 0;
        foreach ($this->meta_boxes as $meta_box) {
            $data = get_post_meta($post->ID, $this->arr_key, true);
            if ($itest == 0) {
//echo "<pre>".print_r($data, TRUE)."</pre>";
            }
//echo $this->meta_boxes['post-type']['option'][0];
//echo '<pre>'. $meta_box[ 'name'] . '</pre>';
            ?>

            <table>

            <?php if ($meta_box['name'] == 'localbtntext') { ?>

                <tr>
                    <td style="width:150px">
                        <label><?php echo $meta_box['title']; ?></label></td>
                    <td><input style="width:700px" id="<?php echo $meta_box['name']; ?>" type="text" size="29"
                               name="<?php echo $meta_box['name']; ?>" value="<?php echo $data[$meta_box['name']]; ?>"/>
                    </td>
                </tr>
            <?php } else if ($meta_box['name'] == 'hypertext') { ?>

                <tr>
                    <td style="width:150px">
                        <label><?php echo $meta_box['title']; ?></label></td>
                    <td><input style="width:700px" id="<?php echo $meta_box['name']; ?>" type="text" size="29"
                               name="<?php echo $meta_box['name']; ?>" value="<?php echo $data[$meta_box['name']]; ?>"/>
                    </td>
                </tr>
            <?php } else if ($meta_box['name'] == 'hyperlink') { ?>
                <tr>
                    <td style="width:150px">
                        <label><?php echo $meta_box['title']; ?></label></td>
                    <td><input style="width:700px" id="<?php echo $meta_box['name']; ?>" type="text" size="29"
                               name="<?php echo $meta_box['name']; ?>" value="<?php echo $data[$meta_box['name']]; ?>"/>
                    </td>
                </tr>

            <?php } else if ($meta_box['name'] == 'expired-date') { ?>

                <tr>
                    <td colspan="2"><h4>Expiration Date</h4></td>
                </tr>

                <tr>
                    <?php foreach ($this->meta_boxes['expired-date']['option'] as $option) { ?>

                        <?php
                        if ($option == $this->meta_boxes['expired-date']['option'][0]) {
                            $inputytpe = "text";
                            $title = $meta_box['title'];
                            $style = "";
                            $id = $meta_box['name'];
                            $size = 'size="16"';
                            if (!empty($data['expired-date']['date'])) {
                                $value = $data['expired-date']['date'];
                                $this->update_custom_fields('expired-date', $value);
                            }
                        } else {
                            $inputytpe = "checkbox";
                            //$title=ucfirst($option);
                            $title = "";
                            $style = " style='margin-left:5px; display:none'";
                            $id = $option;
                            $size = "";
                            $value = $option;
                        }
                        if (!empty($data['expired-date'][$option])) {
                            $exp_date = $data['expired-date'][$option];
                        } else {
                            $exp_date = '';
                        }
                        ?>
                        <td><label for="<?php echo $id; ?>">
                                <?php echo $title; ?>
                            </label>
                            <input <?php echo $style; ?> style="margin-left: 90px;" id="<?php echo $id; ?>"
                                                         type="<?php echo $inputytpe; ?>"   <?php echo $size; ?>
                                                         name="<?php echo $meta_box['name']; ?>[<?php echo $option; ?>]"
                                                         value="<?php echo $value; ?>" <?php echo($exp_date == $option ? ' checked="checked" ' : ' ') ?>  />
                        </td>

                    <?php } ?>
                    <?php if ($meta_box['option'] == 'display') { ?>
                        <td><input id="<?php echo $meta_box['name']; ?>" type="checkbox"
                                   name="<?php echo $meta_box['name']; ?>"
                                   value="<?php echo $meta_box['name']; ?>" <?php echo($data[$meta_box['name']] == $meta_box['name'] ? ' checked="checked" ' : ' ') ?> />
                            <label>
                                <?php echo $meta_box['title']; ?>
                            </label></td>
                    <?php } ?>

                    </td></tr>



            <?php }
            if ($meta_box['name'] == 'meta-data') { ?>
                <tr>
                    <td colspan="2"><h4>Meta data</h4></td>
                </tr>
            <?php }
            if ($meta_box['name'] == 'meta-title') { ?>
                <tr>
                    <td style="width:150px">
                        <label><?php echo $meta_box['title']; ?>
                        </label></td>
                    <td><input style="width:700px" class="<?php echo $meta_box['name']; ?>"
                               id="<?php echo $meta_box['name']; ?>" type="text" size="29"
                               name="<?php echo $meta_box['name']; ?>" value="<?php echo $data[$meta_box['name']]; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><p class="description countdown title"></p></td>
                </tr>
            <?php }
            if ($meta_box['name'] == 'meta-desc') {
                ?>
                <tr>
                    <td style="width:150px">
                        <label><?php echo $meta_box['title']; ?>
                        </label></td>
                    <td><textarea style="width:700px" id="<?php echo $meta_box['name']; ?>" type="text" size="29"
                                  name="<?php echo $meta_box['name']; ?>"/><?php echo $data[$meta_box['name']]; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><p class="description countdown desc"></p></td>
                </tr>
            <?php }
            if ($meta_box['name'] == 'firstnotdisplay') { ?>
                <tr>
                    <td style="width:137px; margin-top:15px">
                        <label style=" margin-right:10px" for="<?php echo $meta_box['name']; ?>">
                            <?php echo $meta_box['title']; ?>
                        </label></td>
                    <td><input id="<?php echo $meta_box['name']; ?>"
                               type="checkbox" <?php /*echo $checked[$option];*/ ?>
                               name="<?php echo $meta_box['name']; ?>" value="<?php echo $meta_box['name']; ?>"
                            <?php echo($data[$meta_box['name']] == $meta_box['name'] ? ' checked="checked" ' : ' ') ?> />
                    </td>
                </tr>
                <?php if ($data[$meta_box['name']] == $meta_box['name']) {
                    update_post_meta($post->ID, 'visibility', $meta_box['name']);
                } else {
                    update_post_meta($post->ID, 'visibility', 'firstdisplay');
                } ?>


            <?php }
            if ($meta_box['name'] == 'is-exclusive') { ?>

                <tr>
                    <td style="width:137px; margin-top:15px">
                        <label style=" margin-right:10px" for="<?php echo $meta_box['name']; ?>">
                            <?php echo $meta_box['title']; ?>
                        </label></td>
                    <td><input id="<?php echo $meta_box['name']; ?>" type="checkbox"
                               name="<?php echo $meta_box['name']; ?>" value="<?php echo $meta_box['name']; ?>"
                            <?php echo($data[$meta_box['name']] == $meta_box['name'] ? ' checked="checked" ' : ' ') ?> />
                    </td>
                </tr>

            <?php }
            if ($meta_box['name'] == 'top_post') { ?>

                <tr>
                    <td style="width:137px; margin-top:15px">
                        <label style=" margin-right:10px" for="<?php echo $meta_box['name']; ?>">
                            <?php echo $meta_box['title']; ?>
                        </label></td>
                    <td><input id="<?php echo $meta_box['name']; ?>" type="checkbox"
                               name="<?php echo $meta_box['name']; ?>" value="<?php echo $meta_box['name']; ?>"
                            <?php echo($data[$meta_box['name']] == $meta_box['name'] ? ' checked="checked" ' : ' ') ?> />
                    </td>
                </tr>

                <?php ?>




            <?php }
            if ($meta_box['name'] == 'is-sticky') { ?>

                <tr>
                    <td style="width:137px; margin-top:15px">
                        <label style=" margin-right:10px" for="<?php echo $meta_box['name']; ?>">
                            <?php echo $meta_box['title']; ?>
                        </label></td>
                    <td><input id="<?php echo $meta_box['name']; ?>" type="checkbox"
                               name="<?php echo $meta_box['name']; ?>" value="<?php echo $meta_box['name']; ?>"
                            <?php echo($data[$meta_box['name']] == $meta_box['name'] ? ' checked="checked" ' : ' ') ?> />
                    </td>
                </tr>

            <?php }
            if ($meta_box['name'] == 'devices-targeting') {
                $this->addDeviceCheckboxes();
            }?>


            <?php $itest++;
        } ?>
        </table>
    <?php } //function's end

    function save_meta_box($post_id)
    {

        global $post;
        $this->saveDevicesTypes($_POST);
        foreach ($this->meta_boxes as $meta_box) {
            $data[$meta_box['name']] = $_POST[$meta_box['name']];


            if (isset($_POST[$meta_box['name']])) {


                $this->update_custom_fields($meta_box['name'], $_POST[$meta_box['name']]);
            } else {
                $this->update_custom_fields($meta_box['name']);
            }

        }

        if (!wp_verify_nonce($_POST[$this->arr_key . '_wpnonce'], plugin_basename(__FILE__)))
            return $post->ID;

        if (!current_user_can('edit_post', $post->ID))
            return $post->ID;

        update_post_meta($post->ID, $this->arr_key, $data);
    }

    private function saveDevicesTypes($params){
        global $post;

        //first we should know if none of checkboxes is checked:
        //in this case that means we targeting all devices and should check them all
        $empty=TRUE;
        foreach ($this->devices as $item){

            if($params[$item['name']]!='display'){

            }
            else{
                $empty=FALSE;
            }
        }
        if($empty){
            foreach ($this->devices as $item){
                update_post_meta($post->ID, $item['name'], 'display');

            }
        } else {

            foreach ($this->devices as $item){//foreach
                //$item['name']
                if(isset($params[$item['name']])){
                    update_post_meta($post->ID, $item['name'], 'display');
                }
                else{
                    update_post_meta($post->ID, $item['name'], 'not_display');
                }
            }//foreach

        }
    }

    private function addDeviceCheckboxes(){
        global $post;
        ?>
        <tr ><td colspan="2"><h4>Devices Targeting</h4></td></tr>
        <?php
        foreach ($this->devices as $item){


            ${$item['name']}= get_post_meta($post->ID, $item['name'], true);
            if(${$item['name']}=='display'){
                ${$item['name'].'_checked'}="checked='checked'";
            }
            else {${$item['name'].'_checked'}="";}

            ?>



            <tr><td><label class='post-value' style="margin-right:10px" for="<?php echo $item['name']; ?>"><?php echo $item['title']; ?></label></td>

                <td>
                    <input  type="checkbox" id="<?php echo $item['name']; ?>" <?php echo ${$item['name'].'_checked'}; ?> name="<?php echo $item['name']; ?>" value="display" />
                    <?php if ($item['title']=='Tablet' || $item['title']=='iPad' || $item['title']=='BlackBerry') {?>
                        <label>(not in use for now)</label>
                    <?php }  else if ($item['name']=='mobile' ) {?>
                        <label>(other than Android or iPhone)</label>
                    <?php } ?>
                </td>
            </tr>

        <?php

        }
    }

}


?>