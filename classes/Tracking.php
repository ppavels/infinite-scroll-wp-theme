<?php

 class Tracking {
   
    private $baseurl;
    private $timeout;
    private $permalink;
    private $post_id;
  
    public function __construct($permalink, $social_network=NULL) {
        
       	$this->baseurl = 'http://api.womanfreebies.com/v1/?api_key=1qA34-810&country=us&action=tracking&save_tracks=1&url=';
        $this->timeout = 10;
        $this->permalink = $permalink;
        
        $this->post_id = url_to_postid( $permalink );
        
    }
    	
    public function getTotalShare(){
        $url = $this->baseurl.$this->permalink;
        $response = $this->file_get_contents_curl($url);
        $obj = json_decode($response);
        return $obj->message->shares;
        
	}
	
	public function updateTotalShare($shares_number=NULL){
		
		if($shares_number!=NULL&&is_numeric($shares_number)){
			
			$share=$shares_number;
		}
		else{
			$share=$this->getTotalShare();
		}
		
		update_post_meta($this->post_id, 'total_shares', $share);
		
		
	
	
	}
        
    private function file_get_contents_curl($url) {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        $cont = curl_exec($ch);
        if (curl_error($ch)) {
            die(curl_error($ch));
        }
        return $cont;
}    
    
public function displayShares($remote=FALSE){
    
    if (!$remote){
        $str = get_post_meta($this->post_id, "total_shares", true);
    }else{
        $str = $this->getTotalShare();
    }
        if ($str == '') $str = 0;
        if (is_numeric($str)) {
            
            if ((strlen($str) >= 4) && (strlen($str) < 7) ) {

                $res = (round($str / 1000, 1));
                return $res . 'K';
            }
            if ((strlen($str) >= 7) && (strlen($str) < 10) ) {

                $res = (round($str / 1000000, 1));
                return $res . 'M';
            }
            else {
                return $str;
            }
        }else{
            return 0;
        }
    }
}
	
 ?>