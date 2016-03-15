<?php if(!is_404()){ ?>
<?php /* ?><link rel="stylesheet" href="<?php bloginfo('template_url');  ?>/style.css" type="text/css" /><?php */ ?>
<?php  ?><link rel="stylesheet" href="<?php bloginfo('template_url');  ?>/style-dev.css" type="text/css" /><?php  ?>
<?php if(is_author()){ ?>
<link rel="stylesheet" href="<?php bloginfo('template_url');  ?>/css/author.css" type="text/css" />
<?php } ?>
<?php } else { ?>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php  bloginfo('template_url');  ?>/404.css" type="text/css" />
<?php } ?>