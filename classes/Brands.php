<?php

class User{
    
  function __construct(){
       
  }  

    
public function brand_name(){
	
}
public function user_id($url=FALSE){
	
	if(!$url){
    global $post;    
    return $author_id=$post->post_author;
	}
	else{
	list($parent,$domain,$auth,$username)=  split('/', $_SERVER[REQUEST_URI]); 
    $user = get_userdatabylogin("$username");
    return $user->ID;
	}
  }  
  
  public function has_posts(){
	  global $post;
	  $post_number=count($post);
	  if($post_number>0){
		  return TRUE;
	  }
	  else{
		  return FALSE;
	  }
  }
     
 }
?>

