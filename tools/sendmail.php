<?php
/**
 * Contact Widget Form Submit
 */
 
function pavel_zhzhet($name, $email,$website,$company,$phone,$budget,$title){

$mail_to = 'jordan.nabigon@adjump.com';
//$mail_to = 'pavel@cordiapower.com';   
$mail_subj = 'advertising request from Free.ca';

if (isset($_POST['add_comm'])) {
if (strlen($inquiry = (strip_tags(trim($_POST['add_comm'])))) > 10) {
$inquiry = substr($inquiry, 0, 10);
}if ($inquiry == 'Additional')$inquiry = '';
$inquiry = "\r\nAdditional Comments: " . $inquiry;
} else {
$inquiry = '';
}

if(isset($_POST['facebook'])) {$buying_media.=' facebook,';} 
if(isset($_POST['google'])) {$buying_media.=' google,';} 
if(isset($_POST['other_ad_exchange'])) {$buying_media.=' other ad exchange,';} 
if(isset($_POST['blogs'])) {$buying_media.=' blogs,';} 
if(isset($_POST['agency'])) {$buying_media.=' agency,';} 
if(isset($_POST['not_buying'])) {$buying_media.=' not_buying,';} 
if (($_POST['other'])=='Other') $_POST['other'] = '';
if(isset($_POST['other'])) {$buying_media.=($_POST['other']);}
if ($title=='Title')$title='';
$message = "From: ".$title.$name."\r\nEmail: ".$email."\r\nWebsite URL: ".$website."\r\nCompany: ".$company."\r\nPhone: ".$phone."\r\nBudget: ".$budget.
        $inquiry."\r\nBuying Media: ".$buying_media;
    

//%s\r\nBudget: %s %s";





 

// Preparing email message
$headers = 'From: Free.ca <'.$mail_to.'>' . "\r\n" . 'Reply-To: ' . $email;
$result = @ mail($mail_to, $mail_subj, $message, $headers);
if(! $result) {
	die('202');
}else{
   // echo "101";
    
    }

// compose mail to client

$headers = 'From: Free.ca <advertising@free.ca>' . "\r\n" . 'Reply-To: ' . $mail_to;
$mail_subj = 'Thanks for your request, '. $name;
$body = 'We will get back to you soon as we can.';
@ mail($email, $mail_subj, $body, $headers);
//echo $inquiry;
//file_put_contents('error.txt', error_get_last());
exit("101");
}