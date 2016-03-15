<?php
    if(function_exists('yd_get_params')){
		 $get_params=yd_get_params();
		 $ct=0;
		 foreach ($get_params as $param){
		 if(isset($_GET[$param])){
		 
		 if($ct==0){
         $valuestr=$param."=".$_GET[$param];
		 }
		 else{
		 $valuestr.="&".$param."=".$_GET[$param]; 
		  }
		  $ct++;
		 }
	}
	}
	
	//echo "<pre>".print_r($get_params, TRUE)."</pre><br/>";
	//echo " Param ".$valuestr."<br/>";
	 if(function_exists('yd_get_param')){
		 $get_params=yd_get_params();
		
		 if(isset($_GET[$get_params[0]])){
         $addvalue=$_GET[$get_params[0]];
		 
		 if (function_exists('yd_is_self_host_reffer')){
			 
			 $pixel=yd_fire_pixel($get_params[0],$addvalue);
			 
		 }
         }
         else{
	     $addvalue='';
        }
		
		
		 
	 }

 echo "<script type=\"text/javascript\">//<![CDATA[";
 $blogdomain = parse_url(get_settings('home'));
  
  echo "
  
	function makeNewWindows() { ";
		
	if($addvalue){
			echo "i1=document.getElementById('i1');
			i2=document.getElementsByTagName('iframe');
			for (var q=0; q<i2.length; q++) {
			if (i2[q].src.search(/aff_id=1016/) != -1){
            document.getElementsByTagName('iframe')[q].setAttribute('src', i2[q].src+'&subid4=".$addvalue."');
             
			}
			
			}
	";
	}
	

	echo "if (!document.links) {
			document.links = document.getElementsByTagName('a');
		}
		for (var t=0; t<document.links.length; t++) {
		var all_links = document.links[t];
			if (all_links.href.search(/^http/) != -1) { // Catches both http and https
		  	if (all_links.href.search('/".$blogdomain['host']."/') == -1) {
		    	// all_links.setAttribute('target', '_blank');
		    	//document.links[t].setAttribute('href', 'javascript:window.open(\\''+all_links.href+'\\'); void(0);');
		    	document.links[t].setAttribute('target', '_blank');
		    
			if (all_links.href.search(/aff_id=1016/) != -1){
				document.links[t].setAttribute('href', all_links.href+'&subid4=".$addvalue."');
			}
			
			
			
			}
			
			else{
			";
			
			
			/*if($addvalue){
		    echo "if (all_links.href.search(/".$get_param."=/) == -1) { 
			if (all_links.href.search(/\?/) == -1){
			document.links[t].setAttribute('href', all_links.href+'?".$get_param."=".$addvalue."');
			}
			else{
			document.links[t].setAttribute('href', all_links.href+'&".$get_param."=".$addvalue."');
			}
			}";
			}
			else{}*/
		    
			if(count($get_params)>0){
			for ($cn=0; $cn<count($get_params); $cn++){
				if(isset($_GET[$get_params[$cn]])){
				$addvalues[$cn]=$_GET[$get_params[$cn]];
				}
		    echo "if (all_links.href.search(/".$get_params[$cn]."=/) == -1) { 
			if (all_links.href.search(/\?/) == -1){";
			if($cn==0){
			echo"
			document.links[t].setAttribute('href', all_links.href+'?".$get_params[$cn]."=".$addvalues[$cn]."');
			}";
			}
			else{
			
			echo"
			document.links[t].setAttribute('href', all_links.href+'&".$get_params[$cn]."=".$addvalues[$cn]."');
			}";
				
			}
			
			echo " }
			else{
			//document.links[t].setAttribute('href', all_links.href+'&".$get_params[$cn]."=".$addvalues[$cn]."');
			}
			";
			}
			}
			else{}
			
			echo "	
		  }
			}
		}
	}

	function addLoadEvent2(func)
	{	
		var oldonload = window.onload;
		if (typeof window.onload != 'function'){
			window.onload = func;
		} else {
			window.onload = function(){
				oldonload();
				func();
			}
		}
	}
addLoadEvent2(makeNewWindows);
	";
  echo "//]]></script>\n\n";
?>