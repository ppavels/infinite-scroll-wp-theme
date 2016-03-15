<div class="social-icons"> 
    <?php  $themeoptions=new ThemeOptions(); ?>
    
    <?php if ($themeoptions->get_theme_settings('facebook')!=NULL) {?>
<a href="<?php echo (stripslashes($themeoptions->get_theme_settings('facebook')));  ?>" class="facebook" target="_blank" rel="nofollow">Facebook</a> <?php } ?>
    
    <?php if ($themeoptions->get_theme_settings('pinterest')!=NULL) {?>
<a href="<?php echo (stripslashes($themeoptions->get_theme_settings('pinterest')));  ?>" class="pin" target="_blank" rel="nofollow">Pin</a> <?php } ?>
    
    <?php if ($themeoptions->get_theme_settings('twitter')!=NULL) {?>
<a href="<?php echo (stripslashes($themeoptions->get_theme_settings('twitter')));  ?>" class="twitter" target="_blank" rel="nofollow">Twitter</a><?php } ?>
    
    <?php if ($themeoptions->get_theme_settings('google')!=NULL) {?>
<a href="<?php echo (stripslashes($themeoptions->get_theme_settings('google')));  ?>" class="plus" rel="nofollow">Google Plus</a> <?php } ?>
<a href="<?php bloginfo('rss2_url'); ?>" class="rss" target="_blank">Rss</a>
    
    <?php if ($themeoptions->get_theme_settings('email')!=NULL) {?>
<a href="<?php echo (stripslashes($themeoptions->get_theme_settings('email')));  ?>" class="mail" target="_blank" rel="nofollow">Mail</a> <?php } ?>
</div>