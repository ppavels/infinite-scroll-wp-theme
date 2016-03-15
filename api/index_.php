<?php

require_once ("REST.php");

class API extends REST {

    protected $functions, $functionId, $User, $Password, $limit, $offset, $debug, $device,$shares,$url, $update_shares, $platform;

    public function __construct() {
    
        
        parent::__construct();
        if (isset($_POST['start_date'])) {
            $start_date = $_POST['start_date'];
        }
        if (isset($_POST['end_date'])) {
            $end_date = $_POST['end_date'];
        }
        if (isset($_POST['post_id'])) {
            $post_id = $_POST['post_id'];
        }
        if (isset($_POST['device'])) {
            $device = $_POST['device'];
        }
        if (isset($_POST['category'])) {
            $category = $_POST['category'];
        }
        if (isset($_POST['brands'])) {
            $taxonomy = 'brands';
            $term = $_POST['brands'];
            $fletter = '';
            $fletter = $_POST['fletter'];
        }
        if (isset($_POST['topics'])) {
            $taxonomy = 'topics';
            $term = $_POST['topics'];
        }
        if (isset($_POST['exclusive'])) {
            $exclusive = $_POST['exclusive'];
        }
		if (isset($_POST['search'])) {
            $search = $_POST['search'];
        }
        if (isset($_POST['url'])) {
            $this->url = $_POST['url'];
        }
		if (isset($_POST['shares'])) {
            $this->update_shares = $_POST['shares'];
			
			
        }
		
		 if (isset($_POST['debug']) && is_numeric($_POST['debug'])) {
                $this->debug = $_POST['debug'];
            } else {
                $this->debug = 1;
        }
		
		if( $device == 'android' ){ 
			$this -> platform = 'native';
			$this -> device = $device;
			}
		if( $device == 'android_web' ){ 
			$this -> platform = 'web';
			$this -> device = 'android';
			}
		if( $device == 'iphone' ){ 
			$this -> platform = 'native';
			$this -> device = $device;
			}
		if( $device == 'iphone_web' ){ 
			$this -> platform = 'web';
			$this -> device = 'iphone';
			}
			
      
	  	if( $device=='dektop' || $device=='mobile'){
			$this -> platform = 'web';
			$this -> device=$device;
			}
	  
	 
        
	    $this->shares=$shares;
		
			
		
        $this->_request['POSTFIELDS'] = $params = array(
            'device' => $this->device,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'post_id' => $post_id,
            'category' => $category,
            'taxonomy' => $taxonomy,
            'term' => $term,
            'fletter' => $fletter,
            'exclusive' => $exclusive,
			'search'=>$search);
        $this->User = 'api';
        $this->Password = 'key-2iionxhsy9aq5rpk06i08qvdcwdg5119';
        if (preg_match('$/api/(\d+)/$', $_SERVER['REQUEST_URI'], $mtch)) {
            $this->functionId = $mtch[1];
            $this->functions = array(1 => 'getPosts', 2 => 'updateShares');

            if (isset($_GET['limit']) && is_numeric($_GET['limit'])) {
                $this->limit = $_GET['limit'];
            } else {
                $this->limit = 10;
            }
            if (isset($_GET['skip']) && is_numeric($_GET['skip'])) {
                $this->offset = $_GET['skip'];
            } else {
                $this->offset = 0;
            }
            

            $thisfunction = $this->functions[$this->functionId];
			
			
        }

        $this->_request['password'] = $_SERVER['PHP_AUTH_PW'];
        $this->_request['login'] = $_SERVER['PHP_AUTH_USER'];
        $this->_request['method'] = $thisfunction;

 


     // add_action( 'pre_get_posts', array($this, 'five_posts_on_homepage') );

        $this->methodType();
        $this->getAuthorithation();
        $this->callMethod();
    }

   
    
function five_posts_on_homepage( $query ) {
 
        $query->set( 'posts_per_page', 5 );
   
}
		
	
	private function formatDateValidate($date, $type = FALSE) {
        if (!$date) {
            $this->remetsponse('Bad Request. Date is empty.', 400);
        }
        $DateArray = explode('/', $date);
        if (!is_array($DateArray) || count($DateArray) !== 3) {
            $this->response('Bad Request. Date format is wrong.', 400);
        }
        if ($type) {

            return $date;
        } else {

            $trueDate = $DateArray[2] . "-" . $DateArray[0] . "-" . $DateArray[1] . ' 00:00:00';

            return $trueDate;
        }
    }

    private function methodType() {
        $type = $this->get_request_method();
        if (!$type || $type != 'POST') {
            $this->response('Http method is incorrect!', 501);
        }
    }

    private function getAuthorithation() {


        if ($this->_request['login'] == $this->User && $this->_request['password'] == $this->Password) {
            return true;
        }
        $this->response('Login or password is incorrect', '401');
    }

    private function callMethod() {
		
		
		
        if (!$this->_request['method']) {
            $this->response('Wrong Method', '203');
        }
        if (method_exists($this, $this->_request['method'])) {
            $name = $this->_request['method'];
            if (!$this->_request['POSTFIELDS']) {
                $this->$name();
				
            }
            $this->$name($this->_request['POSTFIELDS']);
        }else{

        $this->response('Method does not exist!', '203');
		}
    }


private function updateShares($params=array()){
 
        if (class_exists('Tracking')) {
            $share = new Tracking($this->url);
			if($this->update_shares){
            $share->updateTotalShare($this->update_shares);
			}
        };
   } 

