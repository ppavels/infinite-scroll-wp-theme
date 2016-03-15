<?php

class User{
    
  function __construct(){
       
  }  

public function user_description($user_id=NULL){
    if(empty($user_id)){
		 $user_id=$this->user_id(TRUE);
	}
   return  get_the_author_meta('user_description',$user_id);
   
  }  
    
public function user_name(){
	if(empty($user_id)){
		 $user_id=$this->user_id(TRUE);
	}
   return ucfirst(get_the_author_meta('user_firstname', $user_id));
      
  }    
public function user_id($url=FALSE){
	
	if(!$url){
    global $post;    
    return $author_id=$post->post_author;
	}
	else{
            preg_match("/\/author\/(.*)\//", $_SERVER[REQUEST_URI], $mtch);
            $username = $mtch[1];
	//list($parent,$domain,$auth,$username)=  split('/', $_SERVER[REQUEST_URI]); 
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
