       <?php if(is_page()){$type='page'; }
if(is_category()){$type='category';} 
$info=new Post();
$h1title=$info->getSEOData('page-h1-title', $type, $id=NULL);
$pagedescription=$info->getSEOData('page-description', $type);
?> 




<div class="category_info">
    <?php if(is_page('Coupons')){?>
    <div class="category_info_inner_dashed"><?php } else{?>
    <div class="category_info_inner"> <?php } ?>
        <div id="category_info_inner_pic">
            </div>
        <div id="seo_description_category_info" class="seo-description category-info">
     <h1>Advertise with us!</h1>

<p>If you want to get your brand in front of a fantastic, engaged audience, talk to us about how we can showcase your FREE promotion! Fill out the form below and we&acute;ll be in touch shortly to outline our cost effective options. </p>
            </div>
        </div>
</div> 