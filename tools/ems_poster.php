<?php

   require_once(TEMPLATEPATH . '/tools/http_client.php');

	
	
	class EMSPoster
	{
		function EMSPoster()
		{
			$this->htc = new HTTP_Client();
			
			$this->key = 'd05d950a-5b74-470e-9b74-570e5b74570e';
		}
		
		function post($acc, $data, $list)
		{
			if (!is_array($list) && $list !== false)
				$list = array($list);
				
			$data['ip'] = $_SERVER['REMOTE_ADDR'];
			
			$res = $this->htc->post('http://4td.me/add.php', array('key' => $this->key, 'id' => $acc, 'data' => $data, 'list' => $list));
			
			return $this->htc->status_code == 200;
		}
	}
?>