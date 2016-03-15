<?php

//Defin Directory Separator
!defined('DS') ? define('DS', DIRECTORY_SEPARATOR) : null;
require_once (TEMPLATEPATH . '/tools/custom_login.php'); 
require_once (TEMPLATEPATH . '/tools/user-profile.php'); 
//Automatic Class Loader
function my_autoloader($className) {
if (file_exists(TEMPLATEPATH . DS .'classes' . DS . $className . '.php')){
require_once(TEMPLATEPATH . DS .'classes' . DS . $className . '.php');
}
else{
   //echo TEMPLATEPATH . DS .'classes' . DS . $className . '.php not found.'.PHP_EOL; 
}
}
spl_autoload_register('my_autoloader');

$classcat=new Category();

//Files including if needed
//require_once (TEMPLATEPATH . '/tools/expired.php');


	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"), false);
	   wp_enqueue_script('jquery');
	   
	  
	}
	function wpops_admin_js() {
    
    $url = get_bloginfo('template_url'). '/js/functions.js';
	echo '<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />';
    echo '<script src="http://code.jquery.com/jquery-1.8.2.js"></script>';
    echo '<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>';
    echo '<style>#ui-datepicker-div{font-size:100%}</style>';
	echo '<script type="text/javascript" src="'. $url . '"></script>';
	
	
}
 add_action('admin_head', 'wpops_admin_js'); 
	// Clean up the <head>
	
	function free_init(){
		removeHeadLinks();
		create_pc_db_taxonomies();
		
	}
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
		
    }
	
	
	
