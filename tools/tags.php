<?php function tag_metabox_add($tag) { ?>
	
    <div class="form-field">
		<label for="after_post_tag-image-url"><?php _e('Social Media HTML Code after the Post') ?></label>
		<textarea name="after_post_tag-image-url" id="after_post_tag-image-url"  aria-required="true"  cols="40" rows="5"></textarea>
		<p class="description"><?php _e('This code will be  shown on single post page after the post.'); ?></p>
	</div>
<?php } 	
 
function tag_metabox_edit($tag) { ?>
	
    <tr class="form-field">
		<th scope="row" valign="top">
			<label for="after_post_tag-image-url"><?php _e('Social Media HTML Code after the Post') ?></label>
		</th>
		<td>
			
		<textarea name="after_post_tag-image-url"  cols="40" rows="7"><?php echo get_term_meta($tag->term_id, 'after_post_tag-image-url', true); ?></textarea>
		<p class="description"><?php _e('This code will be  shown on single post page after the post.'); ?></p>
		</td>
	</tr>
    
    
<?php }

add_action('post_tag_add_form_fields', 'tag_metabox_add', 10, 1);
add_action('post_tag_edit_form_fields', 'tag_metabox_edit', 10, 1);	 
add_action('created_post_tag', 'save_category_metadata', 10, 1);	
add_action('edited_post_tag', 'save_category_metadata', 10, 1);

function wf_display_social_banner(){
global $post;
$term_list = wp_get_post_terms($post->ID, 'post_tag', array("fields" => "all"));
$counter=0;
foreach ($term_list as $tag):
if($counter<1):
$tag_id=$tag->term_id;
$media_code=get_term_meta($tag_id, 'after_post_tag-image-url', true); 
if(!empty($media_code)){
?>
<div style="margin:15px 0">
<?php echo stripslashes(stripslashes($media_code));?>
 </div>
<?php 
$counter++;
}
endif;
endforeach;
}
?>