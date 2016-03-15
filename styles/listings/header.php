<?php 
$this_post=new Post();
    /*if(isset($_GET)){
	foreach($_GET as $param=>$val){
	
	if($param=='mail'&&$val==1){
		$mail_c="checked";
		$filter[]=$param;  
	} 
	if($param=='online'&&$val==1){
		$online_c="checked"; 
		$filter[]=$param; 
	} 
	if($param=='print'&&$val==1){
		$print_c="checked";
		$filter[]=$param; 
	} 
		
	
}
}


if(empty($_GET['mail'])&&empty($_GET['print'])&&empty($_GET['online'])){
	$filter=array(0=>'mail',1=>'print',2=>'online'); 
}

$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' )); 
 
    if($term->slug=='mail'){
		$mail_c="checked";
		$filter[0]=$param;  
	} 
	if($term->slug=='online'){
		$online_c="checked"; 
		$filter[]=$param; 
	} 
	if($term->slug=='printable'){
		$print_c="checked";
		$filter[]=$param; 
	}
	$cat=new Category();

*/
?>
<div id="content">
<div class="contest-head"><h5>Popular Brands on Free.ca</h5></div>
  
<div class="brands-wrape">