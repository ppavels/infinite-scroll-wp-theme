<?php 

class Post {
	
private $post, $post_settings,  $counter;
public $post_id;

function __construct($args = array()){
	
	global $post;
	$this->post=$post;
	$this->post_settings=new PostEditPanel();
	$this->post_id=$post->ID; 
	

}
public function getSEODataTaxonomy($meta_name){
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ));
$cat = new Category;
return $cat->get_term_meta($term->term_id, $meta_name, true);
}

public function getSidebarTitle($page_id){
	
		return get_post_meta($page_id, 'sidebar-title', TRUE);
	
}
 
public function getSEOData($meta_name,$type){
	if($type=='page'){
		return $this->post_settings->get_custom_post_meta($meta_name);
	}
      //  else if($type=='author'){//echo $meta_name;
            //return get_the_author_meta('description');            
       // }
	else if($type=='category'){
		
		 $thisCat = get_category(get_query_var('cat'),false);
		 $cat_name=$thisCat->name;
		 if($cat_name=='Contests and Sweepstakes'){
			$cat_name='Contests';
		}
		 $page=get_page_by_title( $cat_name);
		 if($page->ID){
		  return $this->post_settings->get_custom_post_meta($meta_name, $page->ID);
		 }
		                
		 else{
			
                     return FALSE;
		 }
	}
	else{
		// return 'This has not been done yet';
		
	}
}

public function getPostMeta($meta_name,   $single=TRUE){

return $this->post_settings->get_custom_post_meta($meta_name, $this->post_id,  $single);
	
}


public function  getExclusiveOffer(){
	if($this->getPostMeta('is-exclusive')){ ?>
    <div class="exclusive-div"></div>
	<?php }
	
}
public function getPostViews(){
	$views;
	if(function_exists('get_the_views')){
		
		$views=get_the_views($this->post_id);
		$views=str_replace('1 views', '1 view', $views);
	}
	
  return $views;

}

public function getSaveText(){
$text=$this->getPostMeta('coupon-save-text');
if(preg_match("#save#msi",$text)){
$texts=explode(" ",$text,2);
if(count($texts>1)){
	$text=$texts[1];
}
else{
	$text=$texts[0];
}

}

return $text;
}
public function getButtonText($type=NULL){
	if(is_single()){
		$text=$this->getPostMeta('hypertext');
		if(empty($text)){
		$text=$this->getPostMeta('localbtntext');
		}
	}
	
	else{
		$text=$this->getPostMeta('localbtntext');
	}
	
	if(empty($text)&&isset($type)){
		if($type=="Coupons"){
			 $text="Get Your Coupon";
		}
		else if ($type=="Freebies"){
			 $text="Get Your Freebies";
		}
                else if ($type=="Blogs"){
			 $text="Get Blogs";
		}
                 else if ($type=="Contests"){
			 $text="Get Contests";
		}
                  else if ($type=="Sales"){
			 $text="See Sales...";
		}else if ($type=="Rewards"){
			 $text="Get Rewards";
		}else{
			$text="Learn More...";
		}
	}
	return $text;
}





//Expired date:
public function getExpiredDate($format='Y-m-d h:i:s a'){ 
	$exparr=$this->getPostMeta('expired-date');
	
	
	//echo "Date <h1 style='align:right'><pre>".print_r($exp,TRUE)."</pre></h1>";
	$exp=$exparr['date'];
	
	if(!empty($exp)){
	$exp=$exp." 23:59:59";
	
	
	$exp=$this->changeDateFormat($exp, $format);
	}
	return $exp;
}
public function isExpired(){
	
	
	$current_time=current_time('mysql');
	$expired_date=$this->getExpiredDate();
	if(!empty($expired_date)){
    $secondsbetween = strtotime($expired_date)-strtotime($current_time);
	if ( $secondsbetween <= 0 ) {
	if(1==2){ //this part blocks from creating category expired and moving posts there	
	$cat=new Category();
	$expired_id=$cat->getIdByName('Expired');
	if(empty($expired_id)){
	$expired_id=$cat->createCategory('Expired');
	}
	
	$post_categories=array();
	$post_categories[0]=$expired_id;
	wp_set_post_categories($this->post_id, $post_categories);
	 
	}
   	return true;
	
	}
	else {
   
	return false;
	}
	

	}
	else{
	
	return false;
	}
}

    function isDisplayExpired($post_id){
	$data = get_post_meta($post_id, 'Announcements', true );
	if($data['displaytouser']==1){
		return true;
	}
	else{
		return false;
	}
	
}

