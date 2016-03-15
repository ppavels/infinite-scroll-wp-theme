<?php 
require_once( ABSPATH . '/wp-admin/includes/taxonomy.php' );

class Category{
	var $brand, $nav, $js;

	function __construct($args=array()){
	add_action('init', array($this, 'simple_term_meta_install'));
	add_action('category_add_form_fields',array($this, 'category_metabox_add'), 10, 1);
	add_action('category_add_form_fields',array($this, 'setScript'), 10, 1);
    add_action('category_edit_form_fields',array($this, 'category_metabox_edit'), 10, 1);
    add_action('category_edit_form_fields',array($this, 'setScript'), 10, 1);	 
    add_action('created_category', array($this, 'save_category_metadata'), 10, 1);	
    add_action('edited_category', array($this, 'save_category_metadata'), 10, 1);
	
	add_action('brands_add_form_fields',array($this, 'brands_metabox_add'), 10, 1);
	add_action('brands_add_form_fields',array($this, 'setScript'), 10, 1);
	add_action('brands_edit_form_fields',array($this, 'brands_metabox_edit'), 10, 1);
	add_action('brands_edit_form_fields',array($this, 'setScript'), 10, 1);
	add_action('created_brands', array($this, 'save_brands_metadata'), 10, 1);	
    add_action('edited_brands', array($this, 'save_brands_metadata'), 10, 1);
	
	add_action('topics_add_form_fields',array($this, 'topics_metabox_add'), 10, 1);
	add_action('topics_add_form_fields',array($this, 'setScript'), 10, 1);
	add_action('topics_edit_form_fields',array($this, 'topics_metabox_edit'), 10, 1);
	add_action('topics_edit_form_fields',array($this, 'setScript'), 10, 1);
	add_action('created_topics', array($this, 'save_topics_metadata'), 10, 1);	
    add_action('edited_topics', array($this, 'save_topics_metadata'), 10, 1);
        
	$this->nav=new Navigation();
	}
	
        public function setScript(){
	
            $this->js=new Images();	
            wp_enqueue_script( "admin-script", $this->js->theme_url( 'js/admin-page.js'), array( 'jquery', 'media-upload' ) );
	
	}
        
	public function getIdByName($cat_name, $type='category'){
		
	$term = get_term_by('name', $cat_name, $type);
	return $term->term_id;
	
	}
	
	
	
	
	public function getURL($cat_name){
		$id=$this->getIdByName($cat_name);
		$url=get_category_link( $id );
		return $url;
	}
	public function getChildren($cat){
		
	global $ancestor;
	
	$post_cats=$this->getPostCategories();
    $childcats = get_categories('child_of=' . $cat . '&hide_empty=1');
    foreach ($childcats as $childcat) {
	 	
		
    if (cat_is_ancestor_of($ancestor, $childcat->cat_ID) == false){
    echo '<li><h2><a href="'.get_category_link($childcat->cat_ID).'">';
    echo $childcat->cat_name . '</a></h2>';
    echo '<p>'.$childcat->category_description.'</p>';
    echo '</li>';
	
	
    $ancestor = $childcat->cat_ID;
  }
}
		
}
	
	public function getBrand(){
		/*$categories=$this->getPostCategories();
		foreach ($categories as $category){
		$parent=$this->getParents($category->term_id);
		if($parent=='Brand'){
			$output=$category->name;
		}
		 
		}*/
		$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' )); 
		return $term;
		
	} 
	
	public function getBrandLink($text=NULL){
		if ($text==NULL){
			$text="More Offers From "; 
		}
		
		$brand=$this->getBrand();
		
		if($brand){
		$url=$this->getURL($brand);
		$output='<a href="'.$url.'">'.$text.$brand.' </a>';
		}
		
		echo $output;
		
	} 
	
	public function getPostCategories(){
		global $post;
		$categories = get_the_category($post->ID);
		
		return $categories;
		
	}
	
	
	
	public function getParents($cat_id){
	
	 $output=array();
	 $parents=explode("/", get_category_parents($cat_id)); 
	 asort($parents, SORT_NUMERIC);
	  foreach ($parents as $parent){
		 if($parent!=""){
		 $output[]=$parent;
		 }
	 }
	 if($output[1]){
	 return  $output[1]; 
	 }
	 return FALSE;
}

public function createCategory($name){
	
	return wp_create_category($name);
}

public function getRandomCategory($arr, $in_sidebar=false){
    $min=0;
	$have_img=array();
	
	
	foreach ($arr as $r_img){
	if(!$in_sidebar){	
	$ads=$this->get_term_meta($r_img->cat_ID, 'image-url', true);
	}
	else{
	$ads=$this->get_term_meta($r_img->cat_ID, 'sidebar-image-url', true);
	}
	$ads=trim($ads);
	
	if(!empty($ads)){
	$have_img[]=$r_img->cat_ID;
	}
	}
	
	$max=(count($have_img)-1);
	if($max==-1){
		$cat=-1;
	}
	else{
	$rand=rand($min,$max);
	$i=0;
	foreach ($have_img as $r){
	if($i==$rand){
	$cat=$r;	
	}
	$i++;
	}
 }
	return $cat;


}

//term meta intall

//custom category fields
function simple_term_meta_install()
{
	// setup custom table
	
	global $wpdb;
	$wpdb->termmeta = $wpdb->prefix . 'termmeta';
        
        //the original function was without this return
	return $wpdb->termmeta = $wpdb->prefix . 'termmeta';
        
	$table_name = $wpdb->prefix . 'termmeta';
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
		  meta_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		  term_id bigint(20) unsigned NOT NULL DEFAULT '0',
		  meta_key varchar(255) DEFAULT NULL,
		  meta_value longtext,
		  PRIMARY KEY (meta_id),
		  KEY term_id (term_id),
		  KEY meta_key (meta_key)	  
		);";
		
		require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
		dbDelta($sql);
		
		
	
}
/**
 * Updates metadata cache for list of term IDs.
 *
 * Performs SQL query to retrieve the metadata for the term IDs and updates the
 * metadata cache for the terms. Therefore, the functions, which call this
 * function, do not need to perform SQL queries on their own.
 *
 * @param array $term_ids List of post IDs.
 * @return bool|array Returns false if there is nothing to update or an array of metadata.
 */
function update_termmeta_cache($term_ids) {
	return update_meta_cache('term', $term_ids);
}
/**
 * Add meta data field to a term.
 *
 * @param int $term_id Term ID.
 * @param string $key Metadata name.
 * @param mixed $value Metadata value.
 * @param bool $unique Optional, default is false. Whether the same key should not be added.
 * @return bool False for failure. True for success.
 */
function add_term_meta( $term_id, $meta_key, $meta_value, $unique = false ) {
	return add_metadata('term', $term_id, $meta_key, $meta_value, $unique);
}
/**
 * Remove metadata matching criteria from a term.
 *
 * You can match based on the key, or key and value. Removing based on key and
 * value, will keep from removing duplicate metadata with the same key. It also
 * allows removing all metadata matching key, if needed.
 *
 * @param int $term_id Term ID
 * @param string $meta_key Metadata name.
 * @param mixed $meta_value Optional. Metadata value.
 * @return bool False for failure. True for success.
 */
function delete_term_meta( $term_id, $meta_key, $meta_value = '' ) {
	return delete_metadata('term', $term_id, $meta_key, $meta_value);
}
/**
 * Retrieve term meta field for a term.
 *
 * @param int $term_id Term ID.
 * @param string $key The meta key to retrieve.
 * @param bool $single Whether to return a single value.
 * @return mixed Will be an array if $single is false. Will be value of meta data field if $single
 *  is true.
 */
function get_term_meta( $term_id, $key, $single = false ) {
	return get_metadata('term', $term_id, $key, $single);
}
/**
 * Update term meta field based on term ID.
 *
 * Use the $prev_value parameter to differentiate between meta fields with the
 * same key and term ID.
 *
 * If the meta field for the term does not exist, it will be added.
 *
 * @param int $term_id Term ID.
 * @param string $key Metadata key.
 * @param mixed $value Metadata value.
 * @param mixed $prev_value Optional. Previous value to check before removing.
 * @return bool False on failure, true if success.
 */
function update_term_meta( $term_id, $meta_key, $meta_value, $prev_value = '' ) {
	return update_metadata('term', $term_id, $meta_key, $meta_value, $prev_value);
}

