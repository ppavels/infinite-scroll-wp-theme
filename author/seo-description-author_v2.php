<?php $this_user = new User(); 
$user_name=$this_user->user_name(); 
$user_description=$this_user->user_description();
$user_id=$this_user->user_id();
?>



<div class="category_info_author" style="float:left">
    <div id="meet_the"></div>
<div id='author_photo'>
  <img src="<?php echo esc_attr( get_the_author_meta( 'user_pic', $user_id ) ); ?>">
</div>
        <div id="seo_description_category_info_author">
    <h1><?php //echo $user_name; ?></h1>
<p><?php echo $user_description; ?></p><br />
<p>Here are some of my favourite brands:</p>
</div>
<div id="fav_brands">
<a href="http://free.ca/brands/gap/" id="red_brand">Gap</a>
<a href="http://free.ca/brands/american-eagle/" id="yello_brand">American Eagle</a>
<a href="http://free.ca/brands/aldo/" id="blue_brand">Aldo</a>
<a href="http://free.ca/brands/dove/" id="pink_brand">Dove</a>
</div>
<!--        </div>-->
</div> 