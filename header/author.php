<?php
$post_tmp = get_post($post_id);
$user_id = $post_tmp->post_author;
$google_acc=get_the_author_meta( 'google_acc', $user_id); 
if($google_acc!=""){
?>
<link rel="author" href="<?php echo esc_attr( $google_acc); ?>" />
<?php }?>