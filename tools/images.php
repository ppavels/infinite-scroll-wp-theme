<?php
if (class_exists('MultiPostThumbnails')) {
        new MultiPostThumbnails(
            array(
                'label' => '570X300 image',
                'id' => 'secondary-image',
                'post_type' => 'post'
            )
			
        );
		new MultiPostThumbnails(
            array(
                'label' => 'Facebook Thumbnail',
                'id' => 'facebook-image',
                'post_type' => 'post'
            )
			
        );
		new MultiPostThumbnails(
            array(
                'label' => 'Pinterest Image',
                'id' => 'pinterest-image',
                'post_type' => 'post'
            )
			
        );
		
		new MultiPostThumbnails(
            array(
                'label' => '300X250 image',
                'id' => 'paid-image',
                'post_type' => 'post'
            )
			
        );
		
		
		/**/
    }

function get_main_image_url(){
	global $post;
	  if (class_exists('MultiPostThumbnails')) {
		      
			  if(MultiPostThumbnails::get_post_thumbnail_url('post', 'secondary-image')!=""){
			  $imgsrc=MultiPostThumbnails::get_post_thumbnail_url('post', 'secondary-image');
			  }
			  else if (get_post_meta($post->ID, "image_570_300", true)!="")
			  {$imgsrc=get_post_meta($post->ID, "image_570_300", true);}
			  
	 }
	 return $imgsrc;
}

function get_html_300_250($link=false){
	global $post;
	if (get_post_meta($post->ID, "html_300_250", true)!=""){
		$html=get_post_meta($post->ID, "html_300_250", true);
		$html=str_replace("<A","<a",$html);
		$html=str_replace("&lt;A","<a",$html);
		$html=str_replace("</A>","</a>",$html);
		$html=str_replace("&lt;/A&gt;","</a>",$html);
		$html=str_replace("&lt;IMG","<img",$html);
		$html=str_replace("&lt;","<",$html);
		$html=str_replace("&gt;",">",$html);
		$html=str_replace("<IMG","<img",$html);
		$html=str_replace("HREF","href",$html);
		$html=str_replace("HREF=","href=",$html);
		$html=str_replace("SRC=","src=",$html);
		$html=str_replace("ALT=","alt=",$html);
	}
	if($link){
		// /href="(.*?(aff_id=\d+))"/msi
		if(preg_match('/href="(.*?aff_id=\d+)"*?>\s?<img.*?src="(.*?)"/msi', $html, $mtch)){
			$arr['code']=$html;
			$arr['link']=$mtch[1];
			$arr['image']=$mtch[2];
			$html=(object)$arr;
		}
	}
	
	
	return $html;
}


function get_300_250(){
	  global $post;
	  $html=get_html_300_250(TRUE);
	  if (class_exists('MultiPostThumbnails')) {
	  
	  
	  if($html->image){
		   $imgsrc=$html->image;
	   }
	   else if(MultiPostThumbnails::get_post_thumbnail_url('post', 'paid-image')!=""){
		$imgsrc=MultiPostThumbnails::get_post_thumbnail_url('post', 'paid-image');
	   
	  }
	   	   
	 }
	 
     return $imgsrc;

}

function get_facebook_image_url(){
	  if (is_single()){
	  global $post;
	  if (class_exists('MultiPostThumbnails')) {
		      if(MultiPostThumbnails::get_post_thumbnail_url('post', 'facebook-image')!=""){
			  $imgsrc=MultiPostThumbnails::get_post_thumbnail_url('post', 'facebook-image');
			  }
			  else if(MultiPostThumbnails::get_post_thumbnail_url('post', 'secondary-image')!=""){
			  $imgsrc=MultiPostThumbnails::get_post_thumbnail_url('post', 'secondary-image');
			  }
			  else if (get_post_meta($post->ID, "image_570_300", true)!="")
			  {$imgsrc=get_post_meta($post->ID, "image_570_300", true);}
			  else if (get_300_250()!="")
			  {$imgsrc=get_300_250();}
			  else{
				  $html=get_html_300_250(TRUE);
				  $imgsrc=$html->image;
				  
			  }
			  
	 }
	 }
	 else{
		 $imgsrc=get_option('adjump_facebook_thumb');
	 }
	  
	 return $imgsrc;
}

function get_pinterest_image_url(){
	global $post;
	  if (class_exists('MultiPostThumbnails')) {
		      if(MultiPostThumbnails::get_post_thumbnail_url('post', 'pinterest-image')!=""){
			  $imgsrc=MultiPostThumbnails::get_post_thumbnail_url('post', 'pinterest-image');
			  }
			  else if(MultiPostThumbnails::get_post_thumbnail_url('post', 'secondary-image')!=""){
			  $imgsrc=MultiPostThumbnails::get_post_thumbnail_url('post', 'secondary-image');
			  }
			  else if (get_post_meta($post->ID, "image_570_300", true)!="")
			  {$imgsrc=get_post_meta($post->ID, "image_570_300", true);}
			  else if (get_300_250()!="")
			  {$imgsrc=get_300_250();}
			  else{
				  $html=get_html_300_250(TRUE);
				  $imgsrc=$html->image;
				  
			  }
			  
	 }
	 return $imgsrc;
}

function is_new_style(){
	if (get_main_image_url()!=""||get_300_250()!=""||get_html_300_250()!=""){
		return TRUE;
	}
	else{
		return FALSE;
	}
}

function is_300_250(){
	if (get_300_250()!=""||get_html_300_250()!=""){
		return TRUE;
	}
	else{
		return FALSE;
	}
}
?>