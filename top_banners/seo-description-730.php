<?php if(is_page()){$type='page'; }
if(is_category()){$type='category';} 
//if(is_author()){$type='author';}

$info=new Post();
$h1title=$info->getSEOData('page-h1-title', $type, $id=NULL);
$pagedescription=$info->getSEOData('page-description', $type);

?>
<div class="seo-description category-info">
<h1><?php echo $h1title; ?></h1>

<p><?php echo $pagedescription; ?></p>



</div>

