<?php
/**
 * @package WP email
 
 * @author Constantine
 
 
 * @version 1.0
 */

/*

Description: Change the default address that WordPress sends it&rsquo;s email from.
Version: 1.0
Author: Constantine
Author URI: http://freestuffblog.com
Last Change: 22.08.2012 12:23:12
*/

if ( !function_exists('add_action') ) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

if ( !class_exists('wp_mail_from') ) {
	class wp_mail_from {

		function wp_mail_from() {
			add_filter( 'wp_mail_from', array(&$this, 'fb_mail_from') );
			add_filter( 'wp_mail_from_name', array(&$this, 'fb_mail_from_name') );
		}

		// new name
		function fb_mail_from_name() {
			$url=get_option('home');
			$url=str_replace("http://", "", $url);
			$urls=explode(DS,$url); 
			$name=ucwords($url);
						  
			//$name = 'FREE FOR HIM';
			// alternative the name of the blog
			// $name = get_option('blogname');
			$name = esc_attr($name);
			return $name;
		}

		// new email-adress
		function fb_mail_from() {
			$email = 'free4him@free4him.com';
			$email = is_email($email);
			return $email;
		}

	}

	$wp_mail_from = new wp_mail_from();
}
?>