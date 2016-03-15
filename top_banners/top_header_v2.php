       <?php if(is_page()){$type='page'; }
if(is_category()){$type='category';} 
$info=new Post();
$cat=new Category();
$h1title=$info->getSEOData('page-h1-title', $type, $id=NULL);
$pagedescription=$info->getSEOData('page-description', $type);
?> 
<?php if(is_page('christmas')){
   $h1title=$cat->get_term_meta(304, 'topic-default-h1', true);
   $pagedescription=$cat->get_term_meta(304,'topic-default-page', true);}
   if(is_tax()){
   $h1title=$info->getSEODataTaxonomy('topic-default-h1');
   $pagedescription=$info->getSEODataTaxonomy('topic-default-page');}
?>
<pre><?php // print_r($values);?></pre>



<div class="category_info">
    <?php if(is_page('Coupons')){?>
    <div class="category_info_inner_dashed"><?php } else{?>
    <div class="category_info_inner"> <?php } ?>
        <div id="category_info_inner_pic">
            </div>
        <div id="seo_description_category_info" class="seo-description category-info">
     <h1><?php echo $h1title; ?></h1>

<p><?php echo $pagedescription; ?></p>
            </div>
        </div>
</div> 