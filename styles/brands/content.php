<?php $cat=new Category(); global $brands, $brand_key, $items; $nav=new Navigation(); $brand_link=$nav->getLink('Brands', 'page'); $this_link=$brand_link.$brands->slug;?>
<style>
      #footer { margin-top: 89px !important;}
  </style>

<div class="brands-search" id="<?php echo $brand_key; ?>">
  <div class="brand-alphabat">
      <h1><?php echo mb_strtoupper( $brand_key ); ?></h1>
  </div>
 <div class="brand-result"> 
      
     <table cellpadding="5" cellspacing="0" border="0">
 <tr>
       <?php 
       $counter = 0;
       foreach( $items as $value ) { 
           $term = get_term_by('slug', $value, 'brands');
           $this_link=$brand_link.$value; ?>
            <td>
                <a href="<?php echo $this_link; ?>">
                    <?php echo $term->name; ?>
                </a>
            </td>
    <?php if(++$counter % 4 === 0) { ?>
        </tr><tr>
    <?php } ?>
             
       <?php } ?>
       </tr>  
  
       
     </table>
 
 </div>
  <div style="clear: both"></div>
   
  </div>