/**
 * Delete everything from term meta matching meta key.
 *
 * @param string $term_meta_key Key to search for when deleting.
 * @return bool Whether the term meta key was deleted from the database
 */
function delete_term_meta_by_key($term_meta_key) {
	if ( !$term_meta_key )
		return false;
	global $wpdb;
	$term_ids = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT term_id FROM $wpdb->termmeta WHERE meta_key = %s", $term_meta_key));
	if ( $term_ids ) {
		$termmetaids = $wpdb->get_col( $wpdb->prepare( "SELECT meta_id FROM $wpdb->termmeta WHERE meta_key = %s", $term_meta_key ) );
		$in = implode( ',', array_fill(1, count($termmetaids), '%d'));
		do_action( 'delete_termmeta', $termmetaids );
		$wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->termmeta WHERE meta_id IN($in)", $termmetaids ));
		do_action( 'deleted_termmeta', $termmetaids );
		foreach ( $term_ids as $term_id )
			wp_cache_delete($term_id, 'term_meta');
		return true;
	}
	return false;
}
/**
 * Retrieve term meta fields, based on term ID.
 *
 * The term meta fields are retrieved from the cache, so the function is
 * optimized to be called more than once. It also applies to the functions, that
 * use this function.
 *
 * @param int $term_id term ID
 * @return array
 */
function get_term_custom( $term_id ) {
	$term_id = (int) $term_id;
	if ( ! wp_cache_get($term_id, 'term_meta') )
		$this->update_termmeta_cache($term_id);
	return wp_cache_get($term_id, 'term_meta');
}
/**
 * Retrieve meta field names for a term.
 *
 * If there are no meta fields, then nothing (null) will be returned.
 *
 * @param int $term_id term ID
 * @return array|null Either array of the keys, or null if keys could not be retrieved.
 */
function get_term_custom_keys( $term_id ) {
	$custom = $this->get_term_custom( $term_id );
	if ( !is_array($custom) )
		return;
	if ( $keys = array_keys($custom) )
		return $keys;
}
/**
 * Retrieve values for a custom term field.
 *
 * The parameters must not be considered optional. All of the term meta fields
 * will be retrieved and only the meta field key values returned.
 *
 * @param string $key Meta field key.
 * @param int $term_id Term ID
 * @return array Meta field values.
 */
function get_term_custom_values( $key = '', $term_id ) {
	if ( !$key )
		return null;
	$custom = $this->get_term_custom($term_id);
	return isset($custom[$key]) ? $custom[$key] : null;
} 

//not treaded part:
 
 
 function category_metabox_add($tag) { ?>
	<div class="form-field">
		<label for="subcat-nice-name"><?php _e('Category Nicename') ?></label>
		<input name="subcat-nice-name" id="subcat-nice-name" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('This name will be shown on the category page in the title of subcategory.'); ?></p>
	</div>
    	<div class="form-field">
		<label for="cat-meta-title"><?php _e('Metatag TITLE') ?></label>
		<input name="cat-meta-title" id="meta-title" type="text" value="" size="40" aria-required="true" />
                <p class="description countdown title"></p>
		<p class="description"><?php _e('This content will be shown in Meta Tag "Title" on the category page.'); ?></p>
	</div>
    	<div class="form-field">
		<label for="cat-meta-description"><?php _e('Metatag DESCRIPTION') ?></label>
		<input name="cat-meta-description" id="meta-desc" type="text" value="" size="40" aria-required="true" />
                <p class="description countdown desc"></p>
		<p class="description"><?php _e('This content will be shown in Meta Tag "Description" on the category page.'); ?></p>
	</div>
   <?php /* 	<div class="form-field">
		<label for="cat-meta-keywords"><?php _e('Metatag KEYWORDS') ?></label>
		<input name="cat-meta-keywords" id="cat-meta-keywords" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('This content will be shown in Meta Tag "Keywords" on the category page.'); ?></p>
	</div>
    */ ?>
      	<div class="form-field">
		<label for="image-url"><?php _e('Rotating Image HTML Code') ?></label>
		<textarea name="image-url" id="image-url"  aria-required="true"  cols="40" rows="5"></textarea>
		<p class="description"><?php _e('This image will be the ads shown on category page and single post page, related to this category above the title of the post.'); ?></p>
	</div>
    <div class="form-field">
		<label for="sidebar-image-url"><?php _e('Rotating Image HTML Code in Sidebar') ?></label>
		<textarea name="sidebar-image-url" id="sidebar-image-url"  aria-required="true"  cols="40" rows="5"></textarea>
		<p class="description"><?php _e('This image will be the ads shown on category page and single post in the sidebar.'); ?></p>
	</div>
    <div class="form-field">
		<label for="afterpost-image-url"><?php _e('Social Media HTML Code after the Post') ?></label>
		<textarea name="afterpost-image-url" id="afterpost-image-url"  aria-required="true"  cols="40" rows="5"></textarea>
		<p class="description"><?php _e('This code will be  shown on single post page after the post.'); ?></p>
	</div>
	
 
 
<?php } 

