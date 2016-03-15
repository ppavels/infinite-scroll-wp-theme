<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php if (is_home()){ ?>
<link rel="author" href="https://plus.google.com/u/0/103437815855594538224/posts" />
<?php } ?>
<?php require (TEMPLATEPATH . '/header/metatags.php' ); ?>
<?php if( is_single()||is_author()){require (TEMPLATEPATH . '/header/author.php' );} ?>
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.png" type="image/x-icon" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php require (TEMPLATEPATH . '/header/css.php' ); ?>
<?php require (TEMPLATEPATH . '/header/javascript.php' ); ?>
<?php require (TEMPLATEPATH . '/header/title.php' ); ?>
<?php if(!is_404()){ ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<?php require (TEMPLATEPATH . '/header/googleads.php' ); ?>
<?php } ?>
<?php  $themeoptions=new ThemeOptions(); ?>
<?php echo (stripslashes($themeoptions->get_theme_settings('header')));  ?>

</head>