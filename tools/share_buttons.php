<a rel="nofollow" target="_blank" href="mailto:?subject=<?php echo strip_tags(get_the_title()) ;?>&Body=<?php echo strip_tags($content); ?>. Check it out: <?php the_permalink(); ?>" class="contest-mail" ></a>
 
 
    <a href="http://twitter.com/share?text=<?php echo strip_tags(get_the_title()) ." ";  urlencode(the_permalink()); ?>" class="contest-twitter twitter  popup"></a>
<?php /* ?>    
    <a class="contest-pin" href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'><img src='<?php  bloginfo('template_url'); ?>/images/contest-pin.gif'/></a>
 <?php */?>  
  <a rel="nofollow" class="contest-fb"  target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink()?>?fb=ShareButton&t=<?php echo strip_tags(get_the_title())?> "><img  src="<?php  bloginfo('template_url'); ?>/images/contest-fb.gif" alt="Share On Facebook" title="Share on Facebook" /></a>