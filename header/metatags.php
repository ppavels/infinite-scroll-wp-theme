
<meta name="description" content="<?php 

if(is_404()) {
    bloginfo('name'); } 
    
elseif(is_home()) {
    $themeoptions=new ThemeOptions();
    if ($themeoptions->get_theme_settings('description')!=NULL) {
        echo (stripslashes($themeoptions->get_theme_settings('description')));
    }else{
        bloginfo('name'); }
}
        
elseif(is_page()) {
        $info=new Post();
        echo $info->getSEOData('page-meta-description', 'page');  } 

elseif(is_single()) {
        $info=new Post();
        echo $info->getPostMeta('meta-desc');}
        
else {
$cat=new Category();     
if($cat->is_brand()){
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ));
echo $cat->get_term_meta($term->term_id, 'brand-meta-description', true);
}
if($cat->is_topics()){
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ));
echo $cat->get_term_meta($term->term_id, 'topic-default-meta', true);
}
}  

?>" />
<?php $themeoptions=new ThemeOptions();
if ($themeoptions->get_theme_settings('verification')!=NULL) {
?>    
<meta name="google-site-verification" content="<?php echo (stripslashes($themeoptions->get_theme_settings('verification'))); ?>" /> 
<?php } if(is_single()) { 
    $info=new Post();?>                                      
<meta property="og:image" content="<?php echo $info->getPostImage(FALSE, FALSE, FALSE);  ?>"/>
    <?php } ?>