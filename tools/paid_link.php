<?php 


function set_paid_cookie(){
if(count($_GET)>0){
	$time=time()+60*60*24*30*120;
	if(isset($_GET['subid1'])){
		if(!isset($_COOKIE['subid1'])){
			setcookie("subid1", $_GET['subid1'], $time, "/");
		}
		
	}
	if(isset($_GET['subid2'])){
		if(!isset($_COOKIE['subid2'])){
			setcookie("subid2", $_GET['subid2'], $time, "/");
		}
		
	}
	
	if(isset($_GET['subid3'])){
		    setcookie("subid3", "", time()-3600, "/" );
			setcookie("subid3", $_GET['subid3'], $time, "/");
		
		
	}
	
	
}
	
}

add_filter('init','set_paid_cookie');

function replace_paid_link($content){
	//subid1
	if(isset($_GET['subid1'])){
		
		if(isset($_COOKIE['subid1'])){
		$getstring="&subid1=".$_COOKIE['subid1'];
		}
		else{
		$getstring="&subid1=".$_GET['subid1'];
		}
		
		
	}
	
	else{
		if(isset($_COOKIE['subid1'])){
		$getstring="&subid1=".$_COOKIE['subid1'];
		}
	
	}

//subid2
if(isset($_GET['subid2'])){
		
		if(isset($_COOKIE['subid2'])){
		$getstring.="&subid2=".$_COOKIE['subid2'];
		}
		else{
		$getstring.="&subid2=".$_GET['subid2'];
		}
		
		
	}
	
	else{
		if(isset($_COOKIE['subid2'])){
		$getstring.="&subid2=".$_COOKIE['subid2'];
		}
	
	}



//subid3
if(isset($_GET['subid3'])){
   $getstring.="&subid3=".$_GET['subid3'];
}
else{
if(isset($_COOKIE['subid3'])){
$getstring.="&subid3=".$_COOKIE['subid3'];
}
	
}


//adding getstring to aff_id

$pattern='/(\&|\?|\&\#038;)aff_id=(\d+)/';
$content = preg_replace($pattern, "$1aff_id=$2".$getstring, $content);

return $content;	

}





?>