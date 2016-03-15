<script type="text/javascript">
$(function(){
var container = $('#free-samples-content'); 

container.imagesLoaded( function(){
    container.masonry({
        itemSelector : '.post'
    });
});

container.infinitescroll({
      navSelector  : '#MainNav',    
      nextSelector : '#MainNav a:first',
      itemSelector : '.post',
	 
      loading: {
          finishedMsg: 'No more offers to load.',
          img: 'http://i.imgur.com/6RMhx.gif',
		  animate: false,
		  speed: 5
        }
      },
	  
function( newElements ) {
		 
var $newElems = $( newElements ).css({ opacity: 0 });
$newElems.imagesLoaded(function(){
$newElems.animate({ opacity: 1 });
container.masonry( 'appended', $newElems, true ); 
//functions need to be added after posts load starts
	FB.XFBML.parse();
//	 twttr.widgets.load();
//	 gapi.plusone.go();	   

	
	//google ads
<?php display_google_ads($placement='scroll', $identyfier='rewards') ?>
	
	
//	googletag.cmd.push(function() { googletag.display('div-gpt-ad-1376672206638-0'); });
//    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1376673834895-0'); });
//	googletag.cmd.push(function() { googletag.display('div-gpt-ad-1376673834895-1'); });
//    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1376675182099-0'); });
	
	//ajaxLoadScript(googleadsid);
	
	//dhtmlLoadScript();
	
	//functions need to be added after posts load ends
	});
  }
 );
 
 function printObject(o) {
  var out = '';
  for (var p in o) {
    out += p + ': ' + o[p] + '\n';
  }
  alert(out);
}


 function dhtmlLoadScript(googleadsid) {
	 
	 var google_ad_client=document.createTextNode('google_ad_client = "ca-pub-5393530392305555";\n');
	 if(googleadsid==1){
	 var google_ad_slot=document.createTextNode('google_ad_slot = "3253815361";\n');
	 var google_ad_width=document.createTextNode('google_ad_width = 300;\n');
	 var google_ad_height=document.createTextNode('google_ad_height = 250;\n');
	 var alerts=document.createTextNode('alert("ok this is code");\n');
	 }
	 else if (googleadsid==2){
	 var google_ad_slot=document.createTextNode('google_ad_slot = "9300348968";\n');
	 var google_ad_width=document.createTextNode('google_ad_width = 300;\n');
	 var google_ad_height=document.createTextNode('google_ad_height = 250;\n');
	 var alerts='';
	 }
	 else if (googleadsid==0){
	 var google_ad_slot=document.createTextNode('google_ad_slot = "6207281763";\n');
	 var google_ad_width=document.createTextNode('google_ad_width = 300;\n');
	 var google_ad_height=document.createTextNode('google_ad_height = 600;\n');
	 var alerts='';
	 }
	  var e1 = document.createElement("script");
          e1.type="text/javascript";
		  e1.appendChild(google_ad_client);
		  e1.appendChild(google_ad_slot);
		  e1.appendChild(google_ad_width);
		  e1.appendChild(google_ad_height); 
	      e1.appendChild(alerts); 
	 
      var e = document.createElement("script");
      e.src = 'http://pagead2.googlesyndication.com/pagead/show_ads.js';
      e.type="text/javascript";
	  document.getElementById("contestgoogleads"+googleadsid).appendChild(e1);
      document.getElementById("contestgoogleads"+googleadsid).appendChild(e);
	  
	 //printObject(google_ad_slot);
}

 function ajaxLoadScript(googleadsid) {
	 
	 
	 if(googleadsid==1){
	      var e1 = document.createElement("script");
          e1.type="text/javascript";
		  google_load="googletag.cmd.push(function() { googletag.display('div-gpt-ad-1376672206638-0'); });";
		  e1.appendChild(google_load);
		  
	 }
	 
	  
     document.getElementById("div-gpt-ad-1376672206638-0").appendChild(e1);
	  
	 //printObject(google_ad_slot);
}

 
});



</script>