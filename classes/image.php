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
			  
			  
	 }
	 return $imgsrc;
}
?>