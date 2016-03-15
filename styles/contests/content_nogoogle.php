<?php $pagenumber=preg_match('#page\/(\d+)#', $_SERVER['REQUEST_URI'], $mtch);
if(empty($mtch)){
$counter=0;
}
else{
$counter=$mtch[1]-1;
}
$google_id='div-gpt-ad-1382115031525-'.$counter.'';
//$google_id='div-gpt-ad-1382115031525-0';
?>

<div class="contest-post">
<div class="entry-post">

<div class="googleads-post" id="contestgoogleads<?php echo $counter; ?>"></div>

<div id='<?php echo $google_id; ?>' style='width:300px; height:250px;'>

<?php if($google_id=='div-gpt-ad-1382115031525-0'){ ?>
<script type="text/javascript">
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1382115031525-0'); });
</script>
<?php } ?>
</div> 


</div><!--/entry-post-->
</div><!--/contest-post--> 
  
