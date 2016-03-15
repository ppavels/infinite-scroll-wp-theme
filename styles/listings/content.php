<?php $cat=new Category(); global $brands; $nav=new Navigation(); $brand_link=$nav->getLink('Brands', 'page'); $this_link=$brand_link.$brands->slug;?>
  <!--brand-->
  <div class="brand">

  <a href="<?php echo $this_link; ?>"><img src="<?php echo $cat->getBrandImage($brands->term_id); ?>" alt="" title="<?php echo $brands->name; ?>"></a>
  </div>
 <!--/brand-->