function brands_metabox_add($tag) { ?>
	<div class="form-field">
		<label for="brand-meta-description"><?php _e('Brand Meta Description') ?></label>
		<textarea name="brand-meta-description" id="meta-desc" type="text" value="" size="40" aria-required="true" ></textarea>
                <p class="description countdown desc"></p>
		<p class="description"><?php _e('Brand Meta Description.'); ?></p>
	</div>
     <div class="form-field">
		<label for="brand-meta-title"><?php _e('Brand Tag Title') ?></label>
		<input name="brand-meta-title" id="meta-title" type="text" value="" size="40" aria-required="true" />
                <p class="description countdown title"></p>
		<p class="description"><?php _e('Brand Tag Title.'); ?></p>
	</div>	
    
    <div class="form-field">
		<label for="brand-title"><?php _e('Brand Title') ?></label>
		<input name="brand-title" id="brand-title" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('Brand Title.'); ?></p>
	</div>
    <div class="form-field">
		<label for="brand-page-description"><?php _e('Description On Page') ?></label>
		<textarea name="brand-page-description" id="brand-page-description" type="text" value="" size="40" aria-required="true" ></textarea>
		<p class="description"><?php _e('Description On Page.'); ?></p>
	</div>
    <div class="form-field">
		<label for="brand-default-image"><?php _e('Brand Default Image') ?></label>
		<input name="brand-default-image" id="brand-default-image" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('This is the brand default image width:300px, height:158px.'); ?></p>
	</div>
    <div class="form-field">
		<label for="brand-default-image-alt"><?php _e('Brand Default Image Alt Text') ?></label>
		<input name="brand-default-image-alt" id="brand-default-image-alt" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('This is the brand default image alt text.'); ?></p>
	</div>
                <div class="form-field">
            <label for="brand-facebook-page"><?php _e('Brand Facebook Page') ?></label>
            <input name="brand-facebook-page" id="brand-facebook-page" type="text" value="" size="40" aria-required="true" />
            <p class="description"><?php _e('Brand Facebook Page.'); ?></p>
        </div>
        <div class="form-field">
            <label for="brand-twitter-page"><?php _e('Brand Twitter Page') ?></label>
            <input name="brand-twitter-page" id="brand-twitter-page" type="text" value="" size="40" aria-required="true" />
            <p class="description"><?php _e('Brand Twitter Page.'); ?></p>
        </div>
        <div class="form-field">
            <label for="brand-pinterest-page"><?php _e('Brand Pinterest Page') ?></label>
            <input name="brand-pinterest-page" id="brand-pinterest-page" type="text" value="" size="40" aria-required="true" />
            <p class="description"><?php _e('Brand Pinterest Page.'); ?></p>
        </div>
        <div class="form-field">
            <label for="brand-youtube-page"><?php _e('Brand Youtube Page') ?></label>
            <input name="brand-youtube-page" id="brand-youtube-page" type="text" value="" size="40" aria-required="true" />
            <p class="description"><?php _e('Brand Youtube Page.'); ?></p>
        </div>
        <div class="form-field">
            <label for="brand-youtube-page"><?php _e('Brand Google+ Page') ?></label>
            <input name="brand-google-page" id="brand-google-page" type="text" value="" size="40" aria-required="true" />
            <p class="description"><?php _e('Brand Google+ Page.'); ?></p>
        </div>
        <div class="form-field">
            <label for="brand-company-url"><?php _e('Brand Company URL') ?></label>
            <input name="brand-company-url" id="brand-company-url" type="text" value="" size="40" aria-required="true" />
            <p class="description"><?php _e('Brand Company URL.'); ?></p>
        </div>
        <div class="form-field">
            <label for="brand-company-url-text"><?php _e('Brand Company URL Text') ?></label>
            <input name="brand-company-url-text" id="brand-company-url-text" type="text" value="" size="40" aria-required="true" />
            <p class="description"><?php _e('Brand Company URL Text.'); ?></p>
        </div>
<?php } 
function topics_metabox_add($tag) { ?>
<div class="form-field">
		<label for="topic-default-title"><?php _e('Topic Title') ?></label>
		<input name="topic-default-title" id="topic-default-title" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('Topic title'); ?></p>
	</div>
	<div class="form-field">
		<label for="topic-default-icon"><?php _e('Topic Default Icon') ?></label>
		<input name="topic-default-icon" id="topic-default-icon" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('This is the topic default icon recommended width:44px, height:44px'); ?></p>
	</div>




    	<div class="form-field">
		<label for="tag-default-icon"><?php _e('Tag Title') ?></label>
                
		<textarea name="tag-default-icon" id="meta-title"   size="40" aria-required="true" /></textarea>
        <p class="description countdown title"></p>
		<p class="description"><?php //_e('Tad Title'); ?></p>
	</div>
	<div class="form-field">
		<label for="topic-default-meta"><?php _e('Meta Description') ?></label>
		<textarea name="topic-default-meta" id="meta-desc"  size="40" aria-required="true" /></textarea>
        <p class="description countdown desc"></p>
		<p class="description"><?php// _e('This is the topic default icon recommended width:44px, height:44px'); ?></p>
	</div>

<div class="form-field">
		<label for="topic-default-h1"><?php _e('H1 Topic Title') ?></label>
		<input name="topic-default-h1" id="topic-default-h1" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php//_e('This is the topic default icon recommended width:44px, height:44px'); ?></p>
	</div>
<div class="form-field">
		<label for="topic-default-h2"><?php _e('H2 Topic Title') ?></label>
		<input name="topic-default-h2" id="topic-default-h2" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php //_e('This is the topic default icon recommended width:44px, height:44px'); ?></p>
	</div>
<div class="form-field">
		<label for="topic-default-page"><?php _e('Page Description') ?></label>
		<textarea name="topic-default-page" id="topic-default-page"  size="40" aria-required="true" /></textarea>
		<p class="description"><?php //_e('This is the topic default icon recommended width:44px, height:44px'); ?></p>
	</div>
<?php } 
function category_metabox_edit($tag) { ?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="subcat-nice-name"><?php _e('Category Nicename'); ?></label>
		</th>
		<td>
			<input name="subcat-nice-name" id="subcat-nice-name" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'subcat-nice-name', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('This name will be shown on the category page in the title of subcategory.'); ?></p>
		</td>
	</tr>
    
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat-meta-title"><?php _e('Metatag Title'); ?></label>
		</th>
		<td>
			<input name="cat-meta-title" id="meta-title" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'cat-meta-title', true); ?>" size="40" aria-required="true" />
			<p class="description countdown title"></p>
                        <p class="description"><?php _e('This content will be shown in Meta Tag "Title" on the category page.'); ?></p>
		</td>
	</tr>
        
        	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat-meta-description"><?php _e('Metatag DESCRIPTION'); ?></label>
		</th>
		<td>
			<input name="cat-meta-description" id="meta-desc" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'cat-meta-description', true); ?>" size="40" aria-required="true" />
			<p class="description countdown desc"></p>
                        <p class="description"><?php _e('This content will be shown in Meta Tag "Description" on the category page.'); ?></p>
		</td>
	</tr>
        

    
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="image-url"><?php _e('Rotating Image HTML Code') ?></label>
		</th>
		<td>
			
		<textarea name="image-url"  cols="40" rows="7"><?php echo $this->get_term_meta($tag->term_id, 'image-url', true); ?></textarea>
		<p class="description"><?php _e('This image will be the ads shown on category page and single post page, related to this category above the title of the post.'); ?></p>
		</td>
	</tr>
        <tr class="form-field">
		<th scope="row" valign="top">
			<label for="sidebar-image-url"><?php _e('Rotating Image HTML Code in Sidebar') ?></label>
		</th>
		<td>
			
		<textarea name="sidebar-image-url"  cols="40" rows="7"><?php echo $this->get_term_meta($tag->term_id, 'sidebar-image-url', true); ?></textarea>
		<p class="description"><?php _e('This image will be the ads shown on category page and single post in the sidebar.'); ?></p>
		</td>
	</tr>
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="sidebar-image-url"><?php _e('Social Media HTML Code after the Post') ?></label>
		</th>
		<td>
			
		<textarea name="afterpost-image-url"  cols="40" rows="7"><?php echo $this->get_term_meta($tag->term_id, 'afterpost-image-url', true); ?></textarea>
		<p class="description"><?php _e('This code will be  shown on single post page after the post.'); ?></p>
		</td>
	</tr>
    
    
<?php }
 function brands_metabox_edit($tag) { ?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-meta-description"><?php _e('Brand Meta Description'); ?></label>
		</th>
		<td>
			<textarea name="brand-meta-description" id="meta-desc"  size="40"  ><?php echo $this->get_term_meta($tag->term_id, 'brand-meta-description', true); ?></textarea>
			<p class="description countdown desc"></p>
                        <p class="description"><?php _e('Brand Meta Description.'); ?></p>
		</td>
	</tr>
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-meta-title"><?php _e('Brand Tag Title'); ?></label>
		</th>
		<td>
			<input name="brand-meta-title" id="meta-title" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'brand-meta-title', true); ?>" size="40" aria-required="true" />
			<p class="description countdown title"></p>
                        <p class="description"><?php _e('Brand Tag Title'); ?></p>
		</td>
	</tr>
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-title"><?php _e('Brand Title'); ?></label>
		</th>
		<td>
			<input name="brand-title" id="brand-title" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'brand-title', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('Brand Title'); ?></p>
		</td>
	</tr>
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-default-image"><?php _e('Description On Page'); ?></label>
		</th>
		<td>
			<textarea name="brand-page-description" id="brand-page-description"  size="40"  ><?php echo $this->get_term_meta($tag->term_id, 'brand-page-description', true); ?></textarea>
			<p class="description"><?php _e('Description On Page'); ?></p>
		</td>
	</tr>
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-default-image"><?php _e('Brand Default Image'); ?></label>
		</th>
		<td>
			<input name="brand-default-image" id="brand-default-image" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'brand-default-image', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('This is the brand default image width:300px, height:158px.'); ?></p>
		</td>
	</tr>
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-default-image-alt"><?php _e('Brand Default Image Alt Text'); ?></label>
		</th>
		<td>
			<input name="brand-default-image-alt" id="brand-default-image-alt" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'brand-default-image-alt', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('Brand Default Image Alt Text'); ?></p>
		</td>
	</tr>
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-facebook-page"><?php _e('Brand Facebook Page'); ?></label>
		</th>
		<td>
			<input name="brand-facebook-page" id="brand-facebook-page" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'brand-facebook-page', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('Brand Facebook Page'); ?></p>
		</td>
	</tr>
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-twitter-page"><?php _e('Brand Twitter Page'); ?></label>
		</th>
		<td>
			<input name="brand-twitter-page" id="brand-twitter-page" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'brand-twitter-page', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('Brand Twitter Page'); ?></p>
		</td>
	</tr>
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-pinterest-page"><?php _e('Brand Pinterest Page'); ?></label>
		</th>
		<td>
			<input name="brand-pinterest-page" id="brand-pinterest-page" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'brand-pinterest-page', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('Brand Pinterest Page'); ?></p>
		</td>
	</tr>
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-youtube-page"><?php _e('Brand Youtube Page'); ?></label>
		</th>
		<td>
			<input name="brand-youtube-page" id="brand-youtube-page" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'brand-youtube-page', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('Brand Youtube Page'); ?></p>
		</td>
	</tr>
     <tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-google-page"><?php _e('Brand Google+ Page'); ?></label>
		</th>
		<td>
			<input name="brand-google-page" id="brand-google-page" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'brand-google-page', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('Brand Google+ Page'); ?></p>
		</td>
	</tr>
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-company-url"><?php _e('Brand Company URL'); ?></label>
		</th>
		<td>
			<input name="brand-company-url" id="brand-company-url" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'brand-company-url', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('Brand Company URL'); ?></p>
		</td>
	</tr>
        <tr class="form-field">
		<th scope="row" valign="top">
			<label for="brand-company-url-text"><?php _e('Brand Company URL Text'); ?></label>
		</th>
		<td>
			<input name="brand-company-url-text" id="brand-company-url-text" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'brand-company-url-text', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('Brand Company URL Text'); ?></p>
		</td>
	</tr>
    