        private function getPosts($params = array()) {
        $post_id = $this->_request['POSTFIELDS'] ['post_id'];
		$s = $this->_request['POSTFIELDS'] ['search'];
        $device = $this->_request['POSTFIELDS'] ['device'];
        $category = $this->_request['POSTFIELDS'] ['category'];
        $term = $this->_request['POSTFIELDS'] ['term'];
        $taxonomy = $this->_request['POSTFIELDS'] ['taxonomy'];
        $exclusive = $this->_request['POSTFIELDS'] ['exclusive'];
        $fletter = $this->_request['POSTFIELDS'] ['fletter'];
		
        if (isset($post_id)) {
			if(is_numeric($post_id)){
            $args = $this->getArgsByPostId($post_id);
			}
			else{
			$args = $this->getArgsByPostSlug($post_id);
			}
        } 
		else if (isset($s)) {
			
			$args=$this->getArgsBySearchKeywords($s);
		}
		
		else if (!empty($this->_request['POSTFIELDS']['start_date'])) {

            $startDate = $this->formatDateValidate($this->_request['POSTFIELDS']['start_date']);
            $endDate = $this->formatDateValidate($this->_request['POSTFIELDS']['end_date'], TRUE);
            $args = $this->getArgsByDate($startDate, $endDate);
          } 
		  
		  
	   else if (!empty($device)) {
           
	      $args = $this->prepareMetaQuery($device,$category,$taxonomy,$term,$exclusive,$fletter);
		  
        }
		
	//	echo "<pre>".print_r($args)."</pre>";

        $this->buildJSONModel($args);
    }

    private function getArgsByDevice($meta_query,$category,$taxonomy,$terms,$exclusive,$fletter) {

         if($this->offset == 0){$ignore = 0;}else{$ignore=1;};
if ($terms){
    if($terms == 'all'){
       /* $term = get_terms( $taxonomy );
        $tax = wp_list_pluck( $term, 'slug' );
         $tax_query[] = array(
			'taxonomy' => $taxonomy,
			'field' => 'slug',
			'terms' => $tax
         ); */
        if ( get_query_var( 'paged' ) )
	$paged = get_query_var('paged');
else if ( get_query_var( 'page' ) )
	$paged = get_query_var( 'page' );
else
$paged = 1;
//$offset= $this->limit * ( $paged - 1) ;
if ($taxonomy == 'brands'){$this->limit = '';}
     return $args = array( 'hide_empty' => '1', 'orderby' => 'name','parent '=> 0, 'number' => $this->limit,'offset' => $this->offset,'name__like' => $fletter);
    }else{
             $tax_query[] = array(
			'taxonomy' => $taxonomy,
			'field' => 'slug',
			'terms' => $terms
         );
    }
    }else{ $tax_query = array();}
    if($taxonomy == 'brands'){$excludeposts = '';}else{
    $excludeposts=$this->getExcludedPosts();}
		$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
              
                if(!$exclusive){  
	$meta_query = array(    'relation'=>'AND',
                                array('key' => 'visibility','value' => 'firstnotdisplay','compare' => 'NOT LIKE'),
                                $meta_query);
              }
              
        return $args = array(
            'post_type' => 'post',
			'orderby'    =>  'date',
            'order'      =>  'desc',
            'posts_per_page' => $this->limit,
            'category__and' => $category,
			'page'       =>  $page,
            'tax_query' => $tax_query,
            'meta_query' => $meta_query,
            'offset' => $this->offset,
            'post__not_in' => $excludeposts,
			'ignore_sticky_posts' => $ignore
        );
    }

    private function prepareMetaQuery($device,$category,$taxonomy,$term,$exclusive,$fletter) {
       
        if (!empty($category)&&!is_numeric($category)){
            //$category=get_category_id( $category );
			$catObj = get_category_by_slug($category);
            $category = $catObj->term_id;
			if(empty($category)){
				$category=-2;
			}
			
    }
        
    if (!empty($taxonomy)&&!is_numeric($taxonomy)){
            
            $terms = str_replace(" ", "-", trim(strtolower($term)));
                        if(empty($term)){
				$terms = FALSE;
			}
			
    }
    if (!empty($exclusive)&&($exclusive==1)){
                     $exclusive = array(
           'key' => 'is-exclusive',
           'value' => 'is-exclusive',
           'compare' => 'LIKE',
       );
    }else{
        $exclusive = FALSE;
         }
       

// $devicetype = array('key' => $device, 'value' => 'display', 'compare' => 'like');  //thisi line should be uncomenneted when add post meta by device  
    //    $meta_query = array($devicetype,$exclusive); 
		$meta_query = array($exclusive); 
		//thisi line should be uncomenneted when add post meta by device
            return $args = $this->getArgsByDevice($meta_query,$category,$taxonomy,$terms,$exclusive,$fletter);
    }

    function get_category_id($cat_name) {
        $term = get_term_by('name', $cat_name, 'category');
        return $term->term_id;
    }
	
	