private function changeDateFormat($date, $format=null){
	
	if($format==null){
		$format="F j, Y ";
	}
$old_date_timestamp = strtotime($date);

$newDateString=date($format, $old_date_timestamp);
return $newDateString;

}


function showExpiredDate($message_before='Expires On ', $format='F j, Y'){
	
	 if(!$this->isExpired()){
		 
	 $arr=$this->getPostMeta('expired-date');
	 $is_display_exp=$arr['display'];
     //if($is_display_exp=='display'){
	 	 
	 $expired_date=$this->getExpiredDate($format);
	 
	 if($expired_date){
	 $output=$message_before.$expired_date;
	 }
  //   } 
  return $output;
	 
         }else {
            $my_post = array();
            $my_post['ID'] = $this->post_id;
            $my_post['post_status'] = 'trash';

            wp_update_post($my_post);
            
            return 'this post is expired';}
         $exp = get_post_meta($this->post_id, 'expired-date');
       //  $compare = $this->showExpiredDate(); 
         
	
         
}

public function compareDate($format='F j, Y'){ 
	//$exparr=$this->getPostMeta('expired-date');
	$compare = current_time('mysql');
	
	//echo "Date <h1 style='align:right'><pre>".print_r($exp,TRUE)."</pre></h1>";
	//$exp=$exparr['date'];
	
	if(!empty($compare)){
	//$exp=$exp." 23:59:59";
	$compare=$this->changeDateFormat($exp, $format);
	}
	//return $exp;
        
         $exp = $this->showExpiredDate(); 
             
                   // $compare = $this_post->compareDate();
                      if ($exp >= $compare){return TRUE;}else{
                          return FALSE;}
        
        
}
public function getCouponTypeIcons(){
	$type=$this->getPostMeta('coupon-type');
	foreach ($type as $item){ ?>
    <?php if($item=='online'){?>
    <a href="#" class="coupon-view"></a>
    <?php  } ?>
     <?php if($item=='print'){?>
   <a href="#" class="coupon-print"></a>
    <?php  } ?>
     <?php if($item=='mail'){?>
   <a href="#" class="coupon-email"></a>
    <?php  } ?>
     
	<?php }
	
}

public function getRewardsTypeIcons(){
	$type=$this->getPostMeta('rewards-type','FALSE');
foreach($type as $rewards){

	
if($rewards=='gift cards'){
?>
<img src="<?php echo bloginfo('template_url') ?>/images/rewards/survey-gift-img-1.gif" alt="<?php echo ucfirst($rewards); ?>">
<?php 
}
if($rewards=='prizes'){
?>
 <img src="<?php echo bloginfo('template_url')?>/images/rewards/survey-prizes-1.gif" alt="<?php echo ucfirst($rewards); ?>">
<?php 
}
if($rewards=='cash'){
?>
<img src="<?php echo bloginfo('template_url') ?>/images/rewards/survey-cash-1.gif" alt="<?php echo ucfirst($rewards); ?>">
<?php 
}
//if($rewards=='cash prizes'){
?>
<!--    <img src="<?php //echo PLUGIN_TEMPLATE_URL_IMG ?>/survey-cash-prize.gif" alt="<?php// echo ucfirst($rewards); ?>">-->
<?php 
//}
if($rewards=='PayPal'){
?>
<img src="<?php echo bloginfo('template_url') ?>/images/rewards/survey-paypal-1.gif" alt="<?php echo ucfirst($rewards); ?>">
<?php 
}	
if($rewards=='add points'){
?>
<img src="<?php echo bloginfo('template_url') ?>/images/rewards/points-icon-1.png" alt="<?php echo ucfirst($rewards); ?>">
<?php 
}
if($rewards=='cool stuff'){
?>
<img src="<?php echo bloginfo('template_url') ?>/images/rewards/coolstuff-icon.png" alt="<?php echo ucfirst($rewards); ?>">
<?php 
}
 if($rewards=='coupons'){
?>
<img src="<?php echo bloginfo('template_url') ?>/images/rewards/coupons-icon-1.png" alt="<?php echo ucfirst($rewards); ?>">
<?php 
}if($rewards=='freebies'){
?>
<img src="<?php echo bloginfo('template_url') ?>/images/rewards/freesamples-icon-1.png" alt="<?php echo ucfirst($rewards); ?>">
<?php 
}
}
	
}


