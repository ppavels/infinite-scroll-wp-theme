<?php 
/*******************************
  THEME OPTIONS PAGE
********************************/
add_action('admin_menu', 'this_theme_page');
function this_theme_page ()
{
	if ( count($_POST) > 0 && isset($_POST['adjump_settings']) )
	{
		$options = array ('contest_image', 'contest_image_gold', 'testmode','contest_link', 'button_link', 'button_title', 'local_deals','twitter_link','facebook_link','rss_link','keywords','description','analytics','ofsanalytics','copyright','advertise_email','signup_link', 'privacy_link','pinterest_link','youtube_link','google_plus_link','google_site_verification', 'sidebar_iframe1', 'home_iframe', 'custom_post', 'custom_rand', 'contact_email', 'facebook_thumb');
		foreach ( $options as $opt )
		{
			delete_option ( 'adjump_'.$opt, $_POST[$opt] );
			add_option ( 'adjump_'.$opt, $_POST[$opt] );	
		}			
	}
	add_menu_page(__('Theme Settings'), __('Theme Settings'), 'edit_themes', basename(__FILE__), 'theme_settings');
	add_submenu_page(__('Theme Settings'), __('Theme Settings'), 'edit_themes', basename(__FILE__), 'theme_settings');
}
function theme_settings()
{?>
<div class="wrap">
	<h2>Theme Settings Panel</h2>
<form method="post" action="">

        <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>Contests Settings</strong></legend>
	<table class="form-table">
		
		<tr valign="top">
			<th scope="row"><label for="style">Random Number</label></th>
			<td>
<input name="custom_rand" type="text" id="custom_rand" value="<?php echo get_option('adjump_custom_rand'); ?>" class="regular-text"  style="width:50px"/> 
			</td>
		</tr>
        
        
        	
        <tr valign="top">
			<th scope="row"><label for="style">Random Post Number</label></th>
			<td>
<input name="custom_post" type="text" id="custom_post" value="<?php echo get_option('adjump_custom_post'); ?>" class="regular-text"  style="width:50px"/> 
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="contest_image">Contests Link</label></th>
			<td>
<input name="contest_link" type="text" id="contest_link" value="<?php echo get_option('adjump_contest_link'); ?>" class="regular-text"  /> 
			</td>
		</tr>
             <tr valign="top">
			<th scope="row"><label for="contest_image">Link to Image</label></th>
			<td>
<input name="contest_image" type="text" id="contest_image" value="<?php echo get_option('adjump_contest_image'); ?>" class="regular-text"  /> 
			</td>
		</tr>
           <tr valign="top">
			<th scope="row"><label for="contest_image_gold">Link to Gold Image</label></th>
			<td>
<input name="contest_image_gold" type="text" id="contest_image_gold" value="<?php echo get_option('adjump_contest_image_gold'); ?>" class="regular-text"  /> 
			</td>
		</tr>

<tr valign="top">
			<th scope="row"><label for="testmode">Test Mode</label></th>
			<td>
				<select name="testmode" id="testmode">	
					<option value="no" <?php if(get_option('adjump_testmode') == 'no'){?>selected="selected"<?php } ?>>No</option>	
                    <option value="yes" <?php if(get_option('adjump_testmode') == 'yes'){?>selected="selected"<?php } ?>>Yes</option>	
					
				</select> 
                <br/>
                <em>test post: http://womanfreebies.com/general-freebies/johnsonville-coupon-2/</em>
			</td>
		</tr>
        
		
	</table>
	</fieldset>
	
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="adjump_settings" value="save" style="display:none;" />
		</p>

	
	<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Social Links</strong></legend>
		<table class="form-table">
             <tr valign="top">
			<th scope="row"><label for="facebook_link">Facebook link</label></th>
			<td>
				<input name="facebook_link" type="text" id="facebook_link" value="<?php echo get_option('adjump_facebook_link'); ?>" class="regular-text" />
			</td>
		</tr>
        
                  <!-- FB THUMB -->
            <tr valign="top">
			<th scope="row"><label for="facebook_link">Facebook Thumbnail</label></th>
			<td>
				<input name="facebook_thumb" type="text" id="facebook_thumb" value="<?php echo get_option('adjump_facebook_thumb'); ?>" class="regular-text" />
                <br/>
                <em>at least 50x50, best 90x90</em>
			</td>
            
		</tr>
        <?php if (get_option('adjump_facebook_thumb')!=""){?> 
            <tr valign="top">
			<th scope="row"><img src="<?php echo get_option('adjump_facebook_thumb'); ?>" alt="Facebook Thumbnail"/></th>
			<td>
				
			</td>
            	
		</tr>
         <?php } ?>
         
         <!-- FB THUMB -->
        
		<tr valign="top">
			<th scope="row"><label for="twitter_link">Twitter Link</label></th>
			<td>
				<input name="twitter_link" type="text" id="twitter_user" value="<?php echo get_option('adjump_twitter_link'); ?>" class="regular-text" />
			</td>
		</tr>
   
            <tr valign="top">
			<th scope="row"><label for="facebook_link">Pinterest</label></th>
			<td>
				<input name="pinterest_link" type="text" id="pinterest_link" value="<?php echo get_option('adjump_pinterest_link'); ?>" class="regular-text" />
			</td>
		</tr>
             <tr valign="top">
			<th scope="row"><label for="youtube_link">Youtube</label></th>
			<td>
				<input name="youtube_link" type="text" id="youtube_link" value="<?php echo get_option('adjump_youtube_link'); ?>" class="regular-text" />
			</td>
		</tr>
        
        <tr valign="top">
			<th scope="row"><label for="google_plus_link">Google +1</label></th>
			<td>
				<input name="google_plus_link" type="text" id="youtube_link" value="<?php echo get_option('adjump_google_plus_link'); ?>" class="regular-text" />
			</td>
		</tr>
             <tr valign="top">
			<th scope="row"><label for="advertise_email">Advertise Email</label></th>
			<td>
				<input name="advertise_email" type="text" id="advertise_email" value="<?php echo get_option('adjump_advertise_email'); ?>" class="regular-text" />
			</td>
		</tr>
        <tr valign="top">
			<th scope="row"><label for="contact_email">Contact Email</label></th>
			<td>
				<input name="contact_email" type="text" id="contact_email" value="<?php echo get_option('adjump_contact_email'); ?>" class="regular-text" />
			</td>
		</tr>
           <tr valign="top">
			<th scope="row"><label for="facebook_link">Sign Up Link</label></th>
			<td>
				<input name="signup_link" type="text" id="signup_link" value="<?php echo get_option('adjump_signup_link'); ?>" class="regular-text" />
			</td>
		</tr>
             <tr valign="top">
			<th scope="row"><label for="facebook_link">Privacy Link</label></th>
			<td>
				<input name="privacy_link" type="text" id="privacy_link" value="<?php echo get_option('adjump_privacy_link'); ?>" class="regular-text" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="rss_link">RSS link<br/>(if empty will use default rss)</label></th>
			<td>
				<input name="rss_link" type="text" id="rss_link" value="<?php echo get_option('adjump_rss_link'); ?>" class="regular-text" />
			</td>
		</tr>
        </table>
        </fieldset>
		<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="adjump_settings" value="save" style="display:none;" />
		</p>
		
		
	
    <?php /*this part for sidebar iframe start*/ ?>	
	
    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Iframe Banners</strong></legend>
		<table class="form-table">	
        <tr>
        	<td colspan="2"></td>
        </tr>
         <tr valign="top">
			<th scope="row"><label for="sidebar_iframe1">Sidebar Iframe #1</label></th>
			<td>
					<textarea name="sidebar_iframe1" id="sidebar_iframe1" rows="4" cols="70" style="font-size:11px;"><?php echo stripslashes(get_option('adjump_sidebar_iframe1')); ?></textarea><br />
				<em>HTML code to display iframe on the index page in the sidebar.</em>
			</td>
		</tr>
        
         <tr valign="top">
			<th scope="row"><label for="home_iframe">Home page Iframe</label></th>
			<td>
					<textarea name="home_iframe" id="home_iframe" rows="4" cols="70" style="font-size:11px;"><?php echo stripslashes(get_option('adjump_home_iframe')); ?></textarea><br />
				<em>HTML code to display iframe on the index page above the title.</em>
			</td>
		</tr>
        
        </table>
     </fieldset>
     <?php /*this part for sidebar iframe end */ ?>	
	 <p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="adjump_settings" value="save" style="display:none;" />
	</p>

    
	<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Footer</strong></legend>
		<table class="form-table">
		
		<tr>
			<th colspan="2"><strong>Copyright Info</strong></th>
		</tr>
        <tr>
			<th><label for="copyright">Copyright Text</label></th>
			<td>
				<textarea name="copyright" id="copyright" rows="4" cols="70" style="font-size:11px;"><?php echo stripslashes(get_option('adjump_copyright')); ?></textarea><br />
				<em>You can use HTML for links etc.</em>
			</td>
		</tr>
		
		
	</table>
	</fieldset>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="adjump_settings" value="save" style="display:none;" />
	</p>
        
      <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Meta Tags and SEO</strong></legend>
		<table class="form-table">
        <tr>
			<th><label for="keywords">Meta Keywords</label></th>
			<td>
				<textarea name="keywords" id="keywords" rows="7" cols="70" style="font-size:11px;"><?php echo get_option('adjump_keywords'); ?></textarea><br />
<!--google-site-verification
-->
                <em>Keywords comma separated</em>
			</td>
		</tr>
       
        <tr>
			<th><label for="description">Meta Description</label></th>
			<td>
				<textarea name="description" id="meta-desc" rows="7" cols="70" style="font-size:11px;"><?php echo get_option('adjump_description'); ?></textarea>
			</td>
		</tr>
        <tr><td></td><td><p class="description countdown title"></p></td></tr>
         <tr>
			<th><label for="keywords">Google Site Verification</label></th>
			<td>
					<input name="google_site_verification" type="text" id="google_site_verification" value="<?php echo get_option('adjump_google_site_verification'); ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th><label for="ads">Google Analytics code (header):</label></th>
			<td>
				<textarea name="analytics" id="analytics" rows="7" cols="70" style="font-size:11px;"><?php echo stripslashes(get_option('adjump_analytics')); ?></textarea>
			</td>
		</tr>
        
        		<tr>
			<th><label for="ads">Other Analytics code (footer):</label></th>
			<td>
				<textarea name="ofsanalytics" id="ofsanalytics" rows="7" cols="70" style="font-size:11px;"><?php echo stripslashes(get_option('adjump_ofsanalytics')); ?></textarea>
			</td>
		</tr>
		
	</table>
	</fieldset>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="adjump_settings" value="save" style="display:none;" />
	</p>
</form>
</div>
<?php } ?>