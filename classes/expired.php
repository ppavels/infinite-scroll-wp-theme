<?php //start  post meta box
$arr_key = "Announcements";

$meta_boxes = array(
					
"displaytouser"=>array(
"name" => "displaytouser",
),

"expimo" => array(
"name" => "expimo",
"title" => "Expiration Month",
"description" => "Select a date for this post to expire.",
"option" => array('-1', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12')),
 
"expida" => array(
"name" => "expida",
"title" => "Expiration Day",
"description" => "Select Day",
"options" => array('-1', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31')),
 
"expiye" => array(
"name" => "expiye",
"title" => "Expiration Year",
"description" => "Select Year",
"options" => array('-1', date('Y'), date('Y')+1, date('Y')+2, date('Y')+3)),
 
"expiti" => array(
"name" => "expiti",
"title" => "Expiration Time",
"description" => "Select Time",
"options" => array('-1','00:00:00', '01:00:00', '02:00:00', '03:00:00', '04:00:00', '05:00:00', '06:00:00', '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00', '18:00:00', '19:00:00', '20:00:00', '21:00:00', '22:00:00', '23:59:59')),
 
"autodelp" => array(
"name" => "autodelp",
"title" => "Pend Post On Expiration",
"description" => "Choose if a post should be pended after expiration.  Choosing NO will remove the post from the homepage and moved to category 'Expired' ",
"options" => array('no', 'yes')),
 
);
 
function create_meta_box() {
global $arr_key;
 
if( function_exists( 'add_meta_box' ) ) {
add_meta_box( 'new-meta-boxes', ucfirst($arr_key).' Post Options', 'display_meta_box', 'post', 'normal', 'high' );
}

}
 
function display_meta_box() {
global $post, $meta_boxes, $arr_key;
?>
 
<div class="form-wrap">
 
<?php
 
wp_nonce_field( plugin_basename( __FILE__ ), $arr_key . '_wpnonce', false, true );
 
foreach($meta_boxes as $meta_box) {
$data = get_post_meta($post->ID, $arr_key, true);
 
?>
<?php if($meta_box[ 'name'] != 'expimo' &&
$meta_box[ 'name'] != 'expida' &&
$meta_box[ 'name'] != 'expiye' &&
$meta_box[ 'name'] != 'autodep' &&
$meta_box[ 'name'] != 'expiti' &&
$meta_box[ 'name'] != 'autodelp'&&
$meta_box[ 'name'] != 'displaytouser'
) { ?>
<div class="form-field form-required">
 
<label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
 
<input type="text" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); ?>" /> 
 
<p><?php echo $meta_box[ 'description' ]; ?></p></div>
<?php } elseif ($meta_box[ 'name'] == 'expimo') {
 
echo '<div class="form-field form-required"><label for="Post Expiration Date">Post Expiration Date</label>';
echo '<table><tr><td><select name="expimo" id="expimo">';
foreach ($meta_boxes['expimo']['option'] as $option) {
	if ($option == '-1') {$optionez = '--';
}
else if ($option == '01') {$optionez = 'January';
} elseif ($option == '02') {$optionez = 'February';
} elseif ($option == '03') {$optionez = 'March';
} elseif ($option == '04') {$optionez = 'April';
} elseif ($option == '05') {$optionez = 'May';
} elseif ($option == '06') {$optionez = 'June';
} elseif ($option == '07') {$optionez = 'July';
} elseif ($option == '08') {$optionez = 'August';
} elseif ($option == '09') {$optionez = 'September';
} elseif ($option == '10') {$optionez = 'October';
} elseif ($option == '11') {$optionez = 'November';
} else {$optionez = 'December';}
echo '<option', ' value="', $option, '"', $data[ 'expimo' ] == $option ? ' selected="selected"' : '', '>', $optionez, '</option>';
}
echo '</select>';
echo '<select name="expida" id="expida">';
foreach ($meta_boxes['expida']['options'] as $option) {
	if($option==-1){
echo '<option', ' value="', $option, '"', $data[ 'expida' ] == $option ? ' selected="selected"' : '', '>-</option>';
	}
	else{
		echo '<option', ' value="', $option, '"', $data[ 'expida' ] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
	}
}
echo '</select>';
echo '<select name="expiye" id="expiye">';
foreach ($meta_boxes['expiye']['options'] as $option) {
	if($option==-1){
echo '<option', $data[ 'expiye' ] == $option ? ' selected="selected"' : '', '>--</option>';
	}
	else{
		echo '<option', $data[ 'expiye' ] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
	}
}
echo '</select>';
echo '<select name="expiti" id="expiti">';
foreach ($meta_boxes['expiti']['options'] as $option) {
if ($option == '-1') {$optionez = '-';
}
else if ($option == '00:00:00') {$optionez = '12MN';
} elseif ($option == '01:00:00') {$optionez = '1AM';
} elseif ($option == '02:00:00') {$optionez = '2AM';
} elseif ($option == '03:00:00') {$optionez = '3AM';
} elseif ($option == '04:00:00') {$optionez = '4AM';
} elseif ($option == '05:00:00') {$optionez = '5AM';
} elseif ($option == '06:00:00') {$optionez = '6AM';
} elseif ($option == '07:00:00') {$optionez = '7AM';
} elseif ($option == '08:00:00') {$optionez = '8AM';
} elseif ($option == '09:00:00') {$optionez = '9AM';
} elseif ($option == '10:00:00') {$optionez = '10AM';
} elseif ($option == '11:00:00') {$optionez = '11AM';
} elseif ($option == '12:00:00') {$optionez = '12NN';
} elseif ($option == '13:00:00') {$optionez = '1PM';
} elseif ($option == '14:00:00') {$optionez = '2PM';
} elseif ($option == '15:00:00') {$optionez = '3PM';
} elseif ($option == '16:00:00') {$optionez = '4PM';
} elseif ($option == '17:00:00') {$optionez = '5PM';
} elseif ($option == '18:00:00') {$optionez = '6PM';
} elseif ($option == '19:00:00') {$optionez = '7PM';
} elseif ($option == '20:00:00') {$optionez = '8PM';
} elseif ($option == '21:00:00') {$optionez = '9PM';
} elseif ($option == '22:00:00') {$optionez = '10PM';
} else {$optionez = '11PM';}
echo '<option', ' value="', $option, '"',$data[ 'expiti' ] == $option ? ' selected="selected"' : '', '>', $optionez, '</option>';
}
echo '</select></td>';


/*

foreach ($meta_boxes['autodelp']['options'] as $option) {
echo '<option', $data[ 'autodelp' ] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
*/

echo '<td style="width:10px !important; margin:0 10px "><input ', $data[ 'displaytouser' ] == 1 ? ' checked="checked"' : '', ' type="checkbox" name="displaytouser" value="1" /></td><td style="width:250px !important;  ">Display When Post Expires to User</td></tr></table>'; 





echo '<p>Select a date for this post to expire.</p>';
} elseif ($meta_box[ 'name'] == 'autodelp') {
echo '<label for="Auto Delete">Pend the post?</label>';
echo '<select name="autodelp" id="autodelp">';
foreach ($meta_boxes['autodelp']['options'] as $option) {
echo '<option', $data[ 'autodelp' ] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
echo '</select><p>', $meta_box[ 'description' ], '</p></div>';
} else {}
?>
 
<?php
}; ?>
 
<?php
if (get_the_time('m') == 12) {
	$mononet = 1;
} else {$mononet = 1 + get_the_time('m');}
$slashhh = '/';
$spaceeee = ' ';
if ( $data[ 'expida'] == '-') {$datarr = $mononet.$slashhh.get_the_time('d/Y').$spaceeee.$data[ 'expiti' ];
} else {$datarr = $data[ 'expimo' ].$slashhh.$data[ 'expida' ].$slashhh.$data[ 'expiye' ].$spaceeee.$data[ 'expiti' ];} ?>
<?php update_post_meta($post->ID, 'expiration', $datarr); ?>
</div>
<?php
}
function save_meta_box( $post_id ) {
global $post, $meta_boxes, $arr_key;
 
foreach( $meta_boxes as $meta_box ) {
$data[ $meta_box[ 'name' ] ] = $_POST[ $meta_box[ 'name' ] ];
}
 
if ( !wp_verify_nonce( $_POST[ $arr_key . '_wpnonce' ], plugin_basename(__FILE__) ) )
return $post_id;
 
if ( !current_user_can( 'edit_post', $post_id ))
return $post_id;
 
update_post_meta( $post_id, $arr_key, $data );
}
 
add_action( 'admin_menu', 'create_meta_box' );
add_action( 'save_post', 'save_meta_box' );
//end  post meta box


function check_if_post_exprired($post_id){
	$current_time=current_time('mysql');
	$data = get_post_meta($post_id, 'Announcements', true );
	$expired_date=get_post_meta($post_id, 'expiration', true);
	if(strpos($expired_date, "-")===false&&!empty($expired_date)){
    $secondsbetween = strtotime($expired_date)-strtotime($current_time);
	
	//echo " post is ".$post_id." secs ".$secondsbetween." expdate is ".$expired_date;
	if ( $secondsbetween <= 0 && $data[ 'autodelp'] == 'yes') {
    // Update post
     $my_post = array();
     $my_post['ID'] = $post_id;
     $my_post['post_status'] = 'pending';

// Update the post into the database
     wp_update_post($my_post);
	
	return true;
    }
	else if ( $secondsbetween <= 0 && $data[ 'autodelp'] == 'no') {
		$expired_id=get_category_id_by_name('Expired');
		if(!empty($expired_id)){
		$post_categories=array();
		$post_categories[0]=$expired_id;
		wp_set_post_categories($post_id, $post_categories);
		
		}
    
	return true;
//	echo " exp_cat id ".$expired_id;
	}
	else if ($secondsbetween > 0) {
    //echo " will be expired in  ".$secondsbetween;
	return false;
	}
	
	
	
	
	
	/*echo "Post ID ".$post_id." now is ".gmdate('Y-m-d H:i:s')." expired on ".$expired_date." seconds between ".$secondsbetween." pend the post? ".$data['autodelp']." Expired id ".$expired_id;*/
	
	}
	
	
	
	
	
	else{
	/*echo "Post ID ".$post_id." now is ".$current_time." never expired";*/
	return false;
	}
}

function display_expire_to_user($post_id){
	$data = get_post_meta($post_id, 'Announcements', true );
	if($data['displaytouser']==1){
		return true;
	}
	else{
		return false;
	}
	
}

function change_date_format($date, $format=null){
	
	if($format==null){
		$format="M j, Y h:i a";
	}
$old_date_timestamp = strtotime($date);

$newDateString=date($format, $old_date_timestamp);
return $newDateString;

}


function show_expired_date($post_id){
	
	$is_display_exp=display_expire_to_user($post_id);
     if($is_display_exp){
	 $display_exp='Valid Until ';
	 $expired_date=get_post_meta($post_id, 'expiration', true);
	 $expired_date=change_date_format($expired_date, "F j, Y h:i a");
     }
     else{
	  $display_exp='';
	  $expired_date='';
     }
	 
	 return $display_exp." ".$expired_date;
}
?>