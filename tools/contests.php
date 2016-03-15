<?php 

//EASTER RANDOM EGG PROJECT VALID UNTIL April 9, 2012 could be removed or commented after

function wp_check_delay($filename, $sec){
	
	
if (file_exists($filename)) {
  $lastmodified=date ("F d Y H:i:s", filemtime($filename));
  $strtotime=strtotime($lastmodified);
  $now=time();
  $difference=$now-$strtotime;
  $wait=$sec-$difference;
  //echo "$filename was last modified: " .$lastmodified." strtotime=".$strtotime ;
  $output=$wait;
}
else{
	$output=0;
}
return $output;
}
function wf_get_random_id(){
	
	
	//$custom_post_number=trim(get_option('adjump_custom_post'));
	//if(empty($custom_post_number)){
		$custom_post_number=20;
	//}
	$rand_number=rand(1, $custom_post_number);
	$myposts = get_posts('numberposts='.$custom_post_number);
	$i=1;
	foreach( $myposts as $post ){
	if($i==$rand_number){
	$rand_id=$post->ID;
	}
	$i++;
	}
	return $rand_id;
}

function wf_webcheck ($url) {
        $ch = curl_init ($url) ;
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;
        $res = curl_exec ($ch) ;
        curl_close ($ch) ;
        return $res ;
}

function wf_get_path_to_log($file){
	$upload_dir = wp_upload_dir();
	$filename= $upload_dir['basedir']."/2012/".$file;
	return $filename;
}


//added for cached pages start//
function wf_display_permalink_egg($permalink){
	
	$custom_rand=trim(get_option('adjump_custom_rand'));
	if(empty($custom_rand)){
		$custom_rand=10;
	}
	$hash=md5('egg');
	$filename=wf_get_path_to_log($hash.'.txt');
	$rand_id=wf_get_random_id();
	$delay=120;
	
	if(get_option('adjump_testmode')=='yes'){
		$testmode='1';
	}
	else {
		$testmode='0';
	}
	if($testmode=='1'){
	
	
	$rand_id=23109;
	$delay=0;
	$custom_rand=1;
	
	}
	$rand_times=rand(1, $custom_rand);
	$last_mod=wp_check_delay($filename, $delay);
	$rand_permalink=get_permalink($rand_id);
	
	
	
if ($rand_times==1&&$permalink==$rand_permalink){
	
	if($last_mod<=0){	
	$contest_link=get_option('adjump_contest_link');
	$submited=wf_webcheck($contest_link.'?ip='.$_SERVER['REMOTE_ADDR']);
	if ($submited!=-1){

	
	$link = wf_get_egg_url($submited);
	$feedback = unserialize($submited);
	if (isset($feedback['golden'])){
		$imgsrc=get_option('adjump_contest_image_gold');
	}
	else{
		$imgsrc=get_option('adjump_contest_image');
	}
	
	 if (!empty($feedback)) { 
	$output="<a href='".$link."' onclick=\"TINY.box.show({iframe:'".$link."',boxid:'frameless',width:800,height:650,fixed:true,maskid:'blackmask',maskopacity:40}); return false;\"><img style='float:right' src='".$imgsrc."' alt='' title=''  border='0' /></a>";

	wf_egg_log_views($filename);
	}
	}
	
		
	}
}
else{
	
	$output="";
}
if($testmode=='1'){
	
	if($permalink=='http://womanfreebies.com/general-freebies/johnsonville-coupon-2/'){

	 $output.="<br/>custom_rand number 1 out of ".get_option('adjump_custom_rand')."<br/>rand_post_id=".$rand_id."<br/>     custom_rand_post 1 out of ".get_option('adjump_custom_post');
     $output.="<br/>rand number generated ".$rand_times;
	 $output.="<br/>rand permalink generated ".$rand_permalink;
	 $output.="<br/>this permalink  ".$permalink;
	 $output.="<br/>last_mod  ".$last_mod;
	 $output.="<br/>filename  ".$filename;
	 $output.="<br/>submited ".$submited;
	 $output.="<br/>image src ".get_option('adjump_contest_image');
	 $output.="<br/>golden image  src ".get_option('adjump_contest_image_gold');
	 $output.="<br/>contest link ".get_option('adjump_contest_link');
	 
	
	}
}
	
	
	return $output;
}

function wf_cryptX($data)
	{
		$res = '';
		
		$sz = strlen($data);

		$prng = new PRNG(5555 + $sz);
		
		$old = 0;
		
		for ($i = 0; $i < $sz; $i++)
		{
			$ch = ord($data[$i]);
			
			$old = $ch ^ $old ^ ($prng->random() % 256);
			
			$res .= chr($old);
		}

		return $res;
	}
	

    function wf_egg_log_views($filename){
	
   
	 if (!$handle = fopen($filename, 'a')) {
        // echo "Cannot open file ($filename)";
         exit;
    }
	$date=date('F d Y H:i:s');
	date("F d Y H:i:s", strtotime("$date - 4 hours"));
	$somecontent=$_SERVER['REMOTE_ADDR']." ";
	$somecontent.=date("F d Y H:i:s", strtotime("$date - 4 hours"))."\n";
	


	if (fwrite($handle, $somecontent) === FALSE) {
        //echo "Cannot write to file ($filename)";
        exit;
    }
    fclose($handle);
	
}
	
	function wf_get_egg_url($daydata)
	{
		
		
		$dd = unserialize($daydata);
		
		$lid = wf_cryptX (serialize(array('rnd' =>$dd['rnd'], 'verify' => 'AdJump', 'day' => $dd['day'], 'day_count' => $dd['count'])));
		
		return 'http://win.womanfreebies.com/?lid='. rawurlencode($lid);
	}





	class PRNG
	{
		var $x_rand;
		var $x_seed;

		//Constants
		var $M;
		var $K;

		function PRNG($xSeed = 1)
		{
			$this->x_seed = $xSeed;
			$this->x_rand = $xSeed;
			
			$this->M = 2828363;
			$this->K = 599;
		}

		function setK($xK)			// Set new K
		{
			$this->K = $xK;
		}

		function setSeed($xSeed)	// Sets new seed
		{
			$this->x_seed = $xSeed;
			$this->x_rand = $xSeed;
		}

		function getSeed()						// Get original seed
		{
			return $this->x_seed;
		}
		
		function getCurSeed()					// Get current seed
		{
			return $this->x_rand;
		}

		function reset()						// Gets Back to the original seed
		{
			return $this->x_rand = $this->x_seed;
		}

		function random()						//Pseudo Random number geneator
		{
			$this->x_rand = abs($this->K * $this->x_rand) % $this->M;
			
			return $this->x_rand;
		}
	};

//**Easter egg

?>