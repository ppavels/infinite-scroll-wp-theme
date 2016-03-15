<?php 
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' )); 
$cat=new Category();
if(is_page()){$type='page'; $id=NULL;  }
if(is_category()){$type='category';} 
$info=new Post();
$h2title=$info->getSEOData('page-h2-title', $type);
if(is_tax()){
   $h2title=$info->getSEODataTaxonomy('topic-default-h2');
if(empty($h2title)){$h2title='Sales';}
}
?>
<div id="col-1">
    <div class="post-heading free-samples-head sales-heading"> <h2><?php echo $h2title; ?></h2> 
</div>
<div id="contests" class="featured-contest" style='width: 1050px;'>