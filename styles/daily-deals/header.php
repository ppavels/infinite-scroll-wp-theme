<?php 
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' )); 
$cat=new Category();
if(is_page()){$type='page'; $id=NULL;  }
if(is_category()){$type='category';} 
$info=new Post();
$h2title=$info->getSEOData('page-h2-title', $type);
if(empty($h2title)){$h2title='Daily Deals';}
?>
<div id="col-1" class="coming_soon_page">
<div id="free-samples-content">