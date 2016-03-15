<?php
require_once(TEMPLATEPATH . '/tools/array_to_query.php');

	define('HTTP_UA_MOZILLA2', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-GB; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7');
	define('HTTP_UA_IE7', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.0.590)');
	define('HTTP_UA_HTTP_Client', 'HTTP Client');
	
	class HTTP_Client
	{
		var $cookj;
		
		function HTTP_Client()
		{
			$this->cookj = tempnam('/tmp', 'http_client_');
			$this->sendFiles = false;

			$this->headers = array();	// headers to send OUT
			
			$this->status_code = 0;
			
			register_shutdown_function(array(&$this, 'myDestructor'));
			
			$this->ua = HTTP_UA_HTTP_Client;
		}
		
		function myDestructor()
		{
			if (file_exists($this->cookj))
				unlink($this->cookj);
		}
		
		
		function resetCookies()
		{
			if (file_exists($this->cookj))
				unlink($this->cookj);
				
			$this->cookj = tempnam('/tmp', 'http_client_');
		}
		
		function getCookieData()
		{
			return file_get_contents($this->cookj);
		}
		
		function setCookieData($data)
		{
			$f = fopen($this->cookj, 'w');
			fwrite($f, $data);
			fclose($f);
		}
		
		function post($url, $postFields, $usecook = true, $followLoc = 1, $userAgent = false, $referer = false)
		{
			if (empty($userAgent))
				$userAgent = $this->ua;
				
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $followLoc);

			if (!empty($referer))
				curl_setopt($ch, CURLOPT_REFERER, $referer);
			
			if ($usecook)
			{
				curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookj);
				curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookj);
			}
			
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->sendFiles ? $postFields : array_to_query_string($postFields));
			
			// if we have custom headers
			if (!empty($this->headers))
			{
				$headers = array();
				
				foreach ($this->headers as $k => $v)
					$headers[] = $k .': '. $v;
					
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			}
			
			$res = curl_exec($ch);
			
			$this->status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			
			curl_close($ch);
			
			return $res;
		}
		
		function postFiles($url, $postFields, $usecook = true, $followLoc = 1, $userAgent = false, $referer = false)
		{
			$this->sendFiles = true;	// turn file sending on
			
			$res = $this->post($url, $postFields, $usecook, $followLoc, $userAgent, $referer);
			
			$this->sendFiles = false;	// now turn it off
			
			return $res;
		}
		
		function get($url, $getFields = array(), $usecook = true, $followLoc = 1, $userAgent = false, $referer = false)
		{
			if (empty($userAgent))
				$userAgent = $this->ua;
				
			// Add $getFields
			// $toSend = array();
			
			// foreach ($getFields as $k => $v)
				// $toSend[] = urlencode($k) .'='. urlencode($v);
				
			if (!empty($getFields))
			{
				//$qs = implode('&', $toSend);
				$qs = array_to_query_string($getFields);
				
				if (strpos($url, '?') === false)
					$url .= '?' . $qs;
				else
					$url .= '&' . $qs;
			}

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $followLoc);

			if (!empty($referer))
				curl_setopt($ch, CURLOPT_REFERER, $referer);
			
			if ($usecook)
			{
				curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookj);
				curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookj);
			}
			
			// if we have custom headers
			if (!empty($this->headers))
			{
				$headers = array();
				
				foreach ($this->headers as $k => $v)
					$headers[] = $k .': '. $v;
					
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			}

			
			$res = curl_exec($ch);
			
			$this->status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			
			curl_close($ch);
			
			return $res;
		}
		
	}

?>