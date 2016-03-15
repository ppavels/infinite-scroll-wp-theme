<?php class FBcomments {


public function __construct(){

}

public static function getCommentBox($width=null, $post_num=10){
global $post;
$permalink=get_permalink($post->ID);

if(empty($width)||!is_int($width)){
$width=730;	
}

?>

<div id="comments" class="commentbox">
<div class="fb-comments" data-href="<?php echo urlencode($permalink); ?>" data-num-posts="<?php echo $post_num; ?>" data-width="<?php echo $width; ?>"></div>
</div>
<div class="spacer"></div>

<?php
}

public static function getCommentCount(){
//
global $post;
$permalink=get_permalink($post->ID);

?>
<fb:comments-count href=<?php echo $permalink; ?>></fb:comments-count>
<?php }



}


?>