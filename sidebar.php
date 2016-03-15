<div id="col-2">
 <?php 
 
  if (is_home()){
  require_once(TEMPLATEPATH."/sidebar/indexpage.php"); 
  }
  else{
  require_once(TEMPLATEPATH."/sidebar/otherpages.php"); 
  }

 ?>   
</div>
