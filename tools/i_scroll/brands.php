<script type="text/javascript">
$(function(){
var container = $('.brands-wrape');

container.imagesLoaded( function(){
    container.masonry({
        itemSelector : '.brand'
    });
});

container.infinitescroll({
      navSelector  : '#MainNav',    
      nextSelector : '#MainNav a:first',
      itemSelector : '.brand',
	 
      loading: {
          finishedMsg: 'No more brands to load.',
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
		   

	//functions need to be added after posts load ends
	});
  }
 );
 
});



</script>