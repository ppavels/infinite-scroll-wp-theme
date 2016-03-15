<script type="text/javascript">
$(function(){
var container = $('#contests');

container.imagesLoaded( function(){
    container.masonry({
        itemSelector : '.contest-post'
    });
});

container.infinitescroll({
      navSelector  : '#MainNav',    
      nextSelector : '#MainNav a:first',
      itemSelector : '.contest-post',
	 
      loading: {
          finishedMsg: 'No more contests to load.',
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
		   
		jQuery('.featured-image').hover(function(e) {
		jQuery(this).find('.hover-bg').animate({
			bottom: 0,
		}, 200)
	}, function(e) {
		jQuery(this).find('.hover-bg').animate({
			bottom: -55,
		}, 200)
	});
	
	
	
	<?php display_google_ads($placement='scroll', $identyfier='contests') ?>

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


 

 
});



</script>