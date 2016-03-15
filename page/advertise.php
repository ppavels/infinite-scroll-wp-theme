<link rel="stylesheet" href="<?php  bloginfo('template_url');  ?>/advertise.css" type="text/css" />
<div id="content" style="margin-top:15px" >
	<div id="col-1">
		<div class="post-heading">
			<h1>Let&acute;s Get Started!</h1>
		</div>
		<div id="ad-form">
			<form class="form-ad" id="form-ad">
                                <input type=hidden name="action" value="send_advertise_email"> 
				<input name="name" id="email_name" type="text" value="Name*" class="ad-form-field" >
				<input name="title" id="email_title" type="text" value="Title" class="ad-form-field">
				<input name="company name" id="email_company" type="text" value="Company Name*" class="ad-form-field">
				<input name="website" id="email_website" type="text" value="Company Website*" class="ad-form-field">
				<input name="phone" id="email_phone" type="tel" value="Phone Number*" class="ad-form-field">
				<input name="email" id="email_email" type="email" value="Email Address*" class="ad-form-field">
				<input name="budget" id="email_budget" type="text" value="Budget*" class="last-text-field ad-form-field ">
             </form>
				<p>Where are you currently buying media?</p>
				<div class="check-box">
					<p><input name="facebook" id="facebook" type="checkbox" value="" class="ad-form-check"><label for="facebook">Facebook</label></p>
					<p><input name="google" id="google" type="checkbox" value="" class="ad-form-check"><label for="google">Google</label></p>
					<p><input name="other_ad_exchange" id="other_ad_exchange" type="checkbox" value="" class="ad-form-check"><label for="OtherAd">Other Ad Exchange</label></p>
					<p><input name="blogs" id="blogs" type="checkbox" value="" class="ad-form-check"><label for="Blogs">Blogs</label></p>
					<p><input name="agency" id="agency" type="checkbox" value="" class="ad-form-check"><label for="Agency">Agency</label></p>
					<p class="last-c-box"><input name="not_buying" id="not_buying" type="checkbox" value="" class="ad-form-check "><label for="not_buying">Not Current Buying Media</label></p>
				</div>
				<input name="other" type="text" value="Other" class="ad-field" id="ad_field_other">
				<textarea class="text-area-sbmt" name="add_comm" id="text-area-sbmt">Additional Comments</textarea>
				<input name="submit-button" type="submit" value="submit" class="submit-btn-sf" id="submit-btn-sf">
                                    <input name="done" type="text" value="Email was sent, thank You!" id="ad-done-mail" class="ad-field" style="display: none">
		</div>
	</div>
</div>