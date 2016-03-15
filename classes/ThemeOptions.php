<?php
class ThemeOptions{
    
function __construct($args = array()){
    add_action('admin_menu', array($this, 'this_theme_page'));
    add_action('init',array($this,'load_theme_scripts'));
} 
    
function this_theme_page ()
{   //theme_ads_options
	if ( count($_POST) > 0 && isset($_POST['theme_settings']) )
	{
		
	foreach ($_POST as $val=>$name){
	$theme_settings[$val] = $_POST[$val];
	}	
	update_option('theme_settings', $theme_settings);		
	}
	
	//google_ads_options
	if ( count($_POST) > 0 && isset($_POST['adsense_settings']) ) 
	{ 
	 foreach ($_POST as $val=>$name){
		$goptions[$val] = $_POST[$val];
	}
	//echo "<pre>".print_r($goptions,1)."</pre>"; 
		update_option('google_ads_options', $goptions);
	}
	if ( count($_POST) > 0 && isset($_POST['background_settings']) ) 
	{  
	
	 foreach ($_POST as $val=>$name){
		$boptions[$val] = $_POST[$val];
	}
	//echo "<pre>".print_r($goptions,1)."</pre>"; 
		update_option('background_options', $boptions);
	}
	//
	
	//background_settings
	
	if ( count($_POST) > 0 && isset($_POST['contest_settings']) ) 
	{
		$options = array ('contest_image', 'contest_image_gold','contest_image_mobile', 'contest_image_gold_mobile', 'testmode','contest_link','custom_post', 'custom_rand', 'ip_block');
		foreach ( $options as $opt )
		{
			delete_option ( 'adjump_'.$opt, $_POST[$opt] );
			add_option ( 'adjump_'.$opt, $_POST[$opt] );
			if($opt=="ip_block"){
				//nl2br(trim($_POST[$opt]))
				edit_content_htaccess($_POST[$opt]);
			}
		}
	}
	
	
	if ( count($_POST) > 0 && isset($_POST['socialstats']) ) 
	{
		
			save_social_stats($_POST);
		
			
                        
	}
        
	
	
	add_menu_page(__('Theme Settings'), __('Theme Settings'), 'edit_themes', basename(__FILE__), array($this,'theme_settings'));
	//add_submenu_page(__('Theme Settings'), __('Theme Settings'), 'edit_themes', basename(__FILE__), 'theme_settings');
	//add_submenu_page( 'theme_options.php', 'Easter Egg Settings', 'Easter Egg Settings', 'manage_options', 'easter-egg-contest', 'theme_easter_egg_sub' );
	
	add_submenu_page( 'ThemeOptions.php', 'Google Ads', 'Google Ads', 'manage_options', 'google-ads', array($this,'theme_google_ads_sub' ));
	//add_submenu_page( 'ThemeOptions.php', 'Other Ads', 'Other Ads', 'manage_options', 'paid-background', array($this,'theme_paid_background' ));
	
//add_submenu_page( 'ThemeOptions.php', 'Social Stats', 'Social Stats', 'publish_posts', 'social-stats', array($this,'theme_social_stats_ads_sub' ));
}    
    
