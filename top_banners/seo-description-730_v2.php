 <script src="<?php bloginfo('template_url'); ?>/js/slides.min.jquery.js" type="text/javascript"></script>
	<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: '<?php bloginfo('template_url'); ?>/images/slider/loading.gif',
				play: 5000,
				pause: 7000,
				hoverPause: true
			});
		});
	</script>
<link rel="stylesheet" href="<?php  bloginfo('template_url');  ?>/slider.css" type="text/css" />
			<div id="slides" style="">
				<div class="slides_container">
				 
                <?php $themeoptions=new ThemeOptions();  echo stripslashes($themeoptions->get_theme_settings('slider_code'));  ?>
				</div>
				<a href="#" class="prev"><img src="<?php bloginfo('template_url'); ?>/images/slider/arrow-prev.png" width="48" height="48" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="<?php bloginfo('template_url'); ?>/images/slider/arrow-next.png" width="48" height="48" alt="Arrow Next"></a>
			</div>
		