<?php }

 function topics_metabox_edit($tag) { ?>
 
 	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="topic-default-title"><?php _e('Topic Title'); ?></label>
		</th>
		<td>
			<input name="topic-default-title" id="topic-default-title" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'topic-default-title', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('This is the topic title.'); ?></p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="topic-default-icon"><?php _e('Topic Default Item'); ?></label>
		</th>
		<td>
			<input name="topic-default-icon" id="topic-default-icon" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'topic-default-icon', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('This is the topic default icon recommended width:44px, height:44px.'); ?></p>
		</td>
	</tr>
        
        
        
        <tr class="form-field">
		<th scope="row" valign="top">
			<label for="tag-default-icon"><?php _e('Tag Title '); ?></label>
		</th>
		<td>
			 <textarea name="tag-default-icon" id="meta-title"  size="40"  ><?php echo $this->get_term_meta($tag->term_id, 'tag-default-icon', true); ?></textarea>
			<p class="description countdown title"></p>
                         <p class="description"><?php //_e('This is the topic default icon recommended width:44px, height:44px.'); ?></p>
		</td>
	</tr>
        <tr class="form-field">
		<th scope="row" valign="top">
			<label for="topic-default-meta"><?php _e('Meta Description'); ?></label>
		</th>
		<td>
			 <textarea name="topic-default-meta" id="meta-desc"  size="40"  ><?php echo $this->get_term_meta($tag->term_id, 'topic-default-meta', true); ?></textarea>
			<p class="description countdown desc"></p>
                         <p class="description"><?php //_e('This is the topic default icon recommended width:44px, height:44px.'); ?></p>
		</td>
	</tr>
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="topic-default-h1"><?php _e('H1 Topic Title'); ?></label>
		</th>
		<td>
			<input name="topic-default-h1" id="topic-default-h1" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'topic-default-h1', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php //_e('This is the topic default icon recommended width:44px, height:44px.'); ?></p>
		</td>
	</tr>
        <tr class="form-field">
		<th scope="row" valign="top">
			<label for="topic-default-h2"><?php _e('H2 Topic Title'); ?></label>
		</th>
		<td>
			<input name="topic-default-h2" id="topic-default-h2" type="text" value="<?php echo $this->get_term_meta($tag->term_id, 'topic-default-h2', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php //_e('This is the topic default icon recommended width:44px, height:44px.'); ?></p>
		</td>
	</tr>
         <tr class="form-field">
		<th scope="row" valign="top">
			<label for="topic-default-page"><?php _e('Page Description'); ?></label>
		</th>
		<td>
			 <textarea name="topic-default-page" id="topic-default-page"  size="40"  ><?php echo $this->get_term_meta($tag->term_id, 'topic-default-page', true); ?></textarea>
			<p class="description"><?php //_e('This is the topic default icon recommended width:44px, height:44px.'); ?></p>
		</td>
	</tr>
<?php }
//topic-default-icon
///last function  
function save_category_metadata($term_id){
if (isset($_POST['subcat-nice-name'])) {
		$this->update_term_meta( $term_id, 'subcat-nice-name', $_POST['subcat-nice-name']);         			
}
if (isset($_POST['cat-meta-keywords'])) {
		$this->update_term_meta( $term_id, 'cat-meta-keywords', $_POST['cat-meta-keywords']);         			
}
if (isset($_POST['cat-meta-description'])) {
		$this->update_term_meta( $term_id, 'cat-meta-description', $_POST['cat-meta-description']);         			
}
if (isset($_POST['cat-meta-title'])) {
		$this->update_term_meta( $term_id, 'cat-meta-title', $_POST['cat-meta-title']);         			
}
if (isset($_POST['image-url'])) {
		$this->update_term_meta( $term_id, 'image-url', $_POST['image-url']);         			
}
if (isset($_POST['sidebar-image-url'])) {
		$this->update_term_meta( $term_id, 'sidebar-image-url', $_POST['sidebar-image-url']);         			
}
if (isset($_POST['afterpost-image-url'])) {
		$this->update_term_meta( $term_id, 'afterpost-image-url', $_POST['afterpost-image-url']);         			
}
if (isset($_POST['after_post_tag-image-url'])) {
		$this->update_term_meta( $term_id, 'after_post_tag-image-url', $_POST['after_post_tag-image-url']);         			
}
}

function save_brands_metadata($term_id){
if (isset($_POST['brand-meta-description'])) {
		$this->update_term_meta( $term_id, 'brand-meta-description', $_POST['brand-meta-description']);         			
}
if (isset($_POST['brand-meta-title'])) {
		$this->update_term_meta( $term_id, 'brand-meta-title', $_POST['brand-meta-title']);         			
}
if (isset($_POST['brand-title'])) {
		$this->update_term_meta( $term_id, 'brand-title', $_POST['brand-title']);         			
}
if (isset($_POST['brand-page-description'])) {
		$this->update_term_meta( $term_id, 'brand-page-description', $_POST['brand-page-description']);         			
}
if (isset($_POST['brand-default-image'])) {
		$this->update_term_meta( $term_id, 'brand-default-image', $_POST['brand-default-image']);         			
}
if (isset($_POST['brand-default-image-alt'])) {
		$this->update_term_meta( $term_id, 'brand-default-image-alt', $_POST['brand-default-image-alt']);         			
}
if (isset($_POST['brand-facebook-page'])) {
		$this->update_term_meta( $term_id, 'brand-facebook-page', $_POST['brand-facebook-page']);         			
}
if (isset($_POST['brand-twitter-page'])) {
		$this->update_term_meta( $term_id, 'brand-twitter-page', $_POST['brand-twitter-page']);         			
}
if (isset($_POST['brand-pinterest-page'])) {
		$this->update_term_meta( $term_id, 'brand-pinterest-page', $_POST['brand-pinterest-page']);         			
}
if (isset($_POST['brand-youtube-page'])) {
		$this->update_term_meta( $term_id, 'brand-youtube-page', $_POST['brand-youtube-page']);         			
}
if (isset($_POST['brand-google-page'])) {
		$this->update_term_meta( $term_id, 'brand-google-page', $_POST['brand-google-page']);         			
}
if (isset($_POST['brand-company-url'])) {
		$this->update_term_meta( $term_id, 'brand-company-url', $_POST['brand-company-url']);         			
}
if (isset($_POST['brand-company-url-text'])) {
		$this->update_term_meta( $term_id, 'brand-company-url-text', $_POST['brand-company-url-text']);         			
}
}
function save_topics_metadata($term_id){
if (isset($_POST['topic-default-icon'])) {
		$this->update_term_meta( $term_id, 'topic-default-icon', $_POST['topic-default-icon']);         			
}
if (isset($_POST['topic-default-title'])) {
		$this->update_term_meta( $term_id, 'topic-default-title', $_POST['topic-default-title']);         			
}
if (isset($_POST['tag-default-icon'])) {
		$this->update_term_meta( $term_id, 'tag-default-icon', $_POST['tag-default-icon']);         			
}
if (isset($_POST['topic-default-meta'])) {
		$this->update_term_meta( $term_id, 'topic-default-meta', $_POST['topic-default-meta']);         			
}
if (isset($_POST['topic-default-h1'])) {
		$this->update_term_meta( $term_id, 'topic-default-h1', $_POST['topic-default-h1']);         			
}
if (isset($_POST['topic-default-h2'])) {
		$this->update_term_meta( $term_id, 'topic-default-h2', $_POST['topic-default-h2']);         			
}
if (isset($_POST['topic-default-page'])) {
		$this->update_term_meta( $term_id, 'topic-default-page', $_POST['topic-default-page']);         			
}

}
//topic-default-icon

public function getAllButNot($cat_name, $return='term_id'){
	
	$id=$this->getIdByName($cat_name);
	$cats_list=get_categories('exclude='.$id);
	foreach($cats_list as $cat_list){
	$catid_list[]=$cat_list->$return;
	}
	return $catid_list;
}

public function getSingleCatTitle($lowercase=TRUE){
	$current_category = single_cat_title("", false); 
	if($lowercase){
		$current_category=strtolower($current_category);
	}
	return $current_category; 
}

