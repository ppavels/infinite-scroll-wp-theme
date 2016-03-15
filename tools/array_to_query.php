<?php
	function array_to_query_string($arr, $prefix = '')
	{
		$res = array();
		
		foreach ($arr as $k => $v)
			if (is_array($v) || is_object($v))
			{
				$new_prefix = empty($prefix) ? urlencode($k) : $prefix .'['. urlencode($k) .']';
				$res[] = array_to_query_string($v, $new_prefix);
			}
			else
			{
				if (empty($prefix))
					$res[] = urlencode($k) .'='. urlencode($v);
				else
					$res[] = $prefix .'['. urlencode($k) .']='. urlencode($v);
			}
				
		return implode('&', $res);
	}
?>