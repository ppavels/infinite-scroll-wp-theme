<?php 

//this is custom login page
 add_action( 'login_enqueue_scripts', 'wf_login_enqueue_scripts' );
function wf_login_enqueue_scripts(){
	
$template_url=get_template_directory_uri();
echo '<style type="text/css" media="screen">';
echo 'html{background:none repeat scroll 0 0 #c4e1f9 !important; height:700px}';
echo 'body.login{background:#c4e1f9 url("'.$template_url.'/images/admin_bg_1.png") center top no-repeat; }';
echo 'p.message, #login_error{margin-bottom:0 !important;
background: none repeat scroll 0 0 #FFFFFF !important; 
 border-radius: 0px;
box-shadow: 0 0px 0px 0px rgba(200, 200, 200, 0.7);
border: 1px solid #E5E5E5 !important; border-bottom:none !important;border-top:none !important;color:#777777 !important; font-style:italic}
#login_error{color:red !important; font-style:normal}
.login #nav a, .login #backtoblog a {
    color: #545137 !important;
}
#nav, #backtoblog {
    margin: 0;
    padding: 0;
    text-shadow: 0 1px 0 #FFFFFF;
	margin-top: 20px;
}
#loginform{margin-top: -25px;width: 263px;}
#nav{float:right !important; padding-right:16px }
#backtoblog{float:right !important; padding-right:16px}
';
echo '#login form#loginform p.submit input#wp-submit{border:none; background:url("'.$template_url.'/images/grey/login_btn.png") no-repeat center center; width:122px; height:31px}';
echo '#login h1 a{background:url("'.$template_url.'/images/admin_logo.png") 0px 0px no-repeat; z-index:1000; position:relative; height: 99px; width:320px; padding:0; overflow: visible !importan;}';
echo '#lostpasswordform, #loginform, #registerform {border-top:none; border-radius: 0px 0 5px 5px ; box-shadow: 0 0px 0px 0px rgba(200, 200, 200, 0.7);}';
echo ' </style>';
}
add_filter( 'login_headerurl', 'wf_login_headerurl');
function wf_login_headerurl(){
	return home_url('/');
}





?>