    function api_get_meta_title($name,$id=0){
        if ($name == 'post') {
            if (get_post_meta($id, "title", true) != "") {
                return get_post_meta($id, "title", true);
            } else {
             return get_the_title($id);
            }
        }
        if ($name == 'category') {
            if (get_post_meta($id, 'cat-meta-title', true) != '') {
                return get_post_meta($id, 'cat-meta-title', true);
            } else {
                return get_bloginfo('name');
            } 
        } else if ($name == 'index') {
            return get_bloginfo('name');
        }
    }
    
    function api_get_meta_description($name,$id=0){
        if ($name == 'post') {
            return(get_post_meta($id, "description", true));
        }
        if ($name == 'category') {
             if (get_post_meta($id, 'page-meta-description', true) != '') {
                return get_post_meta($id, 'page-meta-description', true);
            } else {
                return get_option('adjump_description');
            } 
        } else if ($name == 'index') {
            if (get_option('adjump_description') != "") {
                return get_option('adjump_description');
            }
        }
    }
    
        
    private function getArgsByPostId($post_id) {
        return $args = array('p' => $post_id);
    }
	 private function getArgsByPostSlug($post_id) {
        return $args = array('name' => $post_id);
    }
	
	private function getExcludedPosts(){
		 global $wpdb;
		 $today=date('Y, d m');
		  /*$sqlstsic="SELECT DISTINCT `post_id`
FROM `womanfreebies_com_postmeta`
WHERE `meta_key` = 'expiration'
AND STR_TO_DATE( `meta_value` , '%m/%d/%Y %H:%i:%s' ) < STR_TO_DATE( '2014, 24 03 15:00:00', '%Y, %d %m %H:%i:%s') ORDER BY post_id DESC
LIMIT 5000 ";

$sqlclear="DELETE
FROM `womanfreebies_com_postmeta`
WHERE `meta_key` = 'expiration'
AND `meta_value` = '//'"; 

$sqlclear="DELETE
FROM `womanfreebies_com_postmeta`
WHERE `meta_key` = 'expiration'
AND `meta_value` = '-1/-1/-- -1'";*/
		 $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `".$wpdb->prefix ."postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 5000" );
				
		return $excludeposts;
	}

    private function getArgsByDate($startDate, $endDate) { 
        return $args = array(
            'post_type' => 'post',
            'date_query' => array(
                array(
                    'after' => $startDate,
                    'inclusive' => true,
                ),
            ),
            'meta_key' => 'expired-date',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => 'expired-date',
                    'value' => $endDate,
                    'compare' => '>',
                ),
            ),
            'posts_per_page' => $this->limit,
            'offset' => $this->offset,
        );
    }
    
    private function getPostIdBySlug($slug) {
$args=array(
	'name' => $slug,
	'post_type' => 'post',
	'posts_per_page' => 1
);
$post = get_posts( $args );
if( $post ) {
	return $post[0]->ID;
}
    }

    private function getArgsBySearchKeywords($s) {
		
		$devicetype = array('key' => $this->device, 'value' => 'display', 'compare' => '=');
        $meta_query = array($devicetype);
        $meta_query = array();
        $excludeposts=$this->getExcludedPosts();
		return $args = array('s' => $s,
		'meta_query' => $meta_query,    
		'posts_per_page' => $this->limit,
		'posts__not_in' => $excludeposts,
        'offset' => $this->offset
		
		);
    }
	
	private function buildJSONModel($args) {
          $this_post=new Post(); 
          
        $device = $this->_request['POSTFIELDS'] ['device'];
        if(!empty($args['category__and'])){
		$catname = get_category($args['category__and']);
                
		}
       if ($this->_request['POSTFIELDS'] ['term'] == 'all'){                    //get ALL taxonomy list 
          $cat=new Category(); 
          $nav=new Navigation();  
            $taxonomy = $this->_request['POSTFIELDS'] ['taxonomy'];
            $term = $this->_request['POSTFIELDS'] ['term'];
            $subcats = get_terms( $taxonomy, $args );
                $resultData = array();
                if ($this->debug==1){
                $resultData['query_args']=$args;}
		$resultData['query_GMT']=date("F d Y H:i:s.", time());
                $count = wp_count_terms( $taxonomy , $args);
		$resultData['found_posts']=$count;
		$resultData['post_count']=count($subcats);
                $max_num_pages = $count / $this->limit;
		$resultData['max_num_pages']=  ceil($max_num_pages);
                $resultData['offset']=  $this->offset;
                $resultData['current_page']=  ceil(($this->limit + $this->offset) / $this->limit);
		$resultData['targeted_device']=$this->device;
                $description = $this->api_get_meta_description('index');
                $title = $this->api_get_meta_title('index');
        
                $resultData['meta_title'] = $title;
                $resultData['meta_description'] = $description;
                $i=0;
       foreach($subcats as $sub){
          $link = $nav->getLink( ucwords($taxonomy) , 'page');
                $resultData ['post'][$i]['name']= $sub->name;
                $resultData ['post'][$i]['slug']= $sub->slug;
                $resultData ['post'][$i]['post_id']= $sub->term_id;
                $resultData ['post'][$i]['taxonomy_permalink']= $taxonomy. DS .$sub->slug;
                $resultData ['post'][$i]['taxonomy_share_link']= $link.$sub->slug;
                if($taxonomy == 'brands'){$image = $cat->getBrandImage($sub->term_id);}
            elseif($taxonomy == 'topics'){$image = $cat->getTopicIcon($sub->term_id);
                $resultData ['post'][$i]['topic_title'] = $cat->getTopicTitle($sub->term_id);
                $resultData ['post'][$i]['topic_description'] = $sub->description;
            }
                $resultData ['post'][$i]['post_image']= $image;
                
                
                $i++;
        }
                $this->response(json_encode($resultData), '200');
        }else{
		//wp_reset_query();
        $wp_query = new WP_Query($args);
		$resultData=array();
        if ($this->debug==1){
        $resultData['query_args']=$args;}
		$resultData['query_GMT']=date("F d Y H:i:s.", time());
		$resultData['found_posts']=$wp_query->found_posts;
		$resultData['max_num_pages']=$wp_query->max_num_pages;
        $resultData['offset']=  $this->offset;
        $resultData['current_page']=  ceil(($this->limit + $this->offset) / $this->limit);
		$resultData['post_count']=$wp_query->post_count;
		$resultData['targeted_device']=$this->device;
        $taxname = get_term_by('slug', $args['tax_query'][0]['terms'], $args['tax_query'][0]['taxonomy'])->name;  
                
        if(($args['tax_query'][0]['taxonomy'])=='topics' || ($args['tax_query'][0]['taxonomy'])=='brands' ){
                    $resultData['taxname'] = $taxname;
                }
                if(($args['tax_query'][0]['taxonomy'])=='topics'){
                    $page = get_page_by_title( $taxname );
                    $h2title = get_post_meta($page->ID, 'page-h2-title', TRUE);
                    $resultData ['h2title']= $h2title;
                }elseif($catname){
                    $page = get_page_by_title( $catname->name );
                    $h2title = get_post_meta($page->ID, 'page-h2-title', TRUE);
                    $resultData ['h2title']= $h2title;
                }
                
                
           
        if(!empty($args['name']) || !empty($args['p'])){    
            if(!empty($args['name']))   {
            $post_id = $this->getPostIdBySlug($args['name']);}else{$post_id = $args['p'];}
           
        
           $description = $this->api_get_meta_description('post',$post_id);
           $title = $this->api_get_meta_title('post',$post_id);
        }               
        elseif(!empty($args['category__and'])){
            $page = get_page_by_title( $catname->name );
                $description = $this->api_get_meta_description('category',$page->ID);
                $title = $this->api_get_meta_title('category',$page->ID);
        }
        elseif(($args['tax_query'][0]['taxonomy'])=='topics'){
            $cat=new Category(); 
            $term = get_term_by('slug', $args['tax_query'][0]['terms'], $args['tax_query'][0]['taxonomy']);
                $description = $cat->get_term_meta($term->term_id, 'topic-default-meta', true);
                $title = $cat->get_term_meta($term->term_id, 'tag-default-icon', true);
        }
        elseif(($args['tax_query'][0]['taxonomy'])=='brands' ){
            $cat=new Category(); 
            $term = get_term_by('slug', $args['tax_query'][0]['terms'], $args['tax_query'][0]['taxonomy']);
                $description = $cat->get_term_meta($term->term_id, 'brand-meta-description', true);
                $title = $cat->get_term_meta($term->term_id, 'brand-meta-title', true);
        }
        else{
            $description = $this->api_get_meta_description('index');
            $title = $this->api_get_meta_title('index');
        }
            $resultData['meta_title'] = $title;
            $resultData['meta_description'] = $description;

        if ($catname) {
        $resultData['targeted_category_name']=$catname->name; 
        }
		if($this->_request['POSTFIELDS']['category']!=NULL){
		$resultData['targeted_category']=$this->_request['POSTFIELDS'] ['category'];
		}
		if($this->_request['POSTFIELDS'] ['taxonomy']!=NULL){
		$resultData['targeted_'.$this->_request['POSTFIELDS'] ['taxonomy']]=$this->_request['POSTFIELDS'] ['term'];
		}
		                
		if($this->_request['POSTFIELDS'] ['post_id']!=NULL){
		$display_next=TRUE;
		}

        if ($wp_query->have_posts()) {
            $i = 0;
            while ($wp_query->have_posts()) {


                $wp_query->the_post();
                $post_id = get_the_ID();
				$post = get_post($post_id);
                    
                         
                $tracking = new Tracking(get_permalink($post_id));              
				$expired_date=$this_post->getExpiredDate(); 
                                $expired = $this_post->isExpired();
                                $catID = get_cat_ID( 'Expired' );
                                if($this_post->getPostMeta('is-exclusive')){$is_exclusive = TRUE;}else{$is_exclusive = FALSE;}
				$d='F d, Y';
				$pfx_date = get_the_date( $d );
                $slug = $post->post_name;
		
                $prev_post = get_adjacent_post(0, $catID ,1);
                $next_post = get_adjacent_post(0, $catID ,0); 
								 
				 if($this -> platform == 'web'){
		         $excerpt=mb_convert_encoding($this->nl2br2(get_the_excerpt()), "HTML-ENTITIES", 'UTF-8');
		         $content=mb_convert_encoding($this->nl2br2(get_the_content()), "HTML-ENTITIES", 'UTF-8');
				 }
				 else{
				 $excerpt=get_the_excerpt();
		         $content=get_the_content();	 
				 }
				
				
				
				//post type ends
				$permalink=str_replace(get_bloginfo('url'), '', get_permalink());
				
				if($prev_post->ID==NULL){
					$prev_post_id=-1;
					$prev_post_permalink='';
				}
				else{
					$prev_post_id=$prev_post->ID;
					$prev_post_permalink=str_replace(get_bloginfo('url'), '', get_permalink($prev_post_id));
				}
				if($next_post->ID==NULL){
					$next_post_id=-1;
					$next_post_permalink='';
				}
				else{
					$next_post_id=$next_post->ID;
					$next_post_permalink=str_replace(get_bloginfo('url'), '', get_permalink($next_post_id));
				}
				
				//post slug
				
				if($prev_post->post_name==NULL){
					$prev_post_slug='';
				}
				else{
					$prev_post_slug=$prev_post->post_name;
				}
				if($next_post->post_name==NULL){
					$next_post_slug='';
				}
				else{
					$next_post_slug=$next_post->post_name;
				}
				
				
                $images = array();
				$categories = array();
                $categories = get_the_category($post_id);
				foreach ($categories as $cat){
					$category[$post_id][]=$cat->cat_name;
				}
				//$category = get_the_terms($post_id, 'category');
                $post_categories = wp_get_post_categories( $post_id );
                $cur_terms_deals = get_the_terms($post_id, 'deals');
                foreach ($cur_terms_deals as $cur_term_deals) {
                    $deals = $cur_term_deals->name;
                }

                 $local_image=Images::getPostImageUrl();
				 $cloud_image=$this->getCloudImage($local_image);
                //$main_image=str_replace('`','%E2%80%99',get_main_image_url());
                $images['300_250'] = mb_convert_encoding($cloud_image, "HTML-ENTITIES", 'UTF-8');
				
				
			
				
				
                $resultData ['post'][$i]['post_id']= $post_id;
				//article, list, recepie, 300_250_post, post
   $post_type='post';
                                
				$resultData ['post'][$i]['post_type']= $post_type;
               // $resultData ['post'][$i]['post_share']= 777;
                $resultData ['post'][$i]['post_share']= $tracking->displayShares();
                $resultData ['post'][$i]['post_date']= $pfx_date;
				$resultData ['post'][$i]['post_expired_date']= $expired_date;
				$resultData ['post'][$i]['post_is_expired']= $expired;
        
                 if ($catname) {
        $is_sticky = get_post_meta($post_id, 'is-sticky', TRUE);
        if ($is_sticky == '') {$category_featured = FALSE;}else{$category_featured = TRUE;}
                 
                                    $resultData ['post'][$i]['category_featured']= $category_featured; 
                                    $resultData['post'][$i]['in_category']=$this->_request['POSTFIELDS'] ['category'];
                                    if(($args['tax_query'][0]['taxonomy'])=='topics'){
                                        $resultData['post'][$i]['in_topic'] = ($args['tax_query'][0]['terms']);
                                    }
                                    
                                }
				$resultData ['post'][$i]['is_exclusive']= $is_exclusive;
				$resultData ['post'][$i]['post_slug']= $slug;
				
				
 
				
				$resultData ['post'][$i]['next_post_id'] = $next_post_id;
                $resultData ['post'][$i]['prev_post_id'] = $prev_post_id;
				
				$resultData ['post'][$i]['next_post_slug'] = $next_post_slug;
                $resultData ['post'][$i]['prev_post_slug'] = $prev_post_slug;
				
				$resultData ['post'][$i]['next_post_permalink'] = $next_post_permalink;
                $resultData ['post'][$i]['prev_post_permalink'] = $prev_post_permalink;
				
                $resultData ['post'][$i]['device'] = $this->device;
                $resultData ['post'][$i]['post_title']= mb_convert_encoding(get_the_title(), "HTML-ENTITIES", 'UTF-8');
                
                $save_text=$this_post->getSaveText();
                if($save_text){ 
                $resultData ['post'][$i]['save_text'] = $save_text; 
                }
                $postViews = $this_post->getPostViews();
                if($postViews !=''){ 
                $resultData ['post'][$i]['postViews'] = $postViews; 
                }else{
                    $resultData ['post'][$i]['postViews'] = '';
                }
                
                if ($this_post->getPostImage()==FALSE) {
                    
                    $img_src = $this->getImage();                            
                    
                }else{ 
                    $img_src = $this_post->getPostImage(FALSE, FALSE, FALSE);
                            }
                
                $resultData ['post'][$i]['post_image']= $this->getCloudImage($img_src);
				if($cloud_image){
				$cloudimage['full']['src'] = mb_convert_encoding(Images::get_featured_image(FALSE), "HTML-ENTITIES", 'UTF-8');
				$cloudimage['full']['width'] = 300;
				$cloudimage['full']['height'] = 250;
				$resultData ['post'][$i]['post_images'] = $cloudimage;
				}
                $resultData ['post'][$i]['post_content']= $content; 
                $resultData ['post'][$i]['post_excerpt']= $excerpt;
                $resultData ['post'][$i]['post_category']= $category[$post_id];
                $resultData ['post'][$i]['post_category_id']= $post_categories;
				$resultData ['post'][$i]['post_permalink']= htmlentities($permalink);
                $resultData ['post'][$i]['post_share_link']= get_permalink();
				if($deals!=NULL){
                $resultData ['post'][$i]['post_deals']= $deals;
				}              
                $resultData ['post'][$i]['post_hyperlink']= htmlentities(get_post_meta($post_id, "hyperlink", true));
                $resultData ['post'][$i]['post_hyperlink_text'] = htmlentities(get_post_meta($post_id, "hyperlink text", true));
                $resultData ['post'][$i]['post_local_link_text']= htmlentities(get_post_meta($post_id, "local link text", true));
                $resultData ['post'][$i]['post_meta_keywords'] = htmlentities(get_post_meta($post_id, "keywords", true));
                $resultData ['post'][$i]['post_meta_title']= htmlentities(get_post_meta($post_id, "title", true));
                $resultData ['post'][$i]['post_meta_description']= htmlentities(get_post_meta($post_id, "description", true));
                $resultData ['post'][$i]['post_offer_id']= htmlentities(get_post_meta($post_id, "offer-id", true));
                $resultData ['post'][$i]['post_file_id']= htmlentities(get_post_meta($post_id, "file-id", true));
                
                if(isset($this->_request['POSTFIELDS'] ['post_id'])){
                 
                    $rel = $this -> getRelatedAPI($this->_request['POSTFIELDS'] ['post_id'], $post_categories);
                    $resultData ['related'] = $rel;
					 
                }

         
				
				$i++;
            } //endwhile
			 
