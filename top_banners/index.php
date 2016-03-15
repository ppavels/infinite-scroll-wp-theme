<?php 



if(is_404()){
}
else if(is_page('Local')){
}
else if (is_page('Daily Deals')){
}
else if(is_page('Advertise')){
}
else if (is_page('About')){
     include (TEMPLATEPATH . '/top_banners/header_about.php'); 
}
else if(is_page()||is_category()){
   //include (TEMPLATEPATH . '/top_banners/seo_description-1.php');
	include (TEMPLATEPATH . '/top_banners/seo_description-1_v2.php');
}

else if (is_author()){
     include (TEMPLATEPATH . '/top_banners/header_author.php');   
}
else{
	
$cat=new Category();

if($cat->is_brand()){
	include (TEMPLATEPATH . '/top_banners/header_brands.php');   

/*$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' )); 
echo "<pre>".print_r($term, TRUE)."</pre>";*/
}
	else{
	//include (TEMPLATEPATH . '/top_banners/original.php');
        include (TEMPLATEPATH . '/top_banners/original_v2.php');
	}
}



?>