<script type="text/javascript">
$(function(){
var container = $('#exclusive_offer');

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
	/* twttr.widgets.load();
	 gapi.plusone.go();	 */  

	
	//google ads

<?php display_google_ads($placement='scroll', $identyfier='exclusive') ?>
	
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


 


 
});



</script>