public function getCatSlug($lowercase=TRUE){
	$current_category = single_cat_title("", false); 
	if($lowercase){
		$current_category=strtolower($current_category);
	}
	return $current_category; 
}

/*
public function getCoupons($type=NULL){
if($type==NULL){
$the_query=new WP_Query( 'category_name=Coupons, posts_per_page=2' );	
}
else{
$args = array( 'coupons' => $type , 'posts_per_page' => 2, 'paged' => $paged );
$the_query = new WP_Query($args);
}



//
include (TEMPLATEPATH . '/styles/coupons/header.php' ); 
while ($the_query->have_posts()) : $the_query->the_post(); 
include (TEMPLATEPATH . '/styles/coupons/content.php' ); 
endwhile; 

include (TEMPLATEPATH . '/styles/coupons/footer.php' );
}

*/

public function getPostsInCategoryByTaxonomy($category_name, $taxonomy_name, $sub_taxonomy_name){
    global $wpdb;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$tax_query[] = array(
			'taxonomy' => $taxonomy_name,
			'field' => 'name',
			'terms' => $sub_taxonomy_name
		);
$today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );
$args= array(
	'category_name' => $category_name,
//	'paged' => $paged,
	'tax_query' => $tax_query,
 //   'post__not_in' => $excludeposts,
        //'meta_query' =>   array(array('key' => 'expired-date','value' => date("m/d/Y"),'compare' => '>='))

);
$cat_query = new WP_Query($args);

//echo 'tut';
//echo '<pre>' . print_r( $cat_query ) . '</pre>';
/*while ($cat_query->have_posts()) : $cat_query->the_post();
the_title();
endwhile;*/
return  $cat_query;

}
public function getBrandCoupons($brand_post){
rewind_posts(); 
global $wpdb;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	   $today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );

$tax_query[] = array(
			'taxonomy' => 'brands',
			'field' => 'slug',
			'terms' => $brand_post
		);
$args= array(
	'category_name' => 'Coupons',
	'paged' => $paged,
		  'post__not_in' => $excludeposts,
	'tax_query' => $tax_query,
  //  'meta_query' =>   array(array('key' => 'expired-date','value' => date("m/d/Y"),'compare' => '>='))
);
    

//query_posts($args);
if (count(query_posts($args))>0){ return TRUE;}
else {}

;

//while ( have_posts() ) : the_post();  
      // the_content();  
//endwhile;  
}


public function getCoupons(){
 
global $loop_index;
$loop_index=1;
rewind_posts();
$post_number=10;
$sub_taxonomy='';
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


if (isset($_POST['brand_post']) && ($_POST['brand_post']!='no_brand') || ($_POST['mail']=='1')
    || ($_POST['print']=='1') || ($_POST['online']=='1'))
    { 
	$sub_taxonomy=$_POST['brand_post'];
    $tax_query = array();
    if (isset($_POST['brand_post']) && ($_POST['brand_post']!='no_brand')) {
    $tax_query[] = array(
	'taxonomy' => 'brands',
	'field' => 'slug',
	'terms' => $_POST['brand_post']
		);
}
if (($_POST['mail']=='1') || ($_POST['print']=='1') || ($_POST['online']=='1')) {
if ($_POST['mail']=='1') $mail = array('key' => 'coupon-type','value' =>'mail','type' => 'LIKE');
if ($_POST['print']=='1')  $print = array('key' => 'coupon-type','value' =>'print','type' => 'LIKE');
if ($_POST['online']=='1') $online = array('key' => 'coupon-type','value' =>'online','type' => 'LIKE');}
$date = array('key' => 'expired-date','value' => date("m/d/Y"),'compare' => '>=');
$meta_query = array(
'relation' => 'OR',
$mail,$print,$online,$date);

    
    
$args= array(
	'category_name' => 'Coupons',
	'paged' => $paged,
	'posts_per_page' => $post_number,
        'tax_query' => $tax_query,
        'meta_query' => $meta_query,
   
    );

}else {
    
   $args= array(
	'category_name' => 'Coupons',
	'paged' => $paged,
	'posts_per_page' => $post_number,
      'meta_query' => array(
           array(
                'key' => 'expired-date', 
                'value' => date("m/d/Y"), 
                'compare' => '>=', 
             //   'type' => 'NUMERIC,' 
                ),
    
    )
);
}
query_posts($args);
include (TEMPLATEPATH . '/styles/coupons/header.php' ); 
while (have_posts()) : the_post();
include (TEMPLATEPATH . '/styles/coupons/content.php' ); 
if($loop_index==1){
	include (TEMPLATEPATH . '/styles/coupons/content_google.php' ); 
}
$loop_index++;
endwhile;
include (TEMPLATEPATH . '/styles/coupons/footer.php' );
}



public function getFilterDropdown($category_name, $taxonomy_slug, $sub_taxonomy=NULL){
 $terms = get_terms($taxonomy_slug); 
 $values = array();
 parse_str($_COOKIE['poertclass'], $values);
 $count = count($terms);  
 if($count > 0){  
     $selected=' selected="selected" ';
  echo "<select class='brand_post' name='brand_post' id='brand_post_js'>"; 
  echo "<option ".$selected." value='no_brand'>- All $taxonomy_slug -</option>"; 
  foreach ($terms as $term) {  
  if(($_POST['brand_post']==$term->slug)||($values['brand_post']==$term->slug)){
	  $selected=' selected="selected" ';
  }
  else{
	  $selected='';
  }
  $cat_query=$this->getPostsInCategoryByTaxonomy($category_name, $taxonomy_slug, $term->name);
 if ($cat_query->post_count>0){
  echo "<option ".$selected." value='$term->slug'>".$term->name." (".$cat_query->found_posts.")</option>";  }
 }  
  echo "</select>";  
 
 }  
 
	
	
	
}
public function getRewards(){
global $loop_index;
$loop_index=1;
global $wpdb;
//rewind_posts();
$post_number=10;
$today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args= array(
	'category_name' => 'Rewards',
	'paged' => $paged,
        'post__not_in' => $excludeposts,
	'posts_per_page' => $post_number,
);
query_posts($args);
include (TEMPLATEPATH . '/styles/rewards/header.php' ); 
while (have_posts()) : the_post();
include (TEMPLATEPATH . '/styles/rewards/content.php' ); 
if($loop_index==1){
	include (TEMPLATEPATH . '/styles/rewards/content_google_rewards.php' ); 
}
$loop_index++;
endwhile;
include (TEMPLATEPATH . '/styles/rewards/footer.php' );
}


/**
* Take Subpages;
*/

public function getSubTest( $topic_name='travel'){
wp_reset_query();
wp_reset_postdata();

$args = array( 'topics' => $topic_name , 'posts_per_page' => -1, 'paged' => $paged );
$the_query = new WP_Query($args);
while ($the_query->have_posts()) : $the_query->the_post(); 
?>
<h2><?php the_title();?></h2>
<?php 
endwhile;
	
}
public function getSubPage($parent_page, $topic){
global $loop_index, $post;
global $wpdb;
$loop_index=1;	
$num_post_to_display=6;
$pagename=$this->getIncludePageName($parent_page);
$topic_name=strtolower($topic);
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );

$tax_query[] = array(
			'taxonomy' => 'topics',
			'field' => 'slug',
			'terms' => $topic_name
		);
$meta_query = $this->buildMetaQuery($parent_page);
$args= array(
	'category_name' => $parent_page,
        'posts_per_page' => $num_post_to_display,
	'paged' => $paged,
        'post__not_in' => $excludeposts,
	'tax_query' => $tax_query,
        'meta_query' =>   $meta_query

); 
?><!-- <pre><?php // print_r($_COOKIE);?></pre>-->
 <!-- <pre><?php // print_r($args);?></pre>--><?php

$cat_query = new WP_Query($args);
$number_of_posts=$cat_query->found_posts;
//$pagename='contests';
//print_r($post);
include (TEMPLATEPATH . '/styles/'.$pagename.'/header.php' ); 
while ($cat_query->have_posts()) : $cat_query->the_post();
include (TEMPLATEPATH . '/styles/'.$pagename.'/content.php' );
if($loop_index==6){
//	include (TEMPLATEPATH . '/styles/'.$pagename.'/content_google.php' ); 
}
$loop_index++;
endwhile;
wp_reset_query();
//echo $pagename;
include (TEMPLATEPATH . '/styles/'.$pagename.'/footer.php' );



}

