<?php
/**
 * @name Navigation
 * @since 09/08/2012
 * @author Constantine Alexeyev
 * @copyright adjump media
 * @version 2.0
 * This is the question :
 would it work in the same cat, if it is in the several categoties, should I exclude all but not mentioned in the function, not it ('Expired'), means exclude, but probably we can use ('Coupons') and explude all but not this one. cerate array and is ($arr['id']!=coupon_id add to new array and this one will be arg for exclude, the only question what format of array?
 * 
 */
 
 class Navigation {

   
    private $id;
    private $id2;
  

    public function __construct($id = NULL, $id2 = NULL) {
        

        $this->this_post=new Post();
        $this->id = $id;
        $this->id2 = $id2;
	
		
	
    }

    public function __autoload($className) {
    if (file_exists(TEMPLATEPATH . DS .'classes' . DS . $className . '.php')){
    require_once(TEMPLATEPATH . DS .'classes' . DS . $className . '.php');
       }
    }

    public function __set($name, $value) {
        return $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }
	
	public function get_previous_post($exclude_cat_name=NULL){
		if($exclude_cat_name!=null){
		$category=new Category();
        $cats_to_exlude=$category->getAllButNot($exclude_cat_name);
		}
	next_post('%','<span class="coupon-prev" ></span>', 'no', 'no',1, $cats_to_exlude); 
	}
	
	public function get_next_post($exclude_cat_name=NULL){
		if($exclude_cat_name!=NULL){
		$category=new Category();
        $cats_to_exlude=$category->getAllButNot($exclude_cat_name);
		}
	previous_post('%',
'<span class="coupon-next" ></span>', 'no', 'no',1, $cats_to_exlude);
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
	else if($type=='topics'){
		$category=new Category();
		$link=$category->getTermsId('topics', 'For Her');
		
	}
	return $link;
 }
	
	
  } ?>