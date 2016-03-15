<?php $this_user = new User(); 
$user_name=$this_user->user_name(); 
$user_description=$this_user->user_description();?>
<div class="seo-description">
<h1><?php echo $user_name; ?></h1>

<p><?php echo $user_description ?></p>



</div>