/**
*
*/

public function getTopPosts($cat_name){
//rewind_posts();
$post_number=6;
global $wpdb;
$today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args= array(
	'category_name' => $cat_name ,
	'paged' => $paged,
        'post__not_in' => $excludeposts,
	'posts_per_page' => $post_number,
   // 'meta_query' =>   array(array('key' => 'expired-date','value' => date("m/d/Y"),'compare' => '>='))
	/*'meta_query' => array(
       array(
           'key' => 'top_post',
           'value' => 'top_post',
           'compare' => 'LIKE',
       )
	)*/
);
$the_query = new WP_Query($args);
//wp_reset_query();
//wp_reset_postdata();
//if (!$the_query->have_posts()) {return NULL;}else{
?>
<h2 class="top-styles" style="" >
<?php  $info=new Post();
$title_id = get_page_by_title( $cat_name );
$sb_title = $info->getSidebarTitle($title_id->ID); 
echo preg_replace("#^([^\s]+)#", '<span>$1</span>', $sb_title); ?>
</h2>
<img src="<?php bloginfo('template_url'); ?>/images/top-balls-pic.gif" alt="<?php echo $cat_name; ?>">
 <ul>
<?php
while ($the_query->have_posts()) : $the_query->the_post(); 
?>
<li><a href="<?php the_permalink(); ?>"><?php 
$string = get_the_title();
$string = implode(array_slice(explode('<br>',wordwrap($string,34,'<br>',false)),0,1));
echo $string; ?></a></li>
<?php

$loop_index++;
//
endwhile;
?>
</ul>

<?php
//}
}

public function getSubPagesArray( $name ){ 
wp_reset_query();
$page = get_page_by_title( $name );
$pagelnk = get_page_link($page->ID);
$portfolio =  get_page_by_title($name);
$my_wp_query = query_posts(array('post_type' => 'page', 'post_parent'=>$portfolio->ID));
$arr[] = $name;
if( have_posts() ){ 
	  while( have_posts() ){ the_post(); 
          global $post;
    $arr[] .= $post->post_title;
          }
          return $arr;
	  wp_reset_query();
} else {
}
wp_reset_query();
}

public function getSubPagesList( $name ){ 
wp_reset_query();
$page = get_page_by_title( $name );
$pagelnk = get_page_link($page->ID);
$portfolio =  get_page_by_title($name);
$my_wp_query = query_posts(array('post_type' => 'page', 'post_parent'=>$portfolio->ID));

?><ul><?php
if( have_posts() ){ 
	  while( have_posts() ){ the_post(); 
          global $post;
         $info=new Post();
$sb_title = $info->getSidebarTitle($post->ID);
if($sb_title == '') $sb_title = $post->post_title;
          
 echo '<li><a href="'.$pagelnk.$post->post_name.'">'.$sb_title.'</a></li>';
          }
	  wp_reset_query();
} 

else {
}
?></ul><?php

//echo '<pre>' . print_r( $my_wp_query, true ) . '</pre>';
    
}

public function getSubPagesNames( $name ){ 
wp_reset_query();
$page = get_page_by_title( $name );
$pagelnk = get_page_link($page->ID);
$portfolio =  get_page_by_title($name);
$my_wp_query = query_posts(array('post_type' => 'page', 'post_parent'=>$portfolio->ID));

if( have_posts() ){ 
	  while( have_posts() ){ the_post(); 
          global $post;
         $info=new Post();
$title_id = get_page_by_title( $post->post_title );
$sb_title = $info->getSidebarTitle($title_id->ID);
if($sb_title == '') $sb_title = $post->post_title;
          
 $arr[] .= $post->post_name;
          }
	  wp_reset_query();
} 

else {
}
return $arr;
//echo '<pre>' . print_r( $my_wp_query, true ) . '</pre>';
    
}

public function getLocalpage(){
global $loop_index;
$loop_index=1;
global $wpdb;
$post_number=5;
$today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args= array(
	'category_name' => 'Local',
        'post__not_in' => $excludeposts,
    	'paged' => $paged,
	'posts_per_page' => $post_number
);
query_posts($args);
include (TEMPLATEPATH . '/styles/local/header.php' ); 
while (have_posts()) : the_post(); 
include (TEMPLATEPATH . '/styles/local/content.php' ); 
if($loop_index==4){
	include (TEMPLATEPATH . '/styles/local/content_google_free_samples.php' ); 
}
$loop_index++;
endwhile;


include (TEMPLATEPATH . '/styles/local/footer.php' );
}


public function getDailyDealspage(){
global $loop_index;
$loop_index=1;
global $wpdb;
$post_number=5;
$today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args= array(
	'category_name' => 'Daily Deals',
	'paged' => $paged,
        'post__not_in' => $excludeposts,
	'posts_per_page' => $post_number,
   //     'meta_query' =>   array(array('key' => 'expired-date','value' => date("m/d/Y"),'compare' => '>='))
);
query_posts($args);
include (TEMPLATEPATH . '/styles/daily-deals/header.php' ); 
while (have_posts()) : the_post(); 
include (TEMPLATEPATH . '/styles/daily-deals/content.php' ); 
if($loop_index==4){
	include (TEMPLATEPATH . '/styles/daily-deals/content_google_free_samples.php' ); 
}
$loop_index++;
endwhile;


include (TEMPLATEPATH . '/styles/daily-deals/footer.php' );
}






public function getCategoryByName($name, $num_post_to_display=5, $google_display_every=2,  $is_page=TRUE){
	
global $wpdb;
$page_to_include=$this->getIncludePageName($name);
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$meta_query = $this->buildMetaQuery($name);
$tax_query = $this->buildTaxQuery($name);
	   $today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );
	
           $args = array(
          'category_name' => $name,
		  'paged'=>$paged,
                'post__not_in' => $excludeposts,
                'posts_per_page' => $num_post_to_display,
                'tax_query' => $tax_query,
                'meta_query' => $meta_query,
            

        );

$i=1;
$sl_query = new WP_Query($args); 
$number_of_posts=$sl_query->found_posts;

//Debug Query:
//echo "<pre>".print_r($args)."</pre>";


include (TEMPLATEPATH . '/styles/'.$page_to_include.'/header.php' );
while ($sl_query->have_posts()) : $sl_query->the_post();
    global $post;
    $key_1_values = '';
    $check_desktop = '';
    $check_desktop = get_post_meta($post->ID, 'desktop', true);
    if ($check_desktop != 'not_display') {
        if ($page_to_include == 'free-samples') {
            $key_1_values = get_post_meta($post->ID, 'is-sticky', true);
        }
        if ($key_1_values != 'is-sticky') {
            include(TEMPLATEPATH . '/styles/' . $page_to_include . '/content.php');
        }
        if ($i == $google_display_every) {


            require(TEMPLATEPATH . '/styles/' . $page_to_include . '/content_google.php');

        }
        $i++;
    }
endwhile;

wp_reset_query();
include (TEMPLATEPATH . '/styles/'.$page_to_include.'/footer.php' );


}

public function buildTaxQuery($name){
    $tax_query = array();
    if ($name == 'Coupons'){
              $tax_query = $this->buildCouponsTaxQuery();
              return $tax_query;
         }
         else{
             return $tax_query;
         }
}

public function buildMetaQuery($name){
    $meta_query = array();
    if ($name == 'Coupons'){
               $meta_query = $this->buildCouponsMetaQuery();
               return $meta_query;
         }
    if ($name == 'Contests'){
               $meta_query = $this->buildContestsMetaQuery();
               return $meta_query;
         }
    if ($name == 'Free Samples'){
           //    $meta_query = $this->buildFreeSamplesMetaQuery();
               return $meta_query;
         }     
         else{
             return $meta_query;
         }
}

public function buildFreeSamplesMetaQuery(){
$meta_query = array(
		array(
			'key' => 'is-sticky',
			'value' => 'is-sticky',
			'compare' => 'LIKE'
		)
	);
return $meta_query;
}

public function buildCouponsMetaQuery(){
    $meta_query = array();
  
if (($_POST['mail']=='1') || ($_POST['print']=='1') || ($_POST['online']=='1')) 
{
if ($_POST['mail']=='1') $mail = array('key' => 'coupon-type','value' =>'mail','type' => 'LIKE');
if ($_POST['print']=='1')  $print = array('key' => 'coupon-type','value' =>'print','type' => 'LIKE');
if ($_POST['online']=='1') $online = array('key' => 'coupon-type','value' =>'online','type' => 'LIKE');
$meta_query = array('relation' => 'OR', $mail, $print, $online);
return $meta_query;
}
else{
return $meta_query;      
}
}

