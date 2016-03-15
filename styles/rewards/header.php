<?php 
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' )); 
$cat=new Category();
if(is_page()){$type='page'; $id=NULL;  }
if(is_category()){$type='category';} 
$info=new Post();
$h2title=$info->getSEOData('page-h2-title', $type);
if(empty($h2title)){$h2title='Rewards';}
?>
<div id="col-1">
<div class="post-heading free-samples-head"> <h2><?php echo $h2title; ?></h2> 
</div>
<?php $themeoptions=new ThemeOptions();?>
<div id='div-gpt-ad-<?php echo (stripslashes($themeoptions->get_google_ads('rewards_loop_channel'))); ?>-0' style='width:728px; height:90px; margin-bottom:20px; '>
<?php display_google_ads($placement='style_header', $identyfier='rewards') ?>
</div>   
<div id="free-samples-content">