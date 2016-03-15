<?php
$themeoptions=new ThemeOptions();
echo (stripslashes($themeoptions->get_theme_settings('analitycs')));
display_google_ads('header');
?>