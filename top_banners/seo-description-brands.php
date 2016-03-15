<?php $term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ));?>

<?php  $cat=new Category(); $h2title=$cat->get_term_meta($term->term_id, 'brand-title', true); ?>

   <div class="free-samples-head brands-head surver-head-1"> <h1><?php echo $h2title; ?></h1> 
</div>
<div class="brands-samples-post">
 <div class="post-image-300 brands-image-300">   
<img src="<?echo $cat->get_term_meta($term->term_id, 'brand-default-image', true);?>" alt="<?php echo $h2title?>" title="<?php echo $h2title?>" />
</div>
 <div class="post-entry-300 brands-entry">
<!--          <a href="<?php 

$this_post=new Post(); //echo $this_post->getHyperLink(); ?>" target="_blank"><h6><?php// echo $this_post->getTitle(); ?></h6></a>-->
         
         <p style="max-height: 170px; overflow:hidden;">
         <?php echo $cat->get_term_meta($term->term_id, 'brand-page-description', true);
          // echo $this_post->getExcerpt(); ?>
         </p>
         <div class="free-samples-head brands-head surver-head-1 website-brands">
         
             <?php $url_text=$cat->get_term_meta($term->term_id, 'brand-company-url-text', true);?>
             
             <?php if ($url_text!=""){ ?>
             <a rel="nofollow" target="_blank" style="z-index:5; background-color: #fff" href="<?php echo $cat->get_term_meta($term->term_id, 'brand-company-url', true); ?>" class="" title="<?php echo $cat->get_term_meta($term->term_id, 'brand-company-url-text', true); 
          ?>">
              <h1><?php echo $cat->get_term_meta($term->term_id, 'brand-company-url-text', true); ?></h1>
          </a>
       <?php } else { ?>
         
         
          <a rel="nofollow" target="_blank" style="z-index:5; background-color: #fff" href="<?php echo $cat->get_term_meta($term->term_id, 'brand-company-url', true); ?>" class="" title="<?php echo $cat->get_term_meta($term->term_id, 'brand-company-url', true); 
          ?>">
              <h1>website: <?php echo $cat->get_term_meta($term->term_id, 'brand-company-url', true); ?></h1>
          </a>
       <?php } ?>
         </div> 
         
         <div>
           <?php $social = new SocialMedia();
           echo $social->getBrandButtons();
         //  $social->getBrandButtons();?> 
        </div>

        </div>

</div>

