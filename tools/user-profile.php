<?php 
function extra_user_profile_fields( $user ) { ?>
<h3>
  <?php _e("Extra profile information", "blank"); ?>
</h3>
<table class="form-table">
  <tr>
    <th><label for="google_acc">
        <?php _e("Google +"); ?>
      </label></th>
    <td><input type="text" name="google_acc" id="google_acc" value="<?php echo esc_attr( get_the_author_meta( 'google_acc', $user->ID ) ); ?>" class="regular-text" /> 
      <br />
      <span class="description">
      <?php _e("Please enter your Google+ account."); ?>
      </span></td>
  </tr>
    <tr>
    <th><label for="twitter_acc">
        <?php _e("Twitter"); ?>
      </label></th>
    <td><input type="text" name="twitter_acc" id="twitter_acc" value="<?php echo esc_attr( get_the_author_meta( 'twitter_acc', $user->ID ) ); ?>" class="regular-text" /> 
      <br />
      <span class="description">
      <?php _e("Please enter your Twitter account."); ?>
      </span></td>
  </tr>
   <tr>
    <th><label for="user_pic">
        <?php _e("User Picture"); ?>
      </label></th>
    <td><input type="text" name="user_pic" id="user_pic" value="<?php echo esc_attr( get_the_author_meta( 'user_pic', $user->ID ) ); ?>" class="regular-text" /> 
      <br />
      <span class="description">
      <?php _e("Please enter your user picture URL."); ?>
      </span></td>
  </tr>
</table>
<?php }
 
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
 
function save_extra_user_profile_fields( $user_id ) { 
 
if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
 
update_usermeta( $user_id, 'google_acc', $_POST['google_acc'] );
update_usermeta( $user_id, 'twitter_acc', $_POST['twitter_acc'] );
update_usermeta( $user_id, 'user_pic', $_POST['user_pic'] );
} 
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );  
?>