function create_pc_db_taxonomies() {
	/*register_taxonomy( 'brands', 'post', array( 'hierarchical' => true, 'label' => __('Brands', 'offers'), 'query_var' => 'brands', 'rewrite' => array( 'slug' => 'brands' ) ) );
	register_taxonomy( 'local', 'post', array( 'hierarchical' => true, 'label' => __('Local', 'offers'), 'query_var' => 'local', 'local' => array( 'slug' => 'local' ) ) );*/
	
	$labels = array(
		'name'              => _x( 'Topics', 'taxonomy general name' ),
		'singular_name'     => _x( 'Topic', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Topics' ),
		'all_items'         => __( 'All Topics' ),
		'parent_item'       => __( 'Parent Topic' ),
		'parent_item_colon' => __( 'Parent Topic:' ),
		'edit_item'         => __( 'Edit Topic' ),
		'update_item'       => __( 'Update Topic' ),
		'add_new_item'      => __( 'Add New Topic' ),
		'new_item_name'     => __( 'New Topic Name' ),
		'menu_name'         => __( 'Topic' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'topics' ),
	);
	register_taxonomy( 'topics', array( 'post' ), $args );
	
	$labels = array(
		'name'              => _x( 'Brands', 'taxonomy general name' ),
		'singular_name'     => _x( 'Brand', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Brands' ),
		'all_items'         => __( 'All Brands' ),
		'parent_item'       => __( 'Parent Brand' ),
		'parent_item_colon' => __( 'Parent Brand:' ),
		'edit_item'         => __( 'Edit Brand' ),
		'update_item'       => __( 'Update Brand' ),
		'add_new_item'      => __( 'Add New Brand' ),
		'new_item_name'     => __( 'New Brand Name' ),
		'menu_name'         => __( 'Brand' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'brands' ),
	);
	register_taxonomy( 'brands', array( 'post' ), $args );
	
	$labels = array(
		'name'              => _x( 'Local', 'taxonomy general name' ),
		'singular_name'     => _x( 'Local', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Local' ),
		'all_items'         => __( 'All Local' ),
		'parent_item'       => __( 'Parent Local' ),
		'parent_item_colon' => __( 'Parent Local:' ),
		'edit_item'         => __( 'Edit Local' ),
		'update_item'       => __( 'Update Local' ),
		'add_new_item'      => __( 'Add New Local' ),
		'new_item_name'     => __( 'New Local Name' ),
		'menu_name'         => __( 'Local' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'local' ),
	);
	
	register_taxonomy( 'local', array( 'post' ), $args );
	
	
	/*register_taxonomy( 'coupons', 'post', array( 'hierarchical' => true, 'label' => __('Coupons', 'offers'), 'query_var' => 'coupons', 'rewrite' => array( 'slug' => 'coupons' ) ) );
	register_taxonomy( 'contests', 'post', array( 'hierarchical' => true, 'label' => __('Contests', 'offers'), 'query_var' => 'contests', 'rewrite' => array( 'slug' => 'contests' ) ) );
	register_taxonomy( 'surveys', 'get_survey', array( 'hierarchical' => true, 'label' => __('Surveys', 'surveys'), 'query_var' => 'surveys', 'rewrite' => array( 'slug' => 'surveys' ) ) );
	register_taxonomy( 'exclusive', 'post', array( 'hierarchical' => false, 'label' => __('Exclusive', 'offers'), 'query_var' => 'exclusive', 'rewrite' => array( 'slug' => 'exclusive' ) ) );*/
}



add_action("wp_ajax_send_advertise_email", "send_advertising_email");
add_action("wp_ajax_nopriv_send_advertise_email", "send_advertising_email"); //must be as well for users that are not logged in.

//adding Theme Settings menu to admin panel
$themeoptions=new ThemeOptions(); 


function send_advertising_email(){
   	foreach ($_POST as $k=>$v){
	$output.="k= ".$k." v= ".$v."\n";
	if ($k=='email') {
		$email=$v;
           if (filter_var($v, FILTER_VALIDATE_EMAIL)){}else{exit("116");};
                }
                
         if ($k=='website') {
             $website=$v;
           if (!(isset ($v)) || ($v=='Company Website*')) exit("117");
        }       
	
        if ($k=='phone') {
            $phone=$v;
        if(!preg_match("/^[0-9]+$/", $v)) exit("118");
        }
        if ($k=='name') {
		$name=$v;
        if (!(isset ($v)) || ($v=='Name*'))exit("119");
        }
        if ($k=='company_name') {
            $company=$v;
        if (!(isset ($v)) || ($v=='Company Name*'))exit("120");
        }
         if ($k=='title') {
            $title=$v;
       // if (!(isset ($v)) || ($v=='Title'))exit("122");
        }
         if ($k=='budget') {
             $budget=$v;
        if (!(isset ($v)) || ($v=='Budget*')){
            exit("121");}
        else {
        
        include(TEMPLATEPATH . DS .'tools'. DS .'sendmail.php');
		 if(function_exists('pavel_zhzhet')){
                  //   $name=$_POST['name'];
                     //echo $name;
		pavel_zhzhet($name, $email,$website,$company,$phone,$budget,$title);
		 }
		 else{
			 
		 }
		  
        };
        }
       
        //else exit("000");
        
        
        }
	/*if(isset($_POST['params'])){
		$formels=unserialize($_POST['params']);
	}*/
	//echo "Elements ".$output; 
	die();
} 


    add_action('init', 'free_init');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
	
	if (class_exists('Images')) {
        new Images(
            array(
                'label' => 'Post Image',
                'id' => 'post-image',
                'post_type' => 'post'
            )
			
        );
		new Images(
            array(
                'label' => 'Facebook Thumbnail',
                'id' => 'facebook-image',
                'post_type' => 'post'
            )
			
        );
		new Images(
            array(
                'label' => 'Pinterest Image',
                'id' => 'pinterest-image',
                'post_type' => 'post'
            )
			
        );
		
		 new Images(
           array(
                'label' => '300x250 Contest First Page Image',
                'id' => 'contestfirstpage-image',
                'post_type' => 'post'
            )
			
        );
		
		new Images(
            array(
                'label' => 'Survey main image (300px x 250px)',
                'id' => 'survey-image',
                'post_type' => 'get_survey'
            )
			
        );
		
		new Images(
            array(
                'label' => 'Survey Panel Logo Icon',
                'id' => 'survey-logo',
                'post_type' => 'get_survey'
            )
			
        );
		
		
		/**/
    }
	
		if (class_exists('PostEditPanel')) {
        new PostEditPanel(
            array(
                'label' => 'Post Type',
                'id' => 'post-cat',
                'post_type' =>'post'
            )
			
        );
		global $post;
		
		}
		
		if (function_exists('add_theme_support'))
	{
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(470, 9999);
		
	}
		if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'contest-thumb', 470, 9999 ); //300 pixels wide (and unlimited height)
	//add_image_size( 'homepage-thumb', 220, 180, true ); //(cropped)
		}
	//short code
	
	function brand_list_shortcode($atts, $content) {
   /*remove_filter('the_excerpt', 'replace_content');
    remove_filter('the_content', 'replace_content');
    global $post;
    global $custom_permalink;
    global $check_content;
    $check_content=get_the_content();
    
    $custom_permalink = get_permalink($post->ID);
    

    if (!isset($_GET['survey'])) {
		
		display_featured_surveys();
        
    } else  {
	  
	    if($_GET['survey']!="all"){
			
			$new_post = get_post($_GET['survey']);
			if($new_post->ID){
				if(!empty($new_post->post_content)){
					
				display_single_survey($new_post, $custom_permalink);
				}
				else{
				display_featured_surveys();
				}
			}
			else{
				display_featured_surveys();
			}
		}
		else{
			display_all_surveys();
		}
        
      
    }
	*/
   // $page_nav=frugal_save_page_nav($id);
    //echo $page_nav;
}

add_shortcode('BRANDS', 'brands_shortcode');	
/*function mason_script() {
    wp_enqueue_script( 'jquery-masonry' );
}
add_action( 'wp_enqueue_scripts', 'mason_script' );
*/




function excerpt_count_js(){
    echo ' <script>jQuery(document).ready(function(){
});</script>';
}
//add_action( 'admin_head-post.php', 'excerpt_count_js');
//add_action( 'admin_head-post-new.php', 'excerpt_count_js')

