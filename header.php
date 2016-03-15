<?php 
	if(is_page('API')){ $path = TEMPLATEPATH. '/api/index.php';
		if(file_exists($path)){
				
		include ($path);
	     
		}else{
			exit($path.' not exists');
		}
		exit();
	} 
?>
<?php require (TEMPLATEPATH . '/header/head.php' ); ?>
<body>

<?php if(!is_404()){ ?>

<?php require (TEMPLATEPATH . '/header/facebookjs.php' ); ?>

<div id="wrapper"> 
<!--header-->
<div id="header">
    <p style="float: right"><a href="http://free.ca/signup/privacy.html">Privacy Policy</a> | <a href="http://free.ca.local/docs/terms-and-conditions.html">Terms & Conditions</a></p>
<a href="<?php echo get_option('home'); ?>" class="logo">Free.ca</a>
<?php include (TEMPLATEPATH . '/socialmedia/headerbuttons.php' ); ?>
<?php include (TEMPLATEPATH . '/searchform.php' ); ?>
</div>
  
<!--/header--> 
<!--menu-->
<?php $menu=new Menu(); echo $menu->getMainNav(); ?>
<!--/menu-->
<!--Ad-2-->
<?php include (TEMPLATEPATH . '/top_banners/index.php'); ?>
<?php }  ?>

