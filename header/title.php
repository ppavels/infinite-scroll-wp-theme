<title><?php
if(is_404()) {
    bloginfo('name'); } 
    
elseif(is_home()) {
    $themeoptions=new ThemeOptions();
    if ($themeoptions->get_theme_settings('title')!=NULL) {
        echo (stripslashes($themeoptions->get_theme_settings('title')));
    }else{
        bloginfo('name'); }
}
elseif(is_page()) {
        $info=new Post();
        echo $info->getSEOData('page-title-tag', 'page');  } 

elseif(is_single()) {
        $info=new Post();
        echo $info->getPostMeta('meta-title');}
        
else {
$cat=new Category();     
if($cat->is_brand()){
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ));
echo $cat->get_term_meta($term->term_id, 'brand-meta-title', true);
}
if($cat->is_topics()){
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ));
echo $cat->get_term_meta($term->term_id, 'tag-default-icon', true);
}
}  





?></title>