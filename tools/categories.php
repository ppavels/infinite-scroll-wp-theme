<?php 



function wf_get_random_category($arr, $in_sidebar=false){
	$min=0;
	$have_img=array();
	
	
	foreach ($arr as $r_img){
	if(!$in_sidebar){	
	$ads=get_term_meta($r_img->cat_ID, 'image-url', true);
	}
	else{
	$ads=get_term_meta($r_img->cat_ID, 'sidebar-image-url', true);
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

function redirect_old_categories(){

$redirect_contests_link=preg_replace("#^/category/contests[/]?#", "/category/sweepstakes/", $_SERVER['REQUEST_URI']);
$redirect_samples_link=preg_replace("#^/category/samples-and-trials[/]?#", "/category/free-samples/", $_SERVER['REQUEST_URI']);
$redirect_coupons_link=preg_replace("#^/category/coupons-and-discounts[/]?#", "/category/coupons-and-savings/", $_SERVER['REQUEST_URI']);
if (preg_match ("#^/category/contests#", $_SERVER['REQUEST_URI'])){wp_redirect(home_url().$redirect_contests_link ); exit; }
else if (preg_match ("#^/category/samples-and-trials#", $_SERVER['REQUEST_URI'])){wp_redirect(home_url().$redirect_samples_link ); exit; }
else if (preg_match ("#^/category/coupons-and-discounts#", $_SERVER['REQUEST_URI'])){wp_redirect(home_url().$redirect_coupons_link ); exit; }
//coupons-and-savings
}

//end  post meta box
function get_category_id_by_name($cat_name){
	$term = get_term_by('name', $cat_name, 'category');
	return $term->term_id;
}

//custom category fields
function simple_term_meta_install()
{
	// setup custom table
	
	global $wpdb;
	$wpdb->termmeta = $wpdb->prefix . 'termmeta';	
	$table_name = $wpdb->prefix . 'termmeta';
	
	
        //the original function was without this return
	return $wpdb->termmeta = $wpdb->prefix . 'termmeta';
	
	
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
		  meta_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		  term_id bigint(20) unsigned NOT NULL DEFAULT '0',
		  meta_key varchar(255) DEFAULT NULL,
		  meta_value longtext,
		  PRIMARY KEY (meta_id),
		  KEY term_id (term_id),
		  KEY meta_key (meta_key)	  
		);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		
		
	
}
add_action( 'init', 'simple_term_meta_install' );

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
		update_termmeta_cache($term_id);
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
	$custom = get_term_custom( $term_id );
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
	$custom = get_term_custom($term_id);
	return isset($custom[$key]) ? $custom[$key] : null;
} 


//befoer that copied

 //this is code to add custom fields to category
 
function category_metabox_add($tag) { ?>
	<div class="form-field">
		<label for="subcat-nice-name"><?php _e('Category Nicename') ?></label>
		<input name="subcat-nice-name" id="subcat-nice-name" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('This name will be shown on the category page in the title of subcategory.'); ?></p>
	</div>
    	<div class="form-field">
		<label for="cat-meta-description"><?php _e('Metatag DESCRIPTION') ?></label>
		<input name="cat-meta-description" id="cat-meta-description" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('This content will be shown in Meta Tag "Description" on the category page.'); ?></p>
	</div>
    	<div class="form-field">
		<label for="cat-meta-keywords"><?php _e('Metatag KEYWORDS') ?></label>
		<input name="cat-meta-keywords" id="cat-meta-keywords" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('This content will be shown in Meta Tag "Keywords" on the category page.'); ?></p>
	</div>
    	<div class="form-field">
		<label for="cat-meta-title"><?php _e('Metatag TITLE') ?></label>
		<input name="cat-meta-title" id="cat-meta-title" type="text" value="" size="40" aria-required="true" />
		<p class="description"><?php _e('This content will be shown in Meta Tag "Title" on the category page.'); ?></p>
	</div>
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
 
function category_metabox_edit($tag) { ?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="subcat-nice-name"><?php _e('Category Nicename'); ?></label>
		</th>
		<td>
			<input name="subcat-nice-name" id="subcat-nice-name" type="text" value="<?php echo get_term_meta($tag->term_id, 'subcat-nice-name', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('This name will be shown on the category page in the title of subcategory.'); ?></p>
		</td>
	</tr>
    
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat-meta-description"><?php _e('Metatag DESCRIPTION'); ?></label>
		</th>
		<td>
			<input name="cat-meta-description" id="cat-meta-description" type="text" value="<?php echo get_term_meta($tag->term_id, 'cat-meta-description', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('This content will be shown in Meta Tag "Description" on the category page.'); ?></p>
		</td>
	</tr>
    
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat-meta-keywords"><?php _e('Metatag KEYWORDS'); ?></label>
		</th>
		<td>
			<input name="cat-meta-keywords" id="cat-meta-keywords" type="text" value="<?php echo get_term_meta($tag->term_id, 'cat-meta-keywords', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('This content will be shown in Meta Tag "Keywords" on the category page.'); ?></p>
		</td>
	</tr>
    
    	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="cat-meta-title"><?php _e('Metatag Title'); ?></label>
		</th>
		<td>
			<input name="cat-meta-title" id="cat-meta-title" type="text" value="<?php echo get_term_meta($tag->term_id, 'cat-meta-title', true); ?>" size="40" aria-required="true" />
			<p class="description"><?php _e('This content will be shown in Meta Tag "Title" on the category page.'); ?></p>
		</td>
	</tr>
    
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="image-url"><?php _e('Rotating Image HTML Code') ?></label>
		</th>
		<td>
			
		<textarea name="image-url"  cols="40" rows="7"><?php echo get_term_meta($tag->term_id, 'image-url', true); ?></textarea>
		<p class="description"><?php _e('This image will be the ads shown on category page and single post page, related to this category above the title of the post.'); ?></p>
		</td>
	</tr>
        <tr class="form-field">
		<th scope="row" valign="top">
			<label for="sidebar-image-url"><?php _e('Rotating Image HTML Code in Sidebar') ?></label>
		</th>
		<td>
			
		<textarea name="sidebar-image-url"  cols="40" rows="7"><?php echo get_term_meta($tag->term_id, 'sidebar-image-url', true); ?></textarea>
		<p class="description"><?php _e('This image will be the ads shown on category page and single post in the sidebar.'); ?></p>
		</td>
	</tr>
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="sidebar-image-url"><?php _e('Social Media HTML Code after the Post') ?></label>
		</th>
		<td>
			
		<textarea name="afterpost-image-url"  cols="40" rows="7"><?php echo get_term_meta($tag->term_id, 'afterpost-image-url', true); ?></textarea>
		<p class="description"><?php _e('This code will be  shown on single post page after the post.'); ?></p>
		</td>
	</tr>
    
    
<?php } ?>

<?php 

add_action('category_add_form_fields', 'category_metabox_add', 10, 1);
add_action('category_edit_form_fields', 'category_metabox_edit', 10, 1);	 
add_action('created_category', 'save_category_metadata', 10, 1);	
add_action('edited_category', 'save_category_metadata', 10, 1);
 
function save_category_metadata($term_id){
if (isset($_POST['subcat-nice-name'])) {
		update_term_meta( $term_id, 'subcat-nice-name', $_POST['subcat-nice-name']);         			
}
if (isset($_POST['cat-meta-keywords'])) {
		update_term_meta( $term_id, 'cat-meta-keywords', $_POST['cat-meta-keywords']);         			
}
if (isset($_POST['cat-meta-description'])) {
		update_term_meta( $term_id, 'cat-meta-description', $_POST['cat-meta-description']);         			
}
if (isset($_POST['cat-meta-title'])) {
		update_term_meta( $term_id, 'cat-meta-title', $_POST['cat-meta-title']);         			
}
if (isset($_POST['image-url'])) {
		update_term_meta( $term_id, 'image-url', $_POST['image-url']);         			
}
if (isset($_POST['sidebar-image-url'])) {
		update_term_meta( $term_id, 'sidebar-image-url', $_POST['sidebar-image-url']);         			
}
if (isset($_POST['afterpost-image-url'])) {
		update_term_meta( $term_id, 'afterpost-image-url', $_POST['afterpost-image-url']);         			
}
if (isset($_POST['after_post_tag-image-url'])) {
		update_term_meta( $term_id, 'after_post_tag-image-url', $_POST['after_post_tag-image-url']);         			
}
}




?>