			 wp_reset_postdata();
             
			 if(!$taxname&&isset($this->_request['POSTFIELDS'] ['category'])){
			 $category_id=NULL;
			 $resultData['post_related']=$taxname;
			 $sticky=FALSE;
			 $cat=$this->_request['POSTFIELDS'] ['category'];
			
			 if (!empty($cat)&&!is_numeric($cat)){
            //$category=get_category_id( $category );
			$catObj = get_category_by_slug($cat);
            $category_id = $catObj->term_id;
			
			
            } //!empty        
			if($this->offset==0){
             $sticky = $this->buildJSONSticky($category_id);  
	        }//offset
               
          if ($sticky){
          array_unshift( $resultData['post'], $sticky );
          }
		}//taxname
			
			else{
				//$resultData['taxname']=$taxname;
			
			}
        $this->response(json_encode($resultData), '200');
        } else {
			$resultData=array();
			$resultData['arg']=$args;
			$resultData['error']=array('message'=>'No Posts Found', 'code'=>'404');
            $this->response(json_encode($resultData), '404');
        }
        }}
        
        private function getImage() {
        $img = Images::getContestFirstImage();
        if ($img == '') {
            $img = Images::get_featured_image(FALSE, TRUE);
        }
        return $img;
    }

	private function nl2br2($string) {
    $string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
	$string = str_replace(">&nbsp;", ">", $string);
	
	$string=preg_replace('@(<\/td>)[<br \/>]+(<td)@i', "$1\n$2", $string);
	//$string=preg_replace('@(<\/td>)\s[<br \/>]+@i', "$1\n", $string);
	$string=preg_replace('@(<\/tr>)[<br \/>]+(<tr)@i', "$1\n$2", $string);
	$string=preg_replace('@(<\/td>)[<br \/>]+(</tr)@i', "$1\n$2", $string);
	$string=preg_replace('@(<tr>)[<br \/>]+(<td)@i', "$1\n$2", $string);
	$string=preg_replace('@(<\/td>)[<br \/>]+(<table>)@i', "$1\n$2", $string);
	
	
	//$string=preg_replace('@(<\/table>)<br \/><br \/>@i', "$1\n", $string);
	$string=preg_replace('@(<\/tr>)[<br \/>]+(<\/tbody)@i', "$1\n$2", $string);
	$string=preg_replace('@(<\/tbody>)[<br \/>]+(<\/table)@i', "$1\n$2", $string);
	$string=preg_replace('@(<table>)[<br \/>]+(<tbody>)@i', "$1\n$2", $string);
	$string=preg_replace('@(<\/style>)[<br \/>]+(<\/head>)@i', "$1\n$2", $string);
	$string=preg_replace('@(<\/head>)[<br \/>]+(<body>)@i', "$1\n$2", $string);
	$string=preg_replace('@(<body>)[<br \/>]+(<table>)@i', "$1\n$2", $string);
	$string=preg_replace('@(<tbody>)[<br \/>]+(<tr>)@i', "$1\n$2", $string);
	$string=preg_replace('@(<\/td>)[<br \/>]+(<tr>)@i', "$1\n$2", $string);
	$string=preg_replace('@(<\/table>)[<br \/>]+(<\/tbody>)@i', "$1\n$2", $string);
	$string=preg_replace('@(<\/tbody>)[<br \/>]+(<\/tbody>)@i', "$1\n$2", $string);
	$string=preg_replace('@(<\/tr>\s?)[<br \/>]+(\s?<\/table>)@i', "$1\n$2", $string);
	
	
	
	$string=preg_replace('@(<tr>)<br \/>(<td>)@i', "$1\n$2", $string);
	$string=preg_replace('@[<br \/>]+(<\/style>)@i', "$1", $string);
	
	$string=preg_replace('@(\{)[<br \/>]+@i', "$1", $string);
	$string=preg_replace('@(\;)[<br \/>]+@i', "$1", $string);
	$string=preg_replace('@[<br \/>]+(\})@i', "$1", $string);
	$string=preg_replace('@(css\">)[<br \/>]+@i', "$1", $string);
	$string=preg_replace('@(\})<br \/>@i', "$1", $string);
	
    return $string;
     } 
   
     
     private function buildJSONSticky($category_id=NULL) {
        $cat = new Category();
        $cat_id = $cat->getIdByName('Free Samples');
		
		if($category_id!=$cat_id||$category_id==NULL){
			return FALSE;
		}
		else{
        $args['category__in'] = $cat_id;
        $args['meta_key'] = 'is-sticky';
        $args['posts_per_page'] = 2;
        wp_reset_query();
		//wp_reset_query();
        $wp_query = new WP_Query($args);
		$resultData=array();
 

        if ($wp_query->have_posts()) {
            $i = 0;
            while ($wp_query->have_posts()) {


                $wp_query->the_post();
                $post_id = get_the_ID();
				$post = get_post($post_id);
                    
                $this_post=new Post();            
                $tracking = new Tracking(get_permalink($post_id));              
				$expired_date=$this_post->getExpiredDate(); 
                                $expired = $this_post->isExpired();
                                $catID = get_cat_ID( 'Expired' );
                                if($this_post->getPostMeta('is-exclusive')){$is_exclusive = TRUE;}else{$is_exclusive = FALSE;}
				$d='F d, Y';
				$pfx_date = get_the_date( $d );
                $slug = $post->post_name;
		
                $prev_post = get_adjacent_post(0, $catID ,1);
                $next_post = get_adjacent_post(0, $catID ,0); 
								 
				 if($this -> platform == 'web'){
		         $excerpt=mb_convert_encoding($this->nl2br2(get_the_excerpt()), "HTML-ENTITIES", 'UTF-8');
		         $content=mb_convert_encoding($this->nl2br2(get_the_content()), "HTML-ENTITIES", 'UTF-8');
				 }
				 else{
				 $excerpt=get_the_excerpt();
		         $content=get_the_content();	 
				 }
								
				$permalink=str_replace(get_bloginfo('url'), '', get_permalink());
				
				if($prev_post->ID==NULL){
					$prev_post_id=-1;
					$prev_post_permalink='';
				}
				else{
					$prev_post_id=$prev_post->ID;
					$prev_post_permalink=str_replace(get_bloginfo('url'), '', get_permalink($prev_post_id));
				}
				if($next_post->ID==NULL){
					$next_post_id=-1;
					$next_post_permalink='';
				}
				else{
					$next_post_id=$next_post->ID;
					$next_post_permalink=str_replace(get_bloginfo('url'), '', get_permalink($next_post_id));
				}
				
				if($prev_post->post_name==NULL){
					$prev_post_slug='';
				}
				else{
					$prev_post_slug=$prev_post->post_name;
				}
				if($next_post->post_name==NULL){
					$next_post_slug='';
				}
				else{
					$next_post_slug=$next_post->post_name;
				}
				
				
                $images = array();
				$categories = array();
                $categories = get_the_category($post_id);
				foreach ($categories as $cat){
					$category[$post_id][]=$cat->cat_name;
				}
                $post_categories = wp_get_post_categories( $post_id );
                $cur_terms_deals = get_the_terms($post_id, 'deals');
                foreach ($cur_terms_deals as $cur_term_deals) {
                    $deals = $cur_term_deals->name;
                }
                 $local_image=Images::getPostImageUrl();
				 $cloud_image=$this->getCloudImage($local_image);
                $images['300_250'] = mb_convert_encoding($cloud_image, "HTML-ENTITIES", 'UTF-8');
	          $resultData['post_id']= $post_id;
	                       $post_type='post';
				$resultData['post_type']= $post_type;
                $resultData['post_share']= $tracking->displayShares();
                $resultData['post_date']= $pfx_date;
				$resultData['post_expired_date']= $expired_date;
				$resultData['post_is_expired']= $expired;
        $is_sticky = get_post_meta($post_id, 'is-sticky', TRUE);
        if ($is_sticky == '') {$category_featured = FALSE;}else{$category_featured = TRUE;}
                                    $resultData['category_featured']= $category_featured; 
                                    $resultData['in_category']=$this->_request['POSTFIELDS'] ['category'];
                                    if(($args['tax_query'][0]['taxonomy'])=='topics'){
                                        $resultData['in_topic'] = ($args['tax_query'][0]['terms']);
                                    }
                                
				$resultData['is_exclusive']= $is_exclusive;
				$resultData['post_slug']= $slug;
				$resultData['next_post_id'] = $next_post_id;
                $resultData['prev_post_id'] = $prev_post_id;
				
				$resultData['next_post_slug'] = $next_post_slug;
                $resultData['prev_post_slug'] = $prev_post_slug;
				
				$resultData['next_post_permalink'] = $next_post_permalink;
                $resultData['prev_post_permalink'] = $prev_post_permalink;
				
                $resultData['device'] = $this->device;
                $resultData['post_title']= mb_convert_encoding(get_the_title(), "HTML-ENTITIES", 'UTF-8');
                
                $save_text=$this_post->getSaveText();
                if($save_text){ 
                $resultData['save_text'] = $save_text; 
                }
                $postViews = $this_post->getPostViews();
                if($postViews !=''){ 
                $resultData['postViews'] = $postViews; 
                }else{
                    $resultData['postViews'] = '';
                }
                
                if ($this_post->getPostImage()==FALSE) {
                    
                    $img_src = $this->getImage();                            
                    
                }else{ 
                    $img_src = $this_post->getPostImage(FALSE, FALSE, FALSE);
                            }
                
                $resultData['post_image']= $this->getCloudImage($img_src);
				if($cloud_image){
				$cloudimage['full']['src'] = mb_convert_encoding(Images::get_featured_image(FALSE), "HTML-ENTITIES", 'UTF-8');
				$cloudimage['full']['width'] = 300;
				$cloudimage['full']['height'] = 250;
				$resultData['post_images'] = $cloudimage;
				}
                $resultData['post_content']= $content; 
                $resultData['post_excerpt']= $excerpt;
                $resultData['post_category']= $category[$post_id];
                $resultData['post_category_id']= $post_categories;
				$resultData['post_permalink']= htmlentities($permalink);
                $resultData['post_share_link']= get_permalink();
				if($deals!=NULL){
                $resultData['post_deals']= $deals;
				}              
                $resultData['post_hyperlink']= htmlentities(get_post_meta($post_id, "hyperlink", true));
                $resultData['post_hyperlink_text'] = htmlentities(get_post_meta($post_id, "hyperlink text", true));
                $resultData['post_local_link_text']= htmlentities(get_post_meta($post_id, "local link text", true));
                $resultData['post_meta_keywords'] = htmlentities(get_post_meta($post_id, "keywords", true));
                $resultData['post_meta_title']= htmlentities(get_post_meta($post_id, "title", true));
                $resultData['post_meta_description']= htmlentities(get_post_meta($post_id, "description", true));
                $resultData['post_offer_id']= htmlentities(get_post_meta($post_id, "offer-id", true));
                $resultData['post_file_id']= htmlentities(get_post_meta($post_id, "file-id", true));
               
		
				$i++;
            } //endwhile
			wp_reset_postdata();
            return $resultData;
        } else {
            return FALSE;
        }
		}
   }
      


