<?php 
$this_post=new Post();
$cat=new Category();
if(is_page()){$type='page'; $id=NULL;  }
if(is_category()){$type='category';} 
$info=new Post();
$h2title=$info->getSEOData('page-h2-title', $type);
if(empty($h2title)){$h2title='Featured Contests';}

if(empty($topic)){ ?>
<div class="contest-head"> <h2><?php echo $h2title." <pre>".print_r($thisCat,TRUE)."</pre>" ?></h2> </div>
<?php } else { ?>
<div class="contest-head"> <h5><?php echo $h2title;
////$info->getHyperLinkText();
//echo $topic; ?>  </h5> </div>
<?php } 
//javascript:void(null);
?>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.cookie.js" type="text/javascript"></script>

<?php  //print_r($values);?>
  <form action="" method="post" onsubmit="foo()" name="frm1" id="frm1">
 <div class="coupons-checks" id="contest_checks_1">
  <h6>Entry Frequency: </h6>
  <script>
  function foo(){
	  greeting();
	  call();
	  
  }
function greeting()
{
	
  event.preventDefault();
 var url = "<?php echo (get_home_url() . '/contests/' ); ?>";
     //   var temp = $("#brand_post_js").val();
     var value = document.forms["frm1"]["brand_post"].value;
     if (value=='no_brand'){value=''};
 newurl =  url + value;
//window.location.replace(url);
//alert("Welcome " + document.forms["frm1"]["brand_post"].value + "!")
window.location=newurl;   
//alert(newurl);
//document.write(location.href);

}
function call() {
	
    $.cookie('poertclass', null);
  //  event.preventDefault();
      var url = $("form").serialize();
	  alert(url);
     // var url = "<?php echo $this_post->getPermalink(); ?>";
   //  newurl =  url + document.forms["frm1"]["brand_post"].value;
   //var posturl = "<?echo (TEMPLATEPATH . '/top_banners/top_header_v2.php');?>";
    $.cookie('poertclass', url 
    ,{ path: '/'}
    );
     
 //window.location=newurl;  
    }
</script>

<?php
$values = array();
$meta_quer['relation']='OR';
parse_str($_COOKIE['poertclass'], $values);

echo print_r($_COOKIE['poertclass']);

?><select class="brand_post" name="frequency" style="margin-left: 10px !important;"><?php


$terms=array('Please Select','Daily','Weekly','Monthly','Unlimited','Instant-win','Hourly');
  foreach ($terms as $term) {  
  if($term==$values['frequency']){
	  $selected=' selected="selected" ';
  }
  else{
	  $selected='';
  }
  //$cat_query=$this->getPostsInCategoryByTaxonomy($category_name, $taxonomy_slug, $term->name);
 
  echo "<option ".$selected." value='$term'>".$term."</option>";  
 } 
?>
</select>

      
      

<?php $cat->getFilterDropdown('Contests', 'topics', $sub_taxonomy);  ?>
<input type="submit" value="" class="filter_coupons"   /> 
 
  

<div class="coupons-checks" id="contest_checks" style="margin-top: -20px;">
 
    

<?php

$checks=array('Facebook','Raffle-copter','Blogs','Twitter','Pinterest','Download','Mobile','Other','Creative-entry');
//print__r($checks);
  foreach ($checks as $check) {  
    if (array_key_exists($check, $values)){
	 $checked='checked';
       // echo "adfjgbkjfgkjzcbg.kbfgkbF?";
  }
  else{
	  $checked='';
  }
  
 echo "<input type='checkbox' ".$checked." name='$check' id='$check' value='1'><label for='$check'>$check</label>";
 
 
 } 

?>    
  
<script>
   function erase(){
       document.getElementById("frm1").reset();
        $.cookie('poertclass', '' 
    ,{ path: '/'}
    );
       location.reload();
   }
    </script>
  </form>
    </div>
  </div>   



<div id="contests" class="featured-contest" >
    
 