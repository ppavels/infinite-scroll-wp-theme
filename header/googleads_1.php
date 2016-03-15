

    
<?php  $themeoptions=new ThemeOptions(); 
 echo (stripslashes($themeoptions->get_theme_settings('analitycs')));?>    
<script type='text/javascript'>    
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') + 
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
</script>

<script type='text/javascript'>
googletag.cmd.push(function() {
	
googletag.defineSlot('/3651687/Free-contest-1', [300, 250], 'div-gpt-ad-1376672206638-0').addService(googletag.pubads());
googletag.defineSlot('/3651687/free-contests-2', [300, 250], 'div-gpt-ad-1376673834895-0').addService(googletag.pubads());
<?php  for ($i=0; $i<30; $i++ ){ ?>
googletag.defineSlot('/3651687/free-contest-3', [300, 250], 'div-gpt-ad-1376675182099-<?php echo $i ?>').addService(googletag.pubads());
googletag.defineSlot('/3651687/free-728-90-infinate', [728, 90], 'div-gpt-ad-1377094926922-<?php echo $i; ?>').addService(googletag.pubads());
<?php } ?>
googletag.defineSlot('/3651687/free-coupons-2', [300, 250], 'div-gpt-ad-1376673834895-1').addService(googletag.pubads());
//googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>