public function buildCouponsTaxQuery(){
     $tax_query = array();
     
if (isset($_POST['brand_post']) && ($_POST['brand_post']!='no_brand')) {
$tax_query[] = array(
	'taxonomy' => 'brands',
	'field' => 'name',
	'terms' => $_POST['brand_post']
		);
return $tax_query;
}
else{
    return $tax_query;
}
}

public function buildContestsMetaQuery(){
$meta_query = array();
$values = array();
$meta_query['relation']='AND';
parse_str($_COOKIE['poertclass'], $values);
if ((($_COOKIE['poertclass'])!='frequency=Please+Select&brand_post=no_brand')&&
((array_key_exists('poertclass', $_COOKIE))))    
    {
foreach ($values as $k=>$v){
    if ($v==1)$k = array('key' => 'entry-type','value' => $k,'compare' => 'LIKE') ;
if (is_array($k)){$meta_query[]=$k;}
   
}
if ($values['frequency'] != 'Please Select'){
$meta_query[]=array('key' => 'entry-frequency','value' => $values['frequency'],'compare' => 'LIKE') ;
}
$_COOKIE['poertclass']='frequency=Please+Select&brand_post=no_brand';
return $meta_query;   
}
else{
    return $meta_query;   
}
}

public function buildContestsTaxQuery(){
     $tax_query = array();
     
if (isset($_POST['brand_post']) && ($_POST['brand_post']!='no_brand')) {
$tax_query[] = array(
	'taxonomy' => 'brands',
	'field' => 'slug',
	'terms' => $_POST['brand_post']
		);
$_COOKIE['poertclass']='frequency=Please+Select&brand_post=no_brand';
return $tax_query;
}
else{
    return $tax_query;
}
}

public function getIncludePageName($name){
	
	$pages=array('Free Samples'=>'free-samples', 'Sales'=>'sales', 'Coupons'=>'coupons', 'Contests'=>'contests', 'Rewards'=>'rewards', 'Blog'=>'blog');
	return $pages[$name];

}








public function getFreesamples(){

$loop_index=0; 
global $wpdb;
	
$post_number=5;
$today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args= array(
	'category_name' => 'Free Samples',
     'post__not_in' => $excludeposts,
	'paged' => $paged, 
	'posts_per_page' => $post_number,
 //   'meta_query' =>   array(array('key' => 'is-sticky','value' => 'is-sticky','compare' => 'NOT LIKE'))
);
$wp_query = new WP_Query($args);
include (TEMPLATEPATH . '/styles/free-samples/header.php' ); 
while ($wp_query->have_posts()) : $wp_query->the_post(); 
include (TEMPLATEPATH . '/styles/free-samples/content.php' ); 
if($loop_index==1){
	//include (TEMPLATEPATH . '/styles/free-samples/content_google_free_samples.php' ); 
}
$loop_index++;
endwhile;


include (TEMPLATEPATH . '/styles/free-samples/footer.php' );
}




public function getSales(){

//rewind_posts();
global $wpdb;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	   $today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );
	   $today = date('m/d/Y');
           $args = array(
               'category_name' => 'Sales',
		  'paged'=>$paged,
	 'post__not_in' => $excludeposts,
          //        'ignore_sticky_posts'=>1,
                  'posts_per_page' => 4,
             //     'meta_query' =>   array(
               //       array('key' => 'expired-date','value' => date("m/d/Y"),'compare' => '>='),
                 //     ),

        );
global $counter; 
$counter=0;
$sl_query = new WP_Query($args); 
include (TEMPLATEPATH . '/styles/sales/header.php' ); 
while ($sl_query->have_posts()) : $sl_query->the_post();
include (TEMPLATEPATH . '/styles/sales/content.php' ); 
if($counter==2){
	include (TEMPLATEPATH . '/styles/sales/content_google_sales.php' ); 
}
$counter++;
endwhile;

include (TEMPLATEPATH . '/styles/sales/footer.php' );
}



public function getBlogs(){
global $loop_index;
$loop_index=1;

rewind_posts();
$post_number=5;
global $wpdb;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	   $today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );
$args= array(
	'category_name' => 'Blog',
	'paged' => $paged,
		  'post__not_in' => $excludeposts,
	'posts_per_page' => $post_number,
 //   'meta_query' =>   array(array('key' => 'expired-date','value' => date("m/d/Y"),'compare' => '>='))
);
query_posts($args);
include (TEMPLATEPATH . '/styles/blog/header.php' ); 
while (have_posts()) : the_post(); 
include (TEMPLATEPATH . '/styles/blog/content.php' ); 
if($loop_index==4){
	include (TEMPLATEPATH . '/styles/blog/content_google_blog.php' ); 
}
$loop_index++;
endwhile;


include (TEMPLATEPATH . '/styles/blog/footer.php' );

}


public function getContests(){

global $loop_index;
$loop_index=1;
rewind_posts();
$post_number=6;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


$values = array();
$meta_quer[relation]='AND';
parse_str($_COOKIE['poertclass'], $values);
if ((($_COOKIE['poertclass'])!='frequency=Please+Select&brand_post=no_brand')&&
((array_key_exists('poertclass', $_COOKIE))))    
    {
foreach ($values as $k=>$v){
    if ($v==1)$k = array('key' => 'entry-type','value' => $k,'compare' => 'LIKE') ;
if (is_array($k)){$meta_quer[]=$k;}
   
}
if ($values[frequency] != 'Please Select'){
$meta_quer[]=array('key' => 'entry-frequency','value' => $values[frequency],'compare' => 'LIKE') ;

}
$meta_quer[] = array('key' => 'expired-date','value' => date("m/d/Y"),'compare' => '>=');
if ($values[brand_post] != 'no_brand'){
    $tax_query[] = array(
			'taxonomy' => 'topics',
			'field' => 'slug',
			'terms' => $values[brand_post]
		);
}


$args= array(
	'category_name' => 'Contests',
	'paged' => $paged,
	'posts_per_page' => $post_number,
        'meta_query' => $meta_quer,
      //  'tax_query' => $tax_query
    );
}else { 
    
$meta_quer[] = array('key' => 'expired-date','value' => date("m/d/Y"),'compare' => '>=');
    $args= array(
	'category_name' => 'Contests',
	'paged' => $paged,
	'posts_per_page' => $post_number,
         'meta_query' => $meta_quer,
    
    
    );
}

   $_COOKIE['poertclass']='frequency=Please+Select&brand_post=no_brand';

query_posts($args);
include (TEMPLATEPATH . '/styles/contests/header.php' ); 

while (have_posts()) : the_post(); 
include (TEMPLATEPATH . '/styles/contests/content.php' ); 
if($loop_index==1){
	include (TEMPLATEPATH . '/styles/contests/content_google.php' ); 
	// include (TEMPLATEPATH . '/styles/contests/content_nogoogle.php' ); 
      //   include (TEMPLATEPATH . '/styles/contests/content_iframe.php' );
}
$loop_index++;

endwhile;


include (TEMPLATEPATH . '/styles/contests/footer.php' );


}



/**
*Generic function to get style of category by name
*Example set "Contests" for category name to get Contests style (folder contests should be
*created prioi
*/
public function getStyleByName($cat_name){

$the_query=new WP_Query( 'category_name='.$cat_name.', paged=TRUE' );	
$cat_folder=str_replace(" ", "-", trim(strtolower($cat_name)));
include (TEMPLATEPATH . '/styles/'.$cat_folder.'/header.php' ); 
while ($the_query->have_posts()) : $the_query->the_post(); 
include (TEMPLATEPATH . '/styles/'.$cat_folder.'/content.php' ); 
endwhile;


include (TEMPLATEPATH . '/styles/'.$cat_folder.'/footer.php' );
 
wp_reset_query();
wp_reset_postdata();
}

