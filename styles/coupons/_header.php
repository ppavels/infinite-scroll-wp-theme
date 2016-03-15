<?php 
$this_post=new Post();
    if(isset($_GET)){
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

if(is_page()){$type='page'; $id=NULL;  }
if(is_category()){$type='category';} 

$info=new Post();
$h2title=$info->getSEOData('page-h2-title', $type);
if(empty($h2title)){$h2title='Coupons & Deals';}

?>


<div class="coupons-head"> <h2><?php echo $h2title." <pre>".print_r($thisCat,TRUE)."</pre>" ?></h2> </div>

 <div class="coupons-checks">
  <h6>Filter by type: </h6>
  
  <form action="<?php echo $this_post->getPermalink(); ?>" method="get" >
  <input type="checkbox" name="mail" value="1" <?php echo $mail_c; ?> >
  <label>By Mail</label>
   <input type="checkbox" name="online" value="1" <?php echo $online_c; ?> >
  <label>Online</label>
   <input type="checkbox" name="print" value="1" <?php echo $print_c; ?> >
  <label>Print at Home</label>
  <input type="submit" value="" class="filter_coupons"  /> 
  </form>
  
  </div>
  
<div id="coupons-posts">