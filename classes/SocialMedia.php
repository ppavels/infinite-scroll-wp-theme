<?php class SocialMedia {


public function __construct(){



}

public static function getFBCommentBox($width=null, $post_num=10){
global $post;
$permalink=get_permalink($post->ID);

if(empty($width)||!is_int($width)){
$width=730;	
}

?>

<div id="comments" class="commentbox">
<div  style="clear:both" class="fb-comments" data-href="<?php echo $permalink; ?>" data-num-posts="<?php echo $post_num; ?>" data-width="<?php echo $width; ?>"></div>
</div>


<?php
}

public static function getFBCommentCount(){
//
global $post;
$permalink=get_permalink($post->ID);

?>
<fb:comments-count href=<?php echo $permalink; ?>></fb:comments-count>
<?php }

public function getVerticalFeed(){
?>
<div class="newmedia_btns">
          <div style=" position:relative; z-index:1; margin:12px 0 12px 15px  ">
            <script type="text/javascript">_ga.trackFacebook();</script>
            <fb:like send="false" layout="box_count" action="like" font="tahoma" href="<?php the_permalink(); ?>?fb=LikeButton"></fb:like>
          </div>
            
            <div style="margin:0 0 12px 10px"><script type="text/javascript">_ga.trackTwitter();</script><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink() ?>" data-text="<?php the_title() ?>" data-count="vertical" <?php echo $data_via; ?> ></a>
              <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
            </div>
           
          <div style="margin:0px 0 12px 14px">
            <g:plusone size="tall" annotation="bubble" href="<?php the_permalink(); ?>"></g:plusone>
           
          </div>
          <div style="margin:40px 0px 0px 19px" onClick="_gaq.push(['_trackSocial', 'Pinterest', 'Pin', '<?php the_permalink();?>']);" ><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&media=<?php echo $pinimg; ?>&description=<?php the_title() ?>" class="pin-it-button" count-layout="vertical"></a></div>
        </div> 
<?php
}

public function getShareButtons($type=NULL){ $this_post=new Post();
    if($type!='Contests'){ ?>
<div style="margin-left: -35px !important;padding-left: 35px; position: absolute; width: 150px;">
    <a href="<?php echo SocialMedia::getEmailShareLink(); ?>" class="contest-mail"></a>
    <?php if($type!='Coupons') { /*?>
    <a href="<?php echo SocialMedia::getGooglePlusShareLink(); ?>" class="contest-plus"></a>
    <?php */ } ?>
    <a href="<?php echo SocialMedia::getTwitterShareLink(); ?>" class="contest-twitter"></a>
   <?php /* ?> <a href="<?php echo SocialMedia::getPinterestShareLink(); ?>" class="contest-pin"></a> <?php */ ?>
    <a href="<?php echo SocialMedia::getFacebookShareLink(); ?>" class="contest-fb"></a></div>
 <?php  }
   else {?>
   
  <?php /* ?><a href="#"><img src="<?php echo get_template() ; ?>/images/fb-link.png" alt="" /></a><?php */?>
    <div style="margin-left: -35px !important;padding-left: 35px; position: absolute; width: 150px;">
  <a target="_blank" rel="nofollow" style="margin-left: -70px !important;" href="<?php echo SocialMedia::getFacebookShareLink(); ?>"><img src="<?php echo get_template_directory_uri() ; ?>/images/fb-link.png" alt="" /></a>
  <a  target="_blank" rel="nofollow" style="margin-right: -70px !important;" href="<?php echo SocialMedia::getEmailShareLink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/email-link.png" alt="" /></a>
<a target="_blank" rel="nofollow" style="margin-left: -40px !important;" href="<?php echo SocialMedia::getTwitterShareLink(); ?>" class="contest-twitter twitter  popup"><img src="<?php echo get_template_directory_uri() ; ?>/images/twtr-link.png" alt="" /></a>
    </div>
 
 <?php  }
   
  }


public function getFacebookShareLink(){
	return "http://www.facebook.com/sharer.php?u=".get_permalink()."?fb=ShareButton&t=". strip_tags(get_the_title());

}
public function getGooglePlusShareLink(){
	return "#";

}
public function getTwitterShareLink(){
	return "http://twitter.com/share?text=".strip_tags(get_the_title()) ." ";  urlencode(get_permalink());

}
public function getPinterestShareLink(){
	$link= '<a href="//pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.flickr.com%2Fphotos%2Fkentbrew%2F6851755809%2F&media=http%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&description=Next%20stop%3A%20Pinterest" data-pin-do="buttonPin" data-pin-config="none"><img src="//parentdeals.ca/free.ca/wp-content/themes/free.ca/images/contest-pin.gif" /></a>';
	$link="#";
	return $link;

}
public function getEmailShareLink(){
	return "mailto:?subject=". strip_tags(get_the_title())."&Body=".strip_tags($content)." Check it out: ". get_permalink();

}

public function getBrandButtons(){
    $term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ));
    $cat=new Category(); 
    $facebook = $cat->get_term_meta($term->term_id, 'brand-facebook-page', true);
    $twitter = $cat->get_term_meta($term->term_id, 'brand-twitter-page', true);
    $pinterest = $cat->get_term_meta($term->term_id, 'brand-pinterest-page', true);
    $youtube = $cat->get_term_meta($term->term_id, 'brand-youtube-page', true);
    $google = $cat->get_term_meta($term->term_id, 'brand-google-page', true);
   
   
    if ($facebook!=NULL){
?>
<a href="<?php echo $facebook ?>" target="_blank" rel="nofollow" ><img src="<?php bloginfo('template_url') ?>/images/socialpics/facebook.png"></a>
<?php 
}
    if ($twitter!=NULL){
?>
<a href="<?php echo $twitter ?>" target="_blank" rel="nofollow" ><img src="<?php echo bloginfo('template_url') ?>/images/socialpics/twitter.png"></a>
<?php 
}
    if ($pinterest!=NULL){
?>
<a href="<?php echo $pinterest ?>" target="_blank" rel="nofollow" ><img src="<?php echo bloginfo('template_url') ?>/images/socialpics/pinterest.png"></a>
<?php 
}
    if ($youtube!=NULL){
?>
<a href="<?php echo $youtube ?>" target="_blank" rel="nofollow" ><img src="<?php echo bloginfo('template_url') ?>/images/socialpics/youtube.png"></a>
<?php 
}
    if ($google!=NULL){
?>
<a href="<?php echo $google ?>" target="_blank" rel="nofollow" ><img src="<?php echo bloginfo('template_url') ?>/images/socialpics/googleplus.png"></a>
<?php 
}
}

public function getIndexPageFeed(){ global $post;
?>


<div class="fbindx" style="float:left; margin:3px 5px 0 3px;  " ><div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
</div>
<div class="pinindx" style="float:left; margin:3px 10px 0 5px"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo Images::get_pinterest_image_url();?>&description=<?php the_excerpt(); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>

<div class="twindx" style="float:left; margin:3px 15px 0 3px; width:75px" ><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-via="FreeDotCA" data-lang="en" data-text="<?php the_excerpt() ;?>" >&nbsp;</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div> 

<div class="gplusindx" style="float:left;  width:70px"><div class="g-plusone" data-href="<?php the_permalink(); ?>"></div></div>

<?php }

}
?>