public function getExclusive(){
//

    $loop_index=0; 
global $wpdb;
	
$post_number=$num_post_to_display=5;
$today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args= array(
     'post__not_in' => $excludeposts,
	'paged' => $paged, 
	'posts_per_page' => $post_number,
    'meta_query' => array(
      	   array(
           'key' => 'is-exclusive',
           'value' => 'is-exclusive',
           'compare' => 'LIKE',
       ),
   // array('key' => 'expired-date','value' => date("m/d/Y"),'compare' => '>=')
	)
);
$wp_query = new WP_Query($args);
$number_of_posts=$wp_query->found_posts;
include (TEMPLATEPATH . '/styles/exclusive/header.php' ); 
while ($wp_query->have_posts()) : $wp_query->the_post(); 
include (TEMPLATEPATH . '/styles/exclusive/content.php' ); 
if($loop_index==1){
	//include (TEMPLATEPATH . '/styles/free-samples/content_google_free_samples.php' ); 
}
$loop_index++;
endwhile;


include (TEMPLATEPATH . '/styles/exclusive/footer.php' );
    

 
wp_reset_query();
wp_reset_postdata();

}

public function getTopic($topic_name='grocery'){
wp_reset_query();
wp_reset_postdata();
$args = array( 'topic' => $topic_name , 'posts_per_page' => -1, 'paged' => $paged );
$the_query = new WP_Query($args);
while ($the_query->have_posts()) : $the_query->the_post(); 
?>
<h2><?php the_title();?></h2>
<?php 
endwhile;

}

public function getSubBrands($term){


$brand = $term->slug;
global $wpdb;
global $post; 
$num_post_to_display=4;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	   $today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );
$args=array('paged' => $paged, 
            'post__not_in' => $excludeposts,
            'posts_per_page' => $num_post_to_display,
            'tax_query' => array(
		array(
			'taxonomy' => 'brands',
			'field' => 'slug',
			'terms' => $brand
		)
	),
    'meta_query' =>   array('relation'=>'AND',
                      array('key' => 'visibility','value' => 'firstnotdisplay','compare' => 'NOT LIKE')
                      ), 
    
);
global $counter; 
$counter=0;
$brandsquery = new WP_Query($args); 

$total_search=$brandsquery->post_count;


include (TEMPLATEPATH . '/styles/subbrands/header.php' );


while ($brandsquery->have_posts()) : $brandsquery->the_post(); 
include (TEMPLATEPATH . '/styles/subbrands/content.php' );

endwhile;

include (TEMPLATEPATH . '/styles/subbrands/footer.php' );
}

public function getSubTaxonomy($term, $taxonomy){
wp_reset_query();
wp_reset_postdata();

global $term, $the_query, $wpdb;;
 $today=date('Y, d m');
	   $excludeposts = $wpdb->get_col( "SELECT  DISTINCT `post_id` 
                FROM `free_ca_postmeta`
                WHERE `meta_key` = 'expired-date'
                AND STR_TO_DATE( `meta_value` , '%m/%d/%Y' ) < STR_TO_DATE( '".$today."', '%Y, %d %m' ) ORDER BY post_id DESC
                LIMIT 1000" );

$args = array( 'post__not_in' => $excludeposts, $taxonomy => $term->slug , 'posts_per_page' => -1, 'paged' => $paged );
$the_query = new WP_Query($args);

$total_search=$the_query->post_count;

include (TEMPLATEPATH . '/styles/listings/subs/header.php' );
include (TEMPLATEPATH . '/styles/search/header.php' );


while ($the_query->have_posts()) : $the_query->the_post();
    global $post;
    $key_1_values = '';
    $key_1_values = get_post_meta($post->ID, 'desktop', true);
    if($key_1_values != 'not_display')
        include (TEMPLATEPATH . '/styles/search/content.php' );
endwhile;
include (TEMPLATEPATH . '/styles/listings/subs/footer.php' );
}

public function getBrands($brand_name=NULL){
if ( get_query_var( 'paged' ) )
	$paged = get_query_var('paged');
else if ( get_query_var( 'page' ) )
	$paged = get_query_var( 'page' );
else
$paged = 1;
$per_page    = '';
$number_of_brands = count( get_terms( 'brands' ) );
$offset= $per_page * ( $paged - 1) ;
	
$args = array( 'hide_empty' => true, 'orderby' => 'name',   'parent '=> 0,'offset'  => $offset, 'number'=>$per_page);
$brands_subcats = get_terms('brands', $args);

global $brands, $brands_arr, $brand_key, $items;
$brands_arr = array();
$items = array();
include (TEMPLATEPATH . '/styles/brands/header.php' ); 
foreach($brands_subcats as $brand){
$brands=$brand;

$brands_arr[] .= $brand->slug;
 //print_r($brands_arr);
//include (TEMPLATEPATH . '/top_banners/top_header_v2.php');
//include (TEMPLATEPATH . '/styles/brands/content.php' ); 	
}

$this->sorting( $brands_arr );
    
    # Выводим
    foreach( $brands_arr as $brand_key=>$items )
    {
        //print_r ($items);
        if (!is_numeric($brand_key)){
        include (TEMPLATEPATH . '/styles/brands/content.php' ); 
        }
        # Выводим букву раздела
        //echo mb_strtoupper( $brand_key, 'utf-8' ) . "<br>";
        
        # Выводим значения
        foreach( $items as $value )
        {
        //    echo $value . "<br>";
        }
    }


include (TEMPLATEPATH . '/styles/brands/footer.php' ); 


//echo "<pre>".print_r($brands_arr, TRUE)."<pre>";
}

public function sorting( & $array )
    {
        $memory = NULL;
        $sorting = array();
        
        foreach( $array as $item )
        {
            
            $letter = mb_substr( $item, 0, 1, 'utf-8' );
            if( $letter != $memory )
            {
                $memory = $letter;
                
                $sorting[$memory] = array();
            }
            $sorting[$memory][] = $item;
        }
        
        $array = $sorting;
    }

public function getTopics($brand_name=NULL){

$args = array( 'hide_empty' => '1', 'orderby' => 'name');
$subcats = get_terms('topics', $args);

global $topics;

include (TEMPLATEPATH . '/styles/topics/header.php' ); 

foreach($subcats as $sub){
$topics=$sub;


include (TEMPLATEPATH . '/styles/topics/content.php' ); 	
}
include (TEMPLATEPATH . '/styles/topics/footer.php' ); 


//echo "<pre>".print_r($subcats, TRUE)."<pre>";
}


public function getBrandImage($brand_id){
$imgsrc= $this->get_term_meta($brand_id, 'brand-default-image', true);
if(empty($imgsrc)){
	$imgsrc="http://c454621.r21.cf2.rackcdn.com/diff/free.ca/brands.png";
}
return $imgsrc;
}

public function getBrandTerms($brand_id, $term_name){
return $this->get_term_meta($brand_id, $term_name, true);
}


public function getTopicIcon($term_id, $vector=FALSE){
    if ($vector){
        return preg_replace("#^http://c454621.r21.cf2.rackcdn.com/free.ca/Icons[/]?#", "http://storage.googleapis.com/cdn-free-ca/icons/130/", $this->get_term_meta($term_id, 'topic-default-icon', true));
    }else{
        return preg_replace("#^http://c454621.r21.cf2.rackcdn.com/free.ca/Icons[/]?#", "http://storage.googleapis.com/cdn-free-ca/icons/", $this->get_term_meta($term_id, 'topic-default-icon', true));
    }
}
public function getTopicTitle($term_id){
return $this->get_term_meta($term_id, 'topic-default-title', true);
}
public function getBrandTitle($brand_id){
return $this->get_term_meta($brand_id, 'brand-default-title', true);
}

public function getTermLink($name, $subname){
	$cat_name=$this->revertSlugToName($name);
	$base=$this->nav->getLink($cat_name, 'page');
	$sub=$this->getSubTerm($name, $subname);
	$url=$base.$sub->slug;
	return $url;
	
	
}
public function revertSlugToName($slug){
	$name= ucwords(str_replace("-", " ", trim($slug)));
	return $name;
}
function getBackToTop($cat_name){?>



<div class="clear"></div>

<?php
}

public function getSubTerm($name, $subname, $hide_emty=0){
$args = array( 'hide_empty' => $hide_emty, 'orderby' => 'name');
$subcats = get_terms($name, $args);
foreach($subcats as $sub){
if( $sub->name==$subname){
	return $sub;
}
}

}



public function getSEOData($meta_name,$id=NULL){
	
		return 'Needs to be done for description as well.';
	
}

	



public function is_brand(){
	
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' )); 
if($term->taxonomy=='brands'){
	return TRUE;
}
else{
	return FALSE;
}

}
public function is_topics(){
	
$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' )); 
if($term->taxonomy=='topics'){
	return TRUE;
}
else{
	return FALSE;
}

}


}

?>