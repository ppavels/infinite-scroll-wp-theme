<?php 
 class Navigation{
 private $this_post;
 function __construct(){
 $this->this_post=new Post();
	 
 }	
 
 public function getPemalink(){
	 return get_the_permalink();
 }
 
 public function getLink($name, $type){
	if($type=='page'){
	   $link=$this->this_post->getPageLink($name);
    
	} else if($type=='category'){
		$category=new Category();
		$link=$category->getURL($name);
		
	}
	return $link;
 }
	
	
}?> 