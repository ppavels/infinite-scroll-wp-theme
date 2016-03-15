<?php 
/**
 * Contact Widget Form Submit
 */
$mail_to = 'jaclyn.davis@adjump.com, jordan.nabigon@adjump.com';
$mail_subj = 'advertising request from WomanFreebies.com';
$message = "From: %s\r\nEmail: %s\r\nWebsite URL: %s\r\nBudget: %s %s";

function is_valid($aFields, $result = array()) {
	foreach ($aFields as $field => $regexp) {
		if (! isset($_POST[$field]) || strlen($val = trim($_POST[$field])) == 0) {
			return $field;
		} else if (! empty($regexp) && ! preg_match($regexp, $val)) {
			return $field;
		}
		$results[$field] = $val;
	}
	return $results;
}

// attempt to call script without ajax request
if (! isset($_POST['dosubmit']) || $_POST['dosubmit'] !== 'true') {
	die();
}

// Preparing inquiry string
if (isset($_POST['inquiry'])) {
	if (strlen($inquiry = (strip_tags(trim($_POST['inquiry'])))) > 1000) {
		$inquiry = substr($inquiry, 0, 1000);
	}
	$inquiry = "\r\nInquiry: " . $inquiry;
} else {
	$inquiry = '';
}

// Checking post fields. Step 1
if (is_array($results = is_valid(array
	(	'name' => '',
		'email' => '/^[A-Z0-9\._%-]+\@[A-Z0-9\._%-]+\.[A-Z]{2,4}$/i',
		'url' => '',
		'budget' => '',
	) ))) {
	extract($results);
} else {
	die($results);
}

// Preparing email message
$headers = 'From: WomanFreebies.com <'.$mail_to.'>' . "\r\n" . 'Reply-To: ' . $email;
$result = @ mail($mail_to, $mail_subj, sprintf($message, $name, $email, $url, $budget, $inquiry), $headers);
if(! $result) {
	die('failed');
}

// compose mail to client
$headers = 'From: WomanFreebies.com <advertising@womanfreebies.com>' . "\r\n" . 'Reply-To: ' . $mail_to;
$mail_subj = 'Thanks for your request '. $name;
$body = 'We will get back to you soon as we can.';
@ mail($email, $mail_subj, $body, $headers);
//file_put_contents('error.txt', error_get_last());
die('success');
