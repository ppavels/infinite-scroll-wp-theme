<div class="gplusindx" style="float:left;  width:70px"><div class="g-plusone" data-href="<?php the_permalink(); ?>"></div></div>

<div class="fbindx" style="float:left; margin:3px 5px 0 3px;  " ><div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
</div>

<div class="twindx" style="float:left; margin:3px; width:75px" ><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-via="FreeDotCA" data-lang="en" data-text="<?php the_excerpt() ;?>" >&nbsp;</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div> 


<div class="pinindx" style="float:left; margin:3px 0 0 5px"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo Images::get_pinterest_image_url();?>&description=<?php the_excerpt(); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