//forum

public function getPageLink($name){
	
     $pages=get_pages();
	 foreach ($pages as $page){
 	 if($page->post_title==$name){
	 return  get_permalink($page->ID);
	 }
	 
	 }
	 
}

public function getStickyPosts( $cat_name, $top){ ?>
<?php
$cat=new Category();
$cat_id=$cat->getIdByName($cat_name);
global $wpdb;
$today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );

if(!empty($cat_id)){ 
$arg_arr['category__in']=$cat_id;
}
$arg_arr['meta_key'] = 'is-sticky';
$arg_arr['posts_per_page'] = 2;
//$arg_arr['post__not_in']=$excludeposts;
//$arg_arr['meta_query'] = array('key' => 'is-sticky','value' => 'is-sticky','compare' => '=');

wp_reset_query();
$the_query = new WP_Query($arg_arr);
if ($the_query->have_posts()){ ?>
     <div class="post-heading free-samples-head" style='height: inherit;'>
             <h2>Today's Featured Free Samples & Free Stuff for Canadians</h2></div>
<?php if ($top){?>
<?php $themeoptions=new ThemeOptions(); ?>
<div id='div-gpt-ad-<?php echo (stripslashes($themeoptions->get_google_ads('free_loop_channel'))); ?>-0' style='width:728px; height:90px; margin-bottom:20px; '>
<?php display_google_ads($placement='style_header', $identyfier='free'); ?>
</div> 
<?php } ?>
<?php while ($the_query->have_posts() ) : $the_query->the_post();
global $post, $this_post; $this_post=new Post(); ?>
<div style=''>
<?php include (TEMPLATEPATH . '/styles/free-samples/content_sticky.php' );  ?>
</div>
<?php endwhile;}
else return NULL;
?>


<?php }

public function getRelatedAPI($this_id, $cat_id, $post_num=20){ ?>
<?php

global $wpdb;
$today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );

if(!empty($cat_id)){ 
$arg_arr['category__in']=$cat_id;
}
$arg_arr['posts_per_page']=$post_num;
$arg_arr['orderby']='rand';
$arg_arr['post__not_in']=$excludeposts;
$arg_arr['meta_query'] = array(array('key' => 'visibility','value' => 'firstnotdisplay','compare' => 'NOT LIKE'));

wp_reset_query();
$the_query = new WP_Query($arg_arr);

$counter = 0;
$rel = array();
while ($the_query->have_posts() ) : $the_query->the_post();
global $post;
$rel[$counter]['post_id'] .= $post->ID;
$rel[$counter]['post_slug'] .= $post->post_name;
$rel[$counter]['post_title'] .= $post->post_title;
if ($this->getPostImage()==FALSE) {$local_image = Images::getContestFirstImage();}else{ $local_image = $this->getPostImage(FALSE, TRUE);}
//$local_image=Images::getPostImageUrl();
$cloud_image=str_replace ('http://free.ca', 'http://c454621.r21.cf2.rackcdn.com/free.ca',$local_image);
$rel[$counter]['post_image'] .= $cloud_image;
$rel[$counter]['post_permalink'] .= get_permalink($post->slug);

$counter++;
endwhile;
return $rel;
?>
<?php //related titles by cloude tags ends here ?>  


<?php }

public function getRelatedPosts($this_id, $cat_name, $headline='More Like This!', $display=TRUE, $post_num=4){ ?>
<?php


$cat=new Category();
$cat_id=$cat->getIdByName($cat_name);
global $wpdb;
$today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );

if(!empty($cat_id)){ 
$arg_arr['category__in']=$cat_id;
}
$arg_arr['posts_per_page']=$post_num;
$arg_arr['orderby']='rand';
$arg_arr['post__not_in']=$excludeposts;