 function theme_easter_egg_sub(){
	$htaccess=get_content_htaccess();
	?>
	<div class="wrap">
    <h2>Easter Egg Contest Settings</h2>
    <form method="post" action="">
<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>Contest Settings</strong></legend>
<table class="form-table">
<tr valign="top">
<th scope="row"><label for="custom_rand">Random Number</label></th>
<td>
<input name="custom_rand" type="text" id="custom_rand" value="<?php echo get_option('adjump_custom_rand'); ?>" class="regular-text"  style="width:50px"/> 
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="custom_post">Random Post Number</label></th>
<td>
<input name="custom_post" type="text" id="custom_post" value="<?php echo get_option('adjump_custom_post'); ?>" class="regular-text"  style="width:50px"/> 
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="contest_link">Contest Link</label></th>
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
<th scope="row"><label for="contest_image_gold">Link to Second Image </label></th>
<td>
<input name="contest_image_gold" type="text" id="contest_image_gold" value="<?php echo get_option('adjump_contest_image_gold'); ?>" class="regular-text"  /> 
<br/>
<em>(if any e.g gold)</em>
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="contest_image_mobile">Link to Mobile Image</label></th>
<td>
<input name="contest_image_mobile" type="text" id="contest_image_mobile" value="<?php echo get_option('adjump_contest_image_mobile'); ?>" class="regular-text"  /> 
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="contest_image_gold_mobile">Link to Mobile  Second Image </label></th>
<td>
<input name="contest_image_gold_mobile" type="text" id="contest_image_gold_mobile" value="<?php echo get_option('adjump_contest_image_gold_mobile'); ?>" class="regular-text"  /> 
<br/>
<em>(if any e.g gold)</em>
</td>
</tr>
<tr>
<th><label for="ip_block">Block IPs: <em>(one, per line)</em></label></th>
<td>
<textarea name="ip_block" id="ip_block" rows="7" cols="70" style="font-size:11px;"><?php echo $htaccess; ?></textarea>
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
<input type="hidden" name="contest_settings" value="save" style="display:none;" />
</p>
</form>
    </div>
<?php }


function theme_settings()
{?>
<div class="wrap">
<h2>Theme Settings Panel</h2>
<form method="post" action="">
<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Slider</strong></legend>
    
    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="slider_code">Slider HTML code</label></th>
			<td>
				<textarea name="slider_code" rows="4" cols="70" style="font-size:11px;" id="slider_code"  class="regular-text" ><?php  echo stripslashes($this->get_theme_settings('slider_code'));  ?></textarea>
			</td>
		</tr>
        
       
	</table>
        </fieldset>
		<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="theme_settings" value="save" style="display:none;" />
		</p> 
                
          
                
                
<!-- ---------------------------------------------------------------------------  -->
                
<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Social Media Accounts</strong></legend>
    
    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="facebook">Facebook</label></th>
			<td>
                        <input size="40" style="width: 375px;" name="facebook" type="text" id="facebook" value="<?php echo stripslashes($this->get_theme_settings('facebook'));?>" class="regular-text"  style="width:50px"/> 
                        </td>
		</tr>
        <tr valign="top">
			<th scope="row"><label for="twitter">Twitter</label></th>
			<td>
                        <input size="40" style="width: 375px;" name="twitter" type="text" id="twitter" value="<?php echo stripslashes($this->get_theme_settings('twitter'));?>" class="regular-text"  style="width:50px"/> 
</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="pinterest">Pinterest</label></th>
			<td>
                                                        <input size="40" style="width: 375px;" name="pinterest" type="text" id="pinterest" value="<?php echo stripslashes($this->get_theme_settings('pinterest'));?>" class="regular-text"  style="width:50px"/> 

			</td>
		</tr>
                 <tr valign="top">
			<th scope="row"><label for="google">Google+</label></th>
			<td>
                                                        <input size="40" style="width: 375px;" name="google" type="text" id="google" value="<?php echo stripslashes($this->get_theme_settings('google'));?>" class="regular-text"  style="width:50px"/> 

			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="email">Email</label></th>
			<td>
                                                        <input size="40" style="width: 375px;" name="email" type="text" id="email" value="<?php echo stripslashes($this->get_theme_settings('email'));?>" class="regular-text"  style="width:50px"/> 

			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="faq">FAQ</label></th>
			<td>
                                                        <input size="40" style="width: 375px;" name="faq" type="text" id="faq" value="<?php echo stripslashes($this->get_theme_settings('faq'));?>" class="regular-text"  style="width:50px"/> 

			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="terms">Terms and Conditions</label></th>
			<td>
                                                        <input size="40" style="width: 375px;" name="terms" type="text" id="email" value="<?php echo stripslashes($this->get_theme_settings('terms'));?>" class="regular-text"  style="width:50px"/> 

			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="privacy">Privacy Policy</label></th>
			<td>
                                                        <input size="40" style="width: 375px;" name="privacy" type="text" id="privacy" value="<?php echo stripslashes($this->get_theme_settings('privacy'));?>" class="regular-text"  style="width:50px"/> 

			</td>
		</tr>
       
	</table>
        </fieldset>
		<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="theme_settings" value="save" style="display:none;" />
		</p>                 
                
                
                
                
                
                
<!--     -------------------------------------------------           -->
                
      

<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>SEO</strong></legend>
    
    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="title">Title</label></th>
			<td>
                            <input size="40" style="width: 375px;" name="title" type="text" id="title" value="<?php echo stripslashes($this->get_theme_settings('title'));?>" class="regular-text"  style="width:50px"/> 
			</td>
		</tr>
                
                   <tr valign="top">
			<th scope="row"><label for="homepage_title">Homepage H1</label></th>
			<td>
                        <input size="40" style="width: 375px;" name="homepage_title" type="text" id="homepage_title" value="<?php echo stripslashes($this->get_theme_settings('homepage_title'));?>" class="regular-text"  style="width:50px"/> 
                        </td>
		</tr>
                
        <tr valign="top">
			<th scope="row"><label for="description">Description</label></th>
			<td>
				<textarea name="description" rows="4" cols="70" style="font-size:11px;" id="description"  class="regular-text" ><?php  echo stripslashes($this->get_theme_settings('description'));  ?></textarea>
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="verification">Google Site Verification</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="verification" type="text" id="verification" value="<?php echo stripslashes($this->get_theme_settings('verification'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                 <tr valign="top">
			<th scope="row"><label for="analitycs">Google Analitycs</label></th>
			<td>
				<textarea name="analitycs" rows="4" cols="70" style="font-size:11px;" id="analitycs"  class="regular-text" ><?php  echo stripslashes($this->get_theme_settings('analitycs'));  ?></textarea>
			</td>
		</tr>
       
	</table>
        </fieldset>
		<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="theme_settings" value="save" style="display:none;" />
		</p>   
                
                
<!-- ---------------------------------------------------------->



<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
<legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Custom Code</strong></legend>
    
    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="header">Header HTML</label></th>
			<td>
				<textarea name="header" rows="4" cols="170" style="font-size:11px;" id="header"  class="regular-text" ><?php  echo stripslashes($this->get_theme_settings('header'));  ?></textarea>
			</td>
		</tr>
        <tr valign="top">
			<th scope="row"><label for="footer">Footer HTML</label></th>
			<td>
				<textarea name="footer" rows="4" cols="170" style="font-size:11px;" id="footer"  class="regular-text" ><?php  echo stripslashes($this->get_theme_settings('footer'));  ?></textarea>
			</td>
		</tr>
                
       
	</table>
        </fieldset>
		<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="theme_settings" value="save" style="display:none;" />
		</p>   
                
                
                
                
<!------------------------------------------------------------->

	
  
</form>
</div>
<?php } 
function get_content_htaccess($raw=FALSE){
$file =ABSPATH.'/.htaccess';
$htaccess = file_get_contents($file);
if(preg_match('@#BEGIN\sIP\sBlocking\srules\s*([^#].*?)
#END\sIP\sBlocking\srules@msi',$htaccess,$mtch)){
$myarea=$mtch[1];
if($mtch[0]==''){
	//should add 
	//#BEGIN IP Blocking rules
	//#END IP Blocking rules
	$start_end_blocking='#BEGIN IP Blocking rules\n';
	$start_end_blocking.='#END IP Blocking rules';
	if(is_writable ($file)){
	file_put_contents($file, $start_end_blocking); 
	}
	else{
	//need to add that line as wordpress alert
	echo  $file.'is not wirtable. You have to chmod 777 for '.$file;
	
	}


	
}
else{
$ips=preg_replace('@deny\sfrom\s@msi', '', $myarea);
}
}
/*$pos = strpos($htaccess, $ip_address) - 11;
$newHtaccess = substr($htaccess, 0, $pos);
$pos += 11 + strlen($ip_address);
$newHtaccess .= substr($htaccess, $pos);
file_put_contents('.htaccess', $newHtaccess);*/
if(!$raw){
return $ips;
}
else{
return $myarea;
}
}    
 function edit_content_htaccess($ips){
	$file =ABSPATH.'/.htaccess';
	$iplines=preg_replace('@(\d+\.\d+\.\d+\.(\d+)?)@msi', 'DENY FROM $1', $ips);
	$htaccess = file_get_contents($file);
	$str_to_replace=get_content_htaccess(TRUE);
	
	$newHtaccess=str_replace($str_to_replace, $iplines, $htaccess);

	//echo nl2br(trim($newHtaccess));
	if(is_writable ($file)){
	file_put_contents($file, $newHtaccess);
	}
	else{
	//need to add that line as wordpress alert
	echo  $file.'is not wirtable. You have to chmod 777 for '.$file;

	}
}
function theme_paid_background(){ ?>
<div class="wrap">
    <h2>Other Ads</h2>
<form method="post" action="">
<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>Personal Addsense Code</strong></legend>
<table class="form-table">

        <tr valign="top">
			<th scope="row"><label for="paid_link">Code:</label></th>
			<td>
		<textarea name="bg_pixel" id="bg_pixel" rows="4" cols="80" style="font-size:11px;"><?php echo stripslashes( $this->get_paid_background('bg_pixel')); ?></textarea>


			</td>
		</tr>

        </table>
        </fieldset>
        <p class="submit">
<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
<input type="hidden" name="background_settings" value="save" style="display:none;" />
</p>

<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>2nd no-google</strong></legend>
 <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="index_loop_number">Number</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="index_loop_number" type="text" id="index_loop_number" value="<?php echo stripslashes($this->get_google_ads('index_loop_number'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="index_loop_slot">Slot</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="index_loop_slot" type="text" id="index_loop_slot" value="<?php echo stripslashes($this->get_google_ads('index_loop_slot'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="index_loop_slot">Size</label></th>
			<td>
                              <select name="name">
                                <option value="[300, 250]">[300, 250]</option>
                                <option value="[728, 90]">[728, 90]</option> 
                              </select>
			</td>
		</tr>
      <tr valign="top">
			<th scope="row"><label for="index_loop_channel">Channel</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="index_loop_channel" type="text" id="index_loop_channel" value="<?php echo stripslashes($this->get_google_ads('index_loop_channel'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
              
    </table>
        </fieldset>
        <p class="submit">
<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
<input type="hidden" name="background_settings" value="save" style="display:none;" />
</p>

        </form>
        </div>
<?php }
function theme_google_ads_sub(){
?>
<div class="wrap">
 <h2>Google Ads Settings</h2>
<form method="post" action="">
    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;margin-left: 15px; margin-right: 15px;">
    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Index</strong></legend>
 

    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="index_loop_number">Number</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="index_loop_number" type="text" id="index_loop_number" value="<?php echo stripslashes($this->get_google_ads('index_loop_number'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
                      
			<th scope="row"><label for="paid_link">Code:</label></th>
			<td >
		<textarea style="margin-bottom: -130px;margin-right: 100px;"
                    name="index_loop_code" id="index_loop_code" rows="7" cols="80" style="font-size:11px;"><?php echo stripslashes( $this->get_google_ads('index_loop_code')); ?></textarea>


			</td>
		
		</tr>
                
                <tr valign="top">
			<th scope="row"><label for="index_loop_slot">Slot</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="index_loop_slot" type="text" id="index_loop_slot" value="<?php echo stripslashes($this->get_google_ads('index_loop_slot'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="index_loop_size">Size</label></th>
			<td>
                                    <?php if ((($this->get_google_ads('index_loop_size'))== ('[300, 250]')))
                                    
                                        $selected300 = 'selected';
                                     else {$selected728 = 'selected'; } 
                                     ?>
                                    <select name="index_loop_size">
                                <option value="[300, 250]" <?php echo $selected300; ?>>[300, 250]</option>
                                <option value="[728, 90]" <?php echo $selected728; ?>>[728, 90]</option> 
                              </select>
			</td>
		</tr>
      <tr valign="top">
			<th scope="row"><label for="index_loop_channel">Channel</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="index_loop_channel" type="text" id="index_loop_channel" value="<?php echo stripslashes($this->get_google_ads('index_loop_channel'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
              
    </table>
    </fieldset>

    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;margin-left: 15px; margin-right: 15px;">
    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Free-Samples</strong></legend>
 

    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="free_loop_number">Number</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="free_loop_number" type="text" id="free_loop_number" value="<?php echo stripslashes($this->get_google_ads('free_loop_number'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
                        	<th scope="row"><label for="paid_link">Code:</label></th>
			<td >
		<textarea style="margin-bottom: -130px;margin-right:100px;"
                    name="free_loop_code" id="free_loop_code" rows="7" cols="80" style="font-size:11px;"><?php echo stripslashes( $this->get_google_ads('free_loop_code')); ?></textarea>


			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="free_loop_slot">Slot</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="free_loop_slot" type="text" id="free_loop_slot" value="<?php echo stripslashes($this->get_google_ads('free_loop_slot'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="free_loop_size">Size</label></th>
			<td>
                                    <?php if ((($this->get_google_ads('free_loop_size'))== ('[300, 250]')))
                                    
                                        $selected300 = 'selected';
                                     else {$selected728 = 'selected'; } 
                                     ?>
                                    <select name="free_loop_size">
                                <option value="[300, 250]" <?php echo $selected300; ?>>[300, 250]</option>
                                <option value="[728, 90]" <?php echo $selected728; ?>>[728, 90]</option> 
                                <?php unset ($selected300);unset ($selected728);?>
                              </select>
			</td>
		</tr>
      <tr valign="top">
			<th scope="row"><label for="free_loop_channel">Channel</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="free_loop_channel" type="text" id="free_loop_channel" value="<?php echo stripslashes($this->get_google_ads('free_loop_channel'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
              
    </table>
    </fieldset>


    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;margin-left: 15px; margin-right: 15px;">
    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Coupons</strong></legend>
 

    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="coupons_loop_number">Number</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="coupons_loop_number" type="text" id="coupons_loop_number" value="<?php echo stripslashes($this->get_google_ads('coupons_loop_number'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
                        	<th scope="row"><label for="coupons_loop_code">Code:</label></th>
			<td >
		<textarea style="margin-bottom: -130px;margin-right:100px;"
                    name="coupons_loop_code" id="coupons_loop_code" rows="7" cols="80" style="font-size:11px;"><?php echo stripslashes( $this->get_google_ads('coupons_loop_code')); ?></textarea>


			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="coupons_loop_slot">Slot</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="coupons_loop_slot" type="text" id="coupons_loop_slot" value="<?php echo stripslashes($this->get_google_ads('coupons_loop_slot'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="coupons_loop_size">Size</label></th>
			<td>
                                    <?php if ((($this->get_google_ads('coupons_loop_size'))== ('[300, 250]')))
                                    
                                        $selected300 = 'selected';
                                     else {$selected728 = 'selected'; } 
                                     ?>
                                    <select name="coupons_loop_size">
                                <option value="[300, 250]" <?php echo $selected300; ?>>[300, 250]</option>
                                <option value="[728, 90]" <?php echo $selected728; ?>>[728, 90]</option> 
                              </select> <?php unset ($selected300);unset ($selected728);?>
			</td>
		</tr>
      <tr valign="top">
			<th scope="row"><label for="coupons_loop_channel">Channel</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="coupons_loop_channel" type="text" id="coupons_loop_channel" value="<?php echo stripslashes($this->get_google_ads('coupons_loop_channel'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
              
    </table>
    </fieldset>


    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;margin-left: 15px; margin-right: 15px;">
    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Contests</strong></legend>
 

    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="contests_loop_number">Number</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="contests_loop_number" type="text" id="contests_loop_number" value="<?php echo stripslashes($this->get_google_ads('contests_loop_number'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
                        	<th scope="row"><label for="contests_loop_code">Code:</label></th>
			<td >
		<textarea style="margin-bottom: -130px;margin-right:100px;"
                    name="contests_loop_code" id="contests_loop_code" rows="7" cols="80" style="font-size:11px;"><?php echo stripslashes( $this->get_google_ads('contests_loop_code')); ?></textarea>


			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="contests_loop_slot">Slot</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="contests_loop_slot" type="text" id="contests_loop_slot" value="<?php echo stripslashes($this->get_google_ads('contests_loop_slot'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="contests_loop_size">Size</label></th>
			<td>
                                    <?php if ((($this->get_google_ads('contests_loop_size'))== ('[300, 250]')))
                                    
                                    { $selected300 = 'selected';}
                                     else {$selected728 = 'selected'; } 
                                     ?>
                                    <select name="contests_loop_size">
                                <option value="[300, 250]" <?php echo $selected300; ?>>[300, 250]</option>
                                <option value="[728, 90]" <?php echo $selected728; ?>>[728, 90]</option> 
                              </select> <?php unset ($selected300);unset ($selected728);?>
			</td>
		</tr>
      <tr valign="top">
			<th scope="row"><label for="contests_loop_channel">Channel</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="contests_loop_channel" type="text" id="contests_loop_channel" value="<?php echo stripslashes($this->get_google_ads('contests_loop_channel'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
              
    </table>
    </fieldset>




    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;margin-left: 15px; margin-right: 15px;">
    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Rewards</strong></legend>
 

    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="rewards_loop_number">Number</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="rewards_loop_number" type="text" id="rewards_loop_number" value="<?php echo stripslashes($this->get_google_ads('rewards_loop_number'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
                        	<th scope="row"><label for="rewards_loop_code">Code:</label></th>
			<td >
		<textarea style="margin-bottom: -130px;margin-right:100px;"
                    name="rewards_loop_code" id="rewards_loop_code" rows="7" cols="80" style="font-size:11px;"><?php echo stripslashes( $this->get_google_ads('rewards_loop_code')); ?></textarea>


			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="rewards_loop_slot">Slot</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="rewards_loop_slot" type="text" id="rewards_loop_slot" value="<?php echo stripslashes($this->get_google_ads('rewards_loop_slot'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="rewards_loop_size">Size</label></th>
			<td>
                                    <?php if ((($this->get_google_ads('rewards_loop_size'))== ('[300, 250]')))
                                    
                                        $selected300 = 'selected';
                                     else {$selected728 = 'selected'; } 
                                     ?>
                                    <select name="rewards_loop_size">
                                <option value="[300, 250]" <?php echo $selected300; ?>>[300, 250]</option>
                                <option value="[728, 90]" <?php echo $selected728; ?>>[728, 90]</option> 
                              </select> <?php unset ($selected300);unset ($selected728);?>
			</td>
		</tr>
      <tr valign="top">
			<th scope="row"><label for="rewards_loop_channel">Channel</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="rewards_loop_channel" type="text" id="rewards_loop_channel" value="<?php echo stripslashes($this->get_google_ads('rewards_loop_channel'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
              
    </table>
    </fieldset>


    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;margin-left: 15px; margin-right: 15px;">
    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Topics</strong></legend>
 

    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="topics_loop_number">Number</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="topics_loop_number" type="text" id="topics_loop_number" value="<?php echo stripslashes($this->get_google_ads('topics_loop_number'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
                        	<th scope="row"><label for="topics_loop_code">Code:</label></th>
			<td >
		<textarea style="margin-bottom: -130px;margin-right:100px;"
                    name="topics_loop_code" id="topics_loop_code" rows="7" cols="80" style="font-size:11px;"><?php echo stripslashes( $this->get_google_ads('topics_loop_code')); ?></textarea>


			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="topics_loop_slot">Slot</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="topics_loop_slot" type="text" id="topics_loop_slot" value="<?php echo stripslashes($this->get_google_ads('topics_loop_slot'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="topics_loop_size">Size</label></th>
			<td>
                                    <?php if ((($this->get_google_ads('topics_loop_size'))== ('[300, 250]')))
                                    
                                        $selected300 = 'selected';
                                     else {$selected728 = 'selected'; } 
                                     ?>
                                    <select name="topics_loop_size">
                                <option value="[300, 250]" <?php echo $selected300; ?>>[300, 250]</option>
                                <option value="[728, 90]" <?php echo $selected728; ?>>[728, 90]</option> 
                              </select> <?php unset ($selected300);unset ($selected728);?>
			</td>
		</tr>
      <tr valign="top">
			<th scope="row"><label for="topics_loop_channel">Channel</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="topics_loop_channel" type="text" id="topics_loop_channel" value="<?php echo stripslashes($this->get_google_ads('topics_loop_channel'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
              
    </table>
    </fieldset>
    
        <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;margin-left: 15px; margin-right: 15px;">
    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Blog</strong></legend>
 

    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="blog_loop_number">Number</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="blog_loop_number" type="text" id="blog_loop_number" value="<?php echo stripslashes($this->get_google_ads('blog_loop_number'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
                        	<th scope="row"><label for="blog_loop_code">Code:</label></th>
			<td >
		<textarea style="margin-bottom: -130px;margin-right:100px;"
                    name="blog_loop_code" id="blog_loop_code" rows="7" cols="80" style="font-size:11px;"><?php echo stripslashes( $this->get_google_ads('blog_loop_code')); ?></textarea>


			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="blog_loop_slot">Slot</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="blog_loop_slot" type="text" id="blog_loop_slot" value="<?php echo stripslashes($this->get_google_ads('blog_loop_slot'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="blog_loop_size">Size</label></th>
			<td>
                                    <?php if ((($this->get_google_ads('blog_loop_size'))== ('[300, 250]')))
                                    
                                        $selected300 = 'selected';
                                     else {$selected728 = 'selected'; } 
                                     ?>
                                    <select name="blog_loop_size">
                                <option value="[300, 250]" <?php echo $selected300; ?>>[300, 250]</option>
                                <option value="[728, 90]" <?php echo $selected728; ?>>[728, 90]</option> 
                              </select> <?php unset ($selected300);unset ($selected728);?>
			</td>
		</tr>
      <tr valign="top">
			<th scope="row"><label for="blog_loop_channel">Channel</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="blog_loop_channel" type="text" id="blog_loop_channel" value="<?php echo stripslashes($this->get_google_ads('blog_loop_channel'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
              
    </table>
    </fieldset>
    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;margin-left: 15px; margin-right: 15px;">
    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Sales</strong></legend>
 

    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="sales_loop_number">Number</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="sales_loop_number" type="text" id="sales_loop_number" value="<?php echo stripslashes($this->get_google_ads('sales_loop_number'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
                        	<th scope="row"><label for="sales_loop_code">Code:</label></th>
			<td >
		<textarea style="margin-bottom: -130px;margin-right:100px;"
                    name="sales_loop_code" id="sales_loop_code" rows="7" cols="80" style="font-size:11px;"><?php echo stripslashes( $this->get_google_ads('sales_loop_code')); ?></textarea>


			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="sales_loop_slot">Slot</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="sales_loop_slot" type="text" id="sales_loop_slot" value="<?php echo stripslashes($this->get_google_ads('sales_loop_slot'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="sales_loop_size">Size</label></th>
			<td>
                                    <?php if ((($this->get_google_ads('sales_loop_size'))== ('[300, 250]')))
                                    
                                        $selected300 = 'selected';
                                     else {$selected728 = 'selected'; } 
                                     ?>
                                    <select name="sales_loop_size">
                                <option value="[300, 250]" <?php echo $selected300; ?>>[300, 250]</option>
                                <option value="[728, 90]" <?php echo $selected728; ?>>[728, 90]</option> 
                              </select> <?php unset ($selected300);unset ($selected728);?>
			</td>
		</tr>
      <tr valign="top">
			<th scope="row"><label for="sales_loop_channel">Channel</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="sales_loop_channel" type="text" id="sales_loop_channel" value="<?php echo stripslashes($this->get_google_ads('sales_loop_channel'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
              
    </table>
    </fieldset>
    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;margin-left: 15px; margin-right: 15px;">
    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Exclusive</strong></legend>
 

    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="exclusive_loop_number">Number</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="exclusive_loop_number" type="text" id="exclusive_loop_number" value="<?php echo stripslashes($this->get_google_ads('exclusive_loop_number'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
                        	<th scope="row"><label for="exclusive_loop_code">Code:</label></th>
			<td >
		<textarea style="margin-bottom: -130px;margin-right:100px;"
                    name="exclusive_loop_code" id="exclusive_loop_code" rows="7" cols="80" style="font-size:11px;"><?php echo stripslashes( $this->get_google_ads('exclusive_loop_code')); ?></textarea>


			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="exclusive_loop_slot">Slot</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="exclusive_loop_slot" type="text" id="exclusive_loop_slot" value="<?php echo stripslashes($this->get_google_ads('exclusive_loop_slot'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="exclusive_loop_size">Size</label></th>
			<td>
                                    <?php if ((($this->get_google_ads('exclusive_loop_size'))== ('[300, 250]')))
                                    
                                        $selected300 = 'selected';
                                     else {$selected728 = 'selected'; } 
                                     ?>
                                    <select name="exclusive_loop_size">
                                <option value="[300, 250]" <?php echo $selected300; ?>>[300, 250]</option>
                                <option value="[728, 90]" <?php echo $selected728; ?>>[728, 90]</option> 
                              </select> <?php unset ($selected300);unset ($selected728);?>
			</td>
		</tr>
      <tr valign="top">
			<th scope="row"><label for="exclusive_loop_channel">Channel</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="exclusive_loop_channel" type="text" id="exclusive_loop_channel" value="<?php echo stripslashes($this->get_google_ads('exclusive_loop_channel'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
              
    </table>
    </fieldset>
      <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;margin-left: 15px; margin-right: 15px;">
    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Author</strong></legend>
 

    <table class="form-table">
            <tr valign="top">
			<th scope="row"><label for="author_loop_number">Number</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="author_loop_number" type="text" id="author_loop_number" value="<?php echo stripslashes($this->get_google_ads('author_loop_number'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
                        	<th scope="row"><label for="author_loop_code">Code:</label></th>
			<td >
		<textarea style="margin-bottom: -130px;margin-right:100px;"
                    name="author_loop_code" id="author_loop_code" rows="7" cols="80" style="font-size:11px;"><?php echo stripslashes( $this->get_google_ads('author_loop_code')); ?></textarea>


			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="author_loop_slot">Slot</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="author_loop_slot" type="text" id="author_loop_slot" value="<?php echo stripslashes($this->get_google_ads('author_loop_slot'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
                <tr valign="top">
			<th scope="row"><label for="author_loop_size">Size</label></th>
			<td>
                                    <?php if ((($this->get_google_ads('author_loop_size'))== ('[300, 250]')))
                                    
                                        $selected300 = 'selected';
                                     else {$selected728 = 'selected'; } 
                                     ?>
                                    <select name="author_loop_size">
                                <option value="[300, 250]" <?php echo $selected300; ?>>[300, 250]</option>
                                <option value="[728, 90]" <?php echo $selected728; ?>>[728, 90]</option> 
                              </select> <?php unset ($selected300);unset ($selected728);?>
			</td>
		</tr>
      <tr valign="top">
			<th scope="row"><label for="author_loop_channel">Channel</label></th>
			<td>
                               <input size="40" style="width: 375px;" name="author_loop_channel" type="text" id="author_loop_channel" value="<?php echo stripslashes($this->get_google_ads('author_loop_channel'));?>" class="regular-text"  style="width:50px"/> 
				
			</td>
		</tr>
              
    </table>
    </fieldset>
    
<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
<input type="hidden" name="adsense_settings" value="save" style="display:none;" />
</p>
</form>
    </div>











     

<?php }
function theme_social_stats_ads_sub(){ ?>

<td>
<input type="text" name="womanfreebies" id="womanfreebies"  style="font-size:11px;" value="<?php echo get_social_stats('womanfreebies'); ?>" class="regular-text" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="sweepstakes">Sweepstakes:</label></th>
<td>
<input type="text" name="sweepstakes" id="sweepstakes"  style="font-size:11px;" value="<?php echo get_social_stats('sweepstakes'); ?>" class="regular-text" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="beautyfreebies">Beauty Freebies:</label></th>
<td>
<input type="text" name="beautyfreebies" id="beautyfreebies"  style="font-size:11px;" value="<?php echo get_social_stats('beautyfreebies'); ?>" class="regular-text" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="petsamples">Pet Samples:</label></th>
<td>
<input type="text" name="petsamples" id="petsamples"  style="font-size:11px;" value="<?php echo get_social_stats('petsamples'); ?>" class="regular-text" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="freesamples">Free Samples:</label></th>
<td>
<input type="text" name="freesamples" id="freesamples"  style="font-size:11px;" value="<?php echo get_social_stats('freesamples'); ?>" class="regular-text" />
</td>
</tr>



    

        </table>
        </fieldset>
        
        
        <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>Other</strong></legend>
<table class="form-table">

<tr valign="top">
<th scope="row"><label for="pinterest">Pinterest:</label></th>
<td>
<input type="text" name="pinterest" id="pinterest"  style="font-size:11px;" value="<?php echo get_social_stats('pinterest'); ?>" class="regular-text" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="twitter">Twitter:</label></th>
<td>
<input type="text" name="twitter" id="twitter"  style="font-size:11px;" value="<?php echo get_social_stats('twitter'); ?>" class="regular-text" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="googleplus">Google +:</label></th>
<td>
<input type="text" name="googleplus" id="googleplus"  style="font-size:11px;" value="<?php echo get_social_stats('googleplus'); ?>" class="regular-text" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="emailsubscribers">Email Subscribers:</label></th>
<td>
<input type="text" name="emailsubscribers" id="emailsubscribers"  style="font-size:11px;" value="<?php echo get_social_stats('emailsubscribers'); ?>" class="regular-text" />
</td>
</tr>

</table>
        </fieldset>
        
        <p class="submit">
<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
<input type="hidden" name="socialstats" value="save" style="display:none;" />
</p>
 </form>
        </div>

<?php }

function get_theme_settings($opt_name){
$theme_settings=get_option('theme_settings');
return $theme_settings[$opt_name];
}

function get_google_ads($opt_name){
$googleoptions=get_option('google_ads_options');
return $googleoptions[$opt_name];
}
function get_paid_background($opt_name){
$options=get_option('background_options');
return $options[$opt_name];
}

function get_social_stats($opt_name){
//Nick, here you should read file and create value where key is name of the option and value is numbers from file
	$string = file_get_contents(ABSPATH.'/advertise/advertise');
	$json_a = json_decode($string,true);
	return $json_a[$opt_name];


}

function save_social_stats($options){
//        $pathq = ABSPATH.'/advertise/advertise.txt';
$pathq=ABSPATH.'/advertise/advertise';

	if (file_exists($pathq)) 
		//echo "FILE EXISTS!!!!!!!!!!!!!!!!!!";

	file_put_contents($pathq, json_encode($_POST));

	
	
}
function load_theme_scripts() {
    wp_enqueue_style( 'farbtastic' );
    wp_enqueue_script( 'farbtastic' );
}
     

}
?>