public function getRelatedAPI($this_id, $cat_id, $post_num=20){ 

global $wpdb;
$today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );
$excludeposts[]=$this_id;
if(!empty($cat_id)){ 
$arg_arr['category__in']=$cat_id;
}
$arg_arr['posts_per_page']=-1;
$arg_arr['post__not_in']=$excludeposts;
$arg_arr['date_query']['after'] ='3 month ago';
$arg_arr['date_query']['inclusive'] =true;
$arg_arr['meta_query'] = array(array('key' => 'visibility','value' => 'firstnotdisplay','compare' => 'NOT LIKE'));

wp_reset_query();
$the_query = new WP_Query($arg_arr);

$counter = 0;
$rel = array();
while ($the_query->have_posts() ) : $the_query->the_post();
global $post;
$rel[$counter]['post_id'] = $post->ID;
$rel[$counter]['post_slug'] = $post->post_name;
$rel[$counter]['post_title'] = mb_convert_encoding($post->post_title, "HTML-ENTITIES", 'UTF-8');
$rel[$counter]['cat_id'] = $cat_id[0];
$this_post=new Post();
$thisCat = get_category($cat_id[0]);
$cat_name=$thisCat->name;
if($cat_name=='Contests and Sweepstakes'){
	$cat_name='Contests';
}
$rel[$counter]['category_title'] = "More ".$cat_name;
if ($this_post->getPostImage()==FALSE) {$local_image = Images::getContestFirstImage();}
else{ $local_image = $this_post->getPostImage(FALSE, TRUE);
}
//$local_image=Images::getPostImageUrl();
$cloud_image=$this->getCloudImage($local_image);
$rel[$counter]['post_image'] .= mb_convert_encoding($cloud_image, "HTML-ENTITIES", 'UTF-8');
$rel[$counter]['post_permalink'] = get_permalink($post->slug);
$rel[$counter]['post_date'] = $post->post_date;
$counter++;
endwhile;
$c=0;
foreach(array_rand($rel, $post_num) as $key){
	$rand_keys[$c] = $rel[$key];
	$c++;
}

return $rand_keys;

}
private function getCloudImage($local_image){
//return $cloud_image=str_replace ('http://free.ca', 'http://c454621.r21.cf2.rackcdn.com/free.ca',$local_image);
	return $cloud_image=str_replace ('http://free.ca', 'http://storage.googleapis.com/cdn-free-ca',$local_image);
	
}
	 
}







$Request = new API;
?>