wp_reset_query();
$the_query = new WP_Query($arg_arr);

if($display&&$the_query->post_count>1){
$this->counter=0;

while ($the_query->have_posts() ) : $the_query->the_post();
global $post;
$each_id=$post->ID;
if($cat_name=="Coupons"){
$this->getRelatedCoupons($this_id, $each_id,  $post_num, $headline);
}
else {
$this->getRelated($this_id, $each_id,  $post_num, $headline);
}
endwhile
?>
<div class="clear"></div>
</div>
<?php }//related titles by cloude tags ends here ?>  


<?php } //end of getRelatedPosts;


private function getRelatedCoupons($this_id, $each_id,  $post_num, $headline){
//$excerpt=$this->getExcerpt();
$save_text=$this->getSaveText();
if($each_id!=$this_id){
$this->counter++;
if($this->counter==1){
?>
<div class="more-coupons related-offers">
<h6><?php echo $headline; ?></h6>
<?php } $this_post=new Post();?>
    <?php // if (($this_post->compareDate())==FALSE){?>
<?php  if($this->counter<$post_num){ ?>
 <div class="coupon-single">
 <?php if($save_text) { ?>
<!-- <div class="save-coupons post-<?php //echo $each_id; ?>">
 <p>save<span><?php //echo $save_text; ?></span></p>
 </div>-->
 <?php } ?>
 <!-- <div class="coupon-image"><a href="<?php //the_permalink(); ?>"><img width="180" height="150" src="<?php //echo $this->getPostImage(TRUE); ?>" alt="<?php //the_title(); ?>"  title="<?php //the_title(); ?>" border="0" ></a></div>-->
 <div class="coupon-image">
     <a href="<?php echo $this->getPermalink(); ?>"><img width="180" height="150" border="0" src="<?php 
  $this_img=new Images();
   if ($this_post->getPostImage()==FALSE) 
       {echo $this_img->get_featured_image(FALSE,TRUE);}else{ echo $this_post->getPostImage(TRUE);} 
  ?>" alt="<?php echo $this->getTitle(); ?>" title="<?php echo $this->getTitle(); ?>" border="0"></a></div>
 <div class="coupon-text">
 <p><?php the_title();    ?>
 </p></div>
 </div>
<?php
//}
 ?>
<?php 
      } 
}
	
	
}

private function getRelated($this_id, $each_id,  $post_num, $headline){
	

//$excerpt=$this->getExcerpt();
$save_text=$this->getSaveText();
if($each_id!=$this_id){
$this->counter++;
if($this->counter==1){
?>
 <div class="more related-offers">
<h6><?php echo $headline; ?></h6>  

<?php } ?>
<?php $this_post=new Post();  
if($this->counter<$post_num){ ?>
 <?php // if (($this_post->compareDate())==FALSE){?>
   <div class="artcl-1"><a href="<?php echo $this->getPermalink(); ?>"><img class="related" width="225" height="188" border="0" src="<?php  
   if ($this_post->getPostImage()==FALSE) {echo Images::get_thumb_225(FALSE,TRUE);}else{ echo $this_post->getPostImage(TRUE);}
         
   ?>" alt="<?php echo $this->getTitle(); ?>" title="<?php echo $this->getTitle(); ?>" ></a></div>

 

<?php 
//} 
}
	
}
}
public function getExcerpt($max=200){
	
$excerpt = strip_tags(get_the_excerpt());
$excerpt=preg_replace('#<p>([^<]*?)</p>#msi', '$1',$excerpt);
//$excerpt=preg_replace('#<strong>([^<]*?)</strong>#msi', '$1',$excerpt);

if($max>0){
$excerpt=$this->get_excerpt_max_charlength($max); 
}

return $excerpt;
}


private function get_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		// echo '[...]';
		echo '';
	} else {
		return $excerpt;
	}
}

public function getContent(){
$content=get_the_content();
$content=preg_replace('#<p>([^<]*?)</p>#msi', '$1',$content);
$content=$this->clearText($content);
return $content;
}

