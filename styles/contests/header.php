<?php 
$this_post=new Post();
$cat=new Category();
if(is_page()){$type='page'; $id=NULL;  }
if(is_category()){$type='category';} 
$info=new Post();
$h2title=$info->getSEOData('page-h2-title', $type);
if(empty($h2title)){$h2title='Featured Contests';}

if(empty($topic)) {?>
<div class="contest-head"> <h2><?php echo $h2title." <pre>".print_r($thisCat,TRUE)."</pre>" ?></h2> </div>
<?php } else { ?>
<div class="contest-head"> <h1><?php echo $h2title; ?>  </h1> </div>
<?php } ?>
<form method="post" name="filterontest" id="filterontest">
<div class="coupons-checks" id="contest_checks_1">
<h6>Entry Frequency: </h6>
<?php
$values = array();
$meta_quer['relation']='OR';
parse_str($_COOKIE['poertclass'], $values);
?>
<select class="brand_post" name="frequency" style="margin-left: 10px !important;">
<?php

//why with part is not dynamic?
//why do you use this line?
$terms=array('Please Select','Daily','Weekly','Monthly','Unlimited','Instant-win','Hourly');
  foreach ($terms as $term) {  
  if($term==$values['frequency']){
	  $selected=' selected="selected" ';
  }
  else{
	  $selected='';
  }
  echo "<option ".$selected." value='$term'>".$term."</option>";  
} 

?>
</select>
<?php $cat->getFilterDropdown('Contests', 'topics','travel');

?>
<input type="submit" value="" class="filter_coupons"   /> 
<div class="coupons-checks" id="contest_checks" style="margin-top: -20px;">
<?php
$checks=array('Facebook','Raffle-copter','Blogs','Twitter','Pinterest','Download','Mobile','Other','Creative-entry');

  foreach ($checks as $check) {  
    if (array_key_exists($check, $values)){
	 $checked='checked';
 
  }
  else{
	  $checked='';
  }
  
 echo "<input type='checkbox' ".$checked." name='$check' id='$check' value='1'><label for='$check'>$check</label>";
 
 
 } 

?>    

</form>
    </div>
  </div>   



<div id="contests" class="featured-contest" >
    
 