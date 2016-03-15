<?php function wf_show_index_ads(){
	if(get_option('adjump_home_iframe')!=""){
		$output.="<div style='margin:auto 0 25px 25px' >";
		$output.=stripslashes(get_option('adjump_home_iframe'));
		$output.="</div>";
		
	}
	return $output;
}

function wf_show_category_ads($cat_id, $in_sidebar=false){
	if(!$in_sidebar){
	$ads=get_term_meta($cat_id, 'image-url', true);
	}
	else{
		$ads=get_term_meta($cat_id, 'sidebar-image-url', true);
	}
	$ads=trim($ads);
	$is_image=false;
	if(is_category()){
		if(!empty($ads)){
			if(!$in_sidebar){
			$output.="<div style='margin:auto 0 25px 25px' >";
			$output.=stripslashes(stripslashes($ads));
			$output.="</div>";
			}
			else{
			$output.='<div id="sharebox-wrapper" class="ads_relative"><div id="sidebar_ads1">';
			$output.=stripslashes(stripslashes($ads));
			$output.='</div></div>';
			}
		}
		else{
			$parents= wf_return_parents($cat_id);
				
			foreach ($parents as $parent){
			if(!$is_image){	
			$category_ID = get_category_id($parent);
			if(!$in_sidebar){
			$ads=get_term_meta($category_ID, 'image-url', true);
			}
			else{
			$ads=get_term_meta($category_ID, 'sidebar-image-url', true);
			}
			$ads=trim($ads);
			
			if(!empty($ads)){
			$is_image=true;
			if($is_image){
			if(!$in_sidebar){	
				
			$output.="<div style='margin:auto 0 25px 25px' >";
			$output.=stripslashes(stripslashes($ads));
			$output.="</div>";
			}
			else{
			$output.='<div id="sharebox-wrapper" class="ads_relative"><div id="sidebar_ads1">';
			$output.=stripslashes(stripslashes($ads));
			$output.='</div></div>';
			}
			
			}//is_image
			}//$ads!=""
			
			}//!is_image
			}//foreach
			if(empty($ads)){/*echo "Default image if needs to be used"; */}
		
		}
		
	} else if(is_single()&&!$in_sidebar){
		$categories=get_the_category($cat_id);
        $rand_cat=wf_get_random_category($categories);
		if($rand_cat!=-1){
		$ads=get_term_meta($rand_cat, 'image-url', true);
		$output.="<div style='margin:auto 0 25px 25px' >";
		$output.=stripslashes(stripslashes($ads));
		$output.="</div>";
		}
	}
		else if(is_single()&&$in_sidebar){
		$categories=get_the_category($cat_id);
        $rand_cat=wf_get_random_category($categories, true);
		if($rand_cat!=-1){
		$ads=get_term_meta($rand_cat, 'sidebar-image-url', true);
		$output.='<div id="sharebox-wrapper" class="ads_relative"><div id="sidebar_ads1">';
		$output.=stripslashes(stripslashes($ads));
		$output.='</div></div>';
		}
		
		    
	}

  return $output;
}

?>