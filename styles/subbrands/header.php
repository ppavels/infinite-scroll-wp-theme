<?php 
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' )); 
$cat=new Category();
if(is_page()){$type='page'; $id=NULL;  }
if(is_category()){$type='category';} 
$info=new Post();
$h2title=$info->getSEOData('page-h2-title', $type);
if(empty($h2title)){$h2title='Free Samples';}
?>
<div id="col-1">
<div class="post-heading free-samples-head">
<h1>Offers from <?php echo $term->name;?></h1>
</div>
<?php $themeoptions=new ThemeOptions(); ?> 
<div id="free-samples-content">