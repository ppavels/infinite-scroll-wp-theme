<?php $pagenumber=preg_match('#page\/(\d+)#', $_SERVER['REQUEST_URI'], $mtch);
if(empty($mtch)){
$counter=0;
}
else{
$counter=$mtch[1]-1;
}



?>
<div class="free-samples-post post" style="width:728px; height:100px; padding:10px 0;  margin-top:-15px"> 
<div class="post-entry">

<div id='div-gpt-ad-1377094926922-<?php echo $counter; ?>' style='width:728px; height:90px;'>
<?php if($counter==0){ ?>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1377094926922-0'); });
</script>
<?php } ?>
</div>

</div>
     
        <div class="clearfix"></div>
        
 </div>