public function clearText($text){
$find[] = 'Ã¢â‚¬Å“'; // left side double smart quote
$find[] = 'Ã¢â‚¬Â'; // right side double smart quote
$find[] = 'Ã¢â‚¬Ëœ'; // left side single smart quote
$find[] = 'Ã¢â‚¬â„¢'; // right side single smart quote
$find[] = 'Ã¢â‚¬Â¦'; // elipsis
$find[] = 'Ã¢â‚¬â€'; // em dash
$find[] = 'Ã¢â‚¬â€œ'; // en dash
$find[] ='â€™';

$replace[] = '"';
$replace[] = '"';
$replace[] = "'";
$replace[] = "'";
$replace[] = "...";
$replace[] = "-";
$replace[] = "-";
$replace[] = "'";
$text = str_replace($find, $replace, $text);
return $text;
}

public function getTitle(){
$title=get_the_title();
return $title;
}

public function getPermalink($type=NULL){
$permalink=get_permalink();
return $permalink;
}




public function getCommentsCount(){
$counter=SocialMedia::getFBCommentCount();
return $counter;
}

public function getIndexPageFeed(){
return SocialMedia::getIndexPageFeed();
}

public function getShareButtons($type=NULL){
	return SocialMedia::getShareButtons($type);
}
public function isShowCoupons($filter){
	$type=$this->getPostMeta('coupon-type');
	$display=0;
	foreach($filter as $show_coupons){
	
if(is_array($type)&&count($type)>0)	{
	//online, print, 	mail
	foreach ($type as $item){ 
	if ($item==$show_coupons){
		$display.=1;
	}
	else{
		$display.=0;
	}
	}
}//if is_array
	}
	if($display>0){
	
	return TRUE;
	}
}

public function displayCouponInCats(){?>


<?php }

public function getCats(){
	$categories = get_the_category($this->post);
	return $categories ;
}

public function isInCategory($category_slug){
	$cats=$this->getCats();
	foreach ($cats as $cat){
		if($cat->slug==$category_slug){
			$check.='y';
		}
		else{
			$check.='n';
		}
	}
	
	if(preg_match('#y#',$check )){
		return TRUE;
	}
	else{
		return FALSE;
	}
	
	
		
}

public function getPostImage($brand=FALSE, $contest_first=FALSE,  $expired=FALSE){
if(!$contest_first){
$image=Images::getPostImageUrl();
if ($brand){
if(empty($image)){
$cat=new Category();
$terms=$this->getTerms('brands');
	
foreach ($terms as $brands){
	$brandimg=$cat->getBrandImage($brands->term_id);
	if(!empty($brandimg)){
		$image=$brandimg;
	}
}//foreach
}//empty image
}//brands
}//!contest_first
else{
	
	$image=Images::getContestForstPageImageUrl();
	if(empty($image)){
		$image=Images::getPostImageUrl(); 
		/*defualt could be used*/ 
		//$image='http://parentdeals.ca/free.ca/wp-content/uploads/default300-200.jpg';
	}
}

 if ($expired==TRUE) {

$image='http://womenfreebies.net/tools/watermark/wm.php?lang=free&src='.$image;
}

return $image;

}


public function getHyperLink(){
return $this->getPostMeta('hyperlink');
}

public function getHyperLinkExpired(){
    if ($this->compareDate()==FALSE){
    return $this->getPostMeta('hyperlink');
        }else{return FALSE;}
}
 
public function getLinkText(){
return $this->getPostMeta('localbtntext');
}

public function getLocalLinkText(){
return $this->getPostMeta('localbtntext');
}
public function getHyperLinkText(){
return $this->getPostMeta('hypertext');
}

public function getBrandLink($display=FALSE){
	$terms=$this->getTerms('brands');
	foreach ($terms as $term){
		$slug=$term->slug;
		$name=$term->name;
	}
	
	if(!empty($slug)){
	$nav=new Navigation();
	$link=$nav->getLink('Brands', 'page');
	$url=$link.$slug;
	if($display){?>
    <p><a href="<?php echo $url; ?>">More from <?php echo $name ; ?>  &raquo;</a></p>
	<?php }
	else{
    return $url;
	}
	}

	
	
}


public function getTerms($name){
$terms = wp_get_post_terms($this->post_id, $name);
return $terms;
}
}

?>