function display_google_ads($placement='header', $identyfier=NULL){
    $themeoptions=new ThemeOptions();
$cat=new Category();
$ar = $cat->getSubPagesNames('Free Samples');

 //echo '<pre>' . print_r( $ar, true ) . '</pre>';
   if ($placement=='header'){
         if (is_page('contests')) {
        $number = get_goolgle_ads_option('number', 'contests');
        $channel = get_goolgle_ads_option('channel', 'contests');
         $slot = get_goolgle_ads_option('slot', 'contests');
        $size = get_goolgle_ads_option('size', 'contests');
        if ((!empty($number))||(!empty($channel))||(!empty($slot))||(!empty($size))){
        get_goolgle_ads_code($number,$channel,$slot,$size);}
        else {echo (stripslashes($themeoptions->get_google_ads(contests_loop_code)));
        }
    } else if (is_page('coupons')) {
        $number = get_goolgle_ads_option('number', 'coupons');
        $channel = get_goolgle_ads_option('channel', 'coupons');
        $slot = get_goolgle_ads_option('slot', 'coupons');
        $size = get_goolgle_ads_option('size', 'coupons');
        if ((!empty($number))||(!empty($channel))||(!empty($slot))||(!empty($size))){
        get_goolgle_ads_code($number,$channel,$slot,$size);}
        else {echo (stripslashes($themeoptions->get_google_ads(coupons_loop_code)));
        }  
    } else if (is_page('sales')) {
        $number = get_goolgle_ads_option('number', 'sales');
        $channel = get_goolgle_ads_option('channel', 'sales');
         $slot = get_goolgle_ads_option('slot', 'sales');
        $size = get_goolgle_ads_option('size', 'sales');
        if ((!empty($number))||(!empty($channel))||(!empty($slot))||(!empty($size))){
        get_goolgle_ads_code($number,$channel,$slot,$size);}
        else {echo (stripslashes($themeoptions->get_google_ads(coupons_loop_code)));
        }  
    } else if (is_page('free-samples')||is_page($ar)) {
        $number = get_goolgle_ads_option('number', 'free');
        $channel = get_goolgle_ads_option('channel', 'free');
        $slot = get_goolgle_ads_option('slot', 'free');
        $size = get_goolgle_ads_option('size', 'free');
        if ((!empty($number))||(!empty($channel))||(!empty($slot))||(!empty($size))){
        get_goolgle_ads_code($number,$channel,$slot,$size);}
        else {echo (stripslashes($themeoptions->get_google_ads(free_loop_code)));
        } 
    } else if (is_page('rewards')) {
        $number = get_goolgle_ads_option('number', 'rewards');
        $channel = get_goolgle_ads_option('channel', 'rewards');
         $slot = get_goolgle_ads_option('slot', 'rewards');
        $size = get_goolgle_ads_option('size', 'rewards');
        if ((!empty($number))||(!empty($channel))||(!empty($slot))||(!empty($size))){
        get_goolgle_ads_code($number,$channel,$slot,$size);}
        else {echo (stripslashes($themeoptions->get_google_ads(rewards_loop_code)));
        }
    } else if (is_page('blog')) {
        $number = get_goolgle_ads_option('number', 'blog');
        $channel = get_goolgle_ads_option('channel', 'blog');
        $slot = get_goolgle_ads_option('slot', 'blog');
        $size = get_goolgle_ads_option('size', 'blog');
        if ((!empty($number))||(!empty($channel))||(!empty($slot))||(!empty($size))){
        get_goolgle_ads_code($number,$channel,$slot,$size);}
        else {echo (stripslashes($themeoptions->get_google_ads(blog_loop_code)));
        }
    } else if (is_page('brands')) {
        $number = get_goolgle_ads_option('number', 'brands');
        $channel = get_goolgle_ads_option('channel', 'brands');
        $slot = get_goolgle_ads_option('slot', 'brands');
        $size = get_goolgle_ads_option('size', 'brands');
        if ((!empty($number))||(!empty($channel))||(!empty($slot))||(!empty($size))){
        get_goolgle_ads_code($number,$channel,$slot,$size);}
        else {echo (stripslashes($themeoptions->get_google_ads(coupons_loop_code)));
        } 
    }  else if (is_page('topics')) {
        $number = get_goolgle_ads_option('number', 'topics');
        $channel = get_goolgle_ads_option('channel', 'topics');
        $slot = get_goolgle_ads_option('slot', 'topics');
        $size = get_goolgle_ads_option('size', 'topics');
        if ((!empty($number))||(!empty($channel))||(!empty($slot))||(!empty($size))){
        get_goolgle_ads_code($number,$channel,$slot,$size);}
        else {echo (stripslashes($themeoptions->get_google_ads(coupons_loop_code)));
        } 
    } else if (is_page('exclusive')) {
        $number = get_goolgle_ads_option('number', 'exclusive');
        $channel = get_goolgle_ads_option('channel', 'exclusive');
        $slot = get_goolgle_ads_option('slot', 'exclusive');
        $size = get_goolgle_ads_option('size', 'exclusive');
        if ((!empty($number))||(!empty($channel))||(!empty($slot))||(!empty($size))){
        get_goolgle_ads_code($number,$channel,$slot,$size);}
        else {echo (stripslashes($themeoptions->get_google_ads(coupons_loop_code)));
        } 
    } else if (is_page('christmas')) {
        $number = get_goolgle_ads_option('number', 'topics');
        $channel = get_goolgle_ads_option('channel', 'topics');
        $slot = get_goolgle_ads_option('slot', 'topics');
        $size = get_goolgle_ads_option('size', 'topics');
        if ((!empty($number))||(!empty($channel))||(!empty($slot))||(!empty($size))){
        get_goolgle_ads_code($number,$channel,$slot,$size);}
        else {echo (stripslashes($themeoptions->get_google_ads(coupons_loop_code)));
        } 
    } else if (is_home() || is_author()) {
        $number = get_goolgle_ads_option('number', 'index');
        $channel = get_goolgle_ads_option('channel', 'index');
        $slot = get_goolgle_ads_option('slot', 'index');
        $size = get_goolgle_ads_option('size', 'index');
   if ((!empty($number))||(!empty($channel))||(!empty($slot))||(!empty($size))){
        get_goolgle_ads_code($number,$channel,$slot,$size);}
        else {echo (stripslashes($themeoptions->get_google_ads(index_loop_code)));
        }
   
    }
    
    /*else{$number = get_goolgle_ads_option('number', 'topics');
        $channel = get_goolgle_ads_option('channel', 'topics');
        $slot = get_goolgle_ads_option('slot', 'topics');
        $size = get_goolgle_ads_option('size', 'topics');}
        get_goolgle_ads_code($number,$channel,$slot,$size);*/
    }
 
   if ($placement=='style_header'){
       $loop=$identyfier.'_loop_channel';
      ?>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-<?php echo (stripslashes($themeoptions->get_google_ads($loop))); ?>-0'); });
</script>
    <?php 
   }
   if ($placement=='scroll'){
   $number = get_goolgle_ads_option('number', $identyfier);
        $loop=$identyfier.'_loop_channel';
  for ($i=0; $i<$number; $i++ ){?>
	 googletag.cmd.push(function() { googletag.display('div-gpt-ad-<?php echo (stripslashes($themeoptions->get_google_ads($loop))); ?>-<?php echo $i;?>'); });
	<?php } 
}
}
function get_goolgle_ads_option($position,$page){
   
$themeoptions=new ThemeOptions();
$loop = $page.'_loop_'.$position;
return (stripslashes($themeoptions->get_google_ads($loop)));
    
}

function get_goolgle_ads_code($number,$channel,$slot,$size){
   
//$themeoptions=new ThemeOptions();
//echo (stripslashes($themeoptions->get_theme_settings('analitycs')));
?>
<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') + 
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
googletag.cmd.push(function() {

<?php
        for ($i = 0; $i < $number; $i++) {
?>
googletag.defineSlot('<?php echo $slot; ?>', <?php echo $size; ?>, 'div-gpt-ad-<?php echo $channel; ?>-<?php echo $i; ?>').addService(googletag.pubads());
<?php }?>
//googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>
        <?php }
 ?>