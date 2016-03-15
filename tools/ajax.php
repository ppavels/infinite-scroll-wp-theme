<?php 

function sendStarbucksAjax(){
	ob_clean();
	
	if(isset($_POST['fname'])){
		$fname=$_POST['fname'];
    }
	if(isset($_POST['email'])){
		$email=$_POST['email'];
    }
	if(isset($_POST['zip'])){
		$zip=$_POST['zip'];
    }
	if(isset($_POST['pinners'])){
		$pinners=$_POST['pinners'];
    }
	if(isset($_POST['url'])){
		$url=html_entity_decode($_POST['url']);
    }
	
	if (!validateName($fname)||$fname=="First Name"){
			echo '-1';
			
	}
	else if (!validateEmail($email)){
			echo '-2';
	}
	else if (!validateZip($zip)){
			echo '-3';
	}
	else{
		//action=send_starbucks_ajax&fname='+fname+'&email='+email+'&zip='+zip+'&pinners='+pinners+'&url='+url
		
$ems = new EMSPoster();
$data_ems['email']=$email;
$data_ems['fname']=$fname;
$data_ems['zip']=$zip;
$data_ems['pinners']=$pinners;
$data_ems['url']=$url;
$ems_id = 1;
$list = 185;

//$ems->post($ems_id, $data_ems, $list);
//echo 'http://signup.womanfreebies.com/thankyou.php';

echo 1;
	}
   
	die();
}

function validateEmail($email){
if (preg_match(
'/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',
$email)) {
return TRUE;
}
else{
return FALSE;
}
}

function validateZip($zip, $canadian=FALSE){
	
if(!$canadian){	

if (preg_match('/^\d{5}(-\d{4})?$/i',
$zip)) {
return TRUE;
}

else{
return FALSE;
}

}

else{

if (preg_match('/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]( )?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i',
$zip)) {
return TRUE;
}
else{
return FALSE;
}
}

}

function validateName($name){

if (preg_match('/^[A-Z a-z\-ÀÂÄÈÉÊËÏÔÒÖÙÛÜÇçàâäèéêëïôòöùûü]{1,}$/i',
$name)) {
return TRUE;
}
else{
return FALSE;
}

}
add_action("wp_ajax_send_starbucks_ajax", "sendStarbucksAjax");
add_action('wp_ajax_nopriv_send_starbucks_ajax', 'sendStarbucksAjax');

require(TEMPLATEPATH . '/tools/ems_poster.php');




 //add_action('wp_ajax_send_starbucks_ajax', 'sendStarbucksAjax');
?>
