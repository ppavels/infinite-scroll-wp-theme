jQuery(document).ready(function($){
    
     $( "#postexcerpt > .inside" ).append( "<p class='description countdown excerpt'></p>" );
     
         function updateCountdownExcerpt() {
    var remaining_d = 150 - jQuery('#excerpt').val().length;
    if (remaining_d < 0){  
        jQuery('.description.countdown.excerpt').css('color','red');
        jQuery('#excerpt').css('color','#fff');
        jQuery('#excerpt').css('background-color','#000');
    }else{
        jQuery('.description.countdown.excerpt').css('color', '#667');
        jQuery('#excerpt').css('color','#000');
        jQuery('#excerpt').css('background-color','#fff');
    }
    jQuery('.description.countdown.excerpt').text(remaining_d + ' characters left');
}
if ($("#postexcerpt").length > 0){
   updateCountdownExcerpt();
    $('#excerpt').change(updateCountdownExcerpt);
    $('#excerpt').keyup(updateCountdownExcerpt);
}
      function updateCountdownTitle() {
    var remaining = 55 - jQuery('#meta-title').val().length;
    if (remaining < 0){  
        jQuery('.description.countdown.title').css('color','red');
        jQuery('#meta-title').css('color','#fff');
        jQuery('#meta-title').css('background-color','#000');
    }else{
        jQuery('.description.countdown.title').css('color', '#667');
        jQuery('#meta-title').css('color','#000');
        jQuery('#meta-title').css('background-color','#fff');
    }
    jQuery('.description.countdown.title').text(remaining + ' characters left');
}
if ($("#meta-title").length > 0){
updateCountdownTitle();
    $('#meta-title').change(updateCountdownTitle);
    $('#meta-title').keyup(updateCountdownTitle);
}
    
     function updateCountdownDesc() {
    var remaining_d = 155 - jQuery('#meta-desc').val().length;
    if (remaining_d < 0){  
        jQuery('.description.countdown.desc').css('color','red');
        jQuery('#meta-desc').css('color','#fff');
        jQuery('#meta-desc').css('background-color','#000');
    }else{
        jQuery('.description.countdown.desc').css('color', '#667');
        jQuery('#meta-desc').css('color','#000');
        jQuery('#meta-desc').css('background-color','#fff');
    }
    jQuery('.description.countdown.desc').text(remaining_d + ' characters left');
}
if ($("#meta-desc").length > 0){
   updateCountdownDesc();
    $('#meta-desc').change(updateCountdownDesc);
    $('#meta-desc').keyup(updateCountdownDesc);
}
         function updateCountdownSidebar() {
    var remaining_d = 23 - jQuery('#sidebar_title').val().length;
    if (remaining_d < 0){  
        jQuery('.description.countdown.sidebar').css('color','red');
        jQuery('#sidebar_title').css('color','#fff');
        jQuery('#sidebar_title').css('background-color','#000');
    }else{
        jQuery('.description.countdown.sidebar').css('color', '#667');
        jQuery('#sidebar_title').css('color','#000');
        jQuery('#sidebar_title').css('background-color','#fff');
    }
    jQuery('.description.countdown.sidebar').text(remaining_d + ' characters left');
}
if ($("#sidebar_title").length > 0){
   updateCountdownSidebar();
    $('#sidebar_title').change(updateCountdownSidebar);
    $('#sidebar_title').keyup(updateCountdownSidebar);
}
         
    
	post_type=jQuery("[name='post-type']:checked").val();
	if(post_type=='contests'){
		showContests();
		hideCouponClear();
	}
	else if(post_type=='coupon'){
		showCoupon();
		hideContestsClear();
	}
        else if(post_type=='rewards'){
		showRewards();
		//hideContestsClear();
	}
	else{
		hideAll();
		hideCouponClear();
		hideContestsClear();
		
	}
	
/*	jQuery("#postexcerpt .handlediv").after("<div style='position:absolute;top:0px;right:5px;color:#666;'><small>Excerpt length: </small><input type='text' value='0' maxlength='3' size='3' id='excerpt_counter' readonly='' style='background:#fff;'> <small>character(s).</small></div>");
    jQuery("#excerpt_counter").val(jQuery("#excerpt").val().length);
    jQuery("#excerpt").keyup( function() {
    jQuery("#excerpt_counter").val(jQuery("#excerpt").val().length);

    });
*/	
	jQuery("#ed_toolbar").after("<div style='position:absolute;top:35px;right:5px;color:#666;'><small>Content length: </small><input type='text' value='0' maxlength='3' size='3' id='content_counter' readonly='' style='background:#fff;'> <small>character(s).</small></div>");
    jQuery("#content_counter").val(jQuery("#content").val().length);
    jQuery("#content").keyup( function() {
    jQuery("#content_counter").val(jQuery("#content").val().length);

    });
	
	
	
	/*jQuery("#ed_toolbar").after("<div style=\"position:absolute;top:0px;right:5px;color:#666;\"><small>Content length: </small><input type=\"text\" value=\"0\" maxlength=\"3\" size=\"3\" id=\"content_counter\" readonly=\"\" style=\"background:#fff;\"> <small>character(s).</small></div>");
    jQuery("#content_counter").val(jQuery("#excerpt").val().length);
    jQuery("#content").keyup( function() {
    jQuery("#content_counter").val(jQuery("#content").val().length);
    });*/
	
	
	
});
function MultiPostThumbnailsSetThumbnailHTML(html, id, post_type){
	jQuery('.inside', '#' + post_type + '-' + id).html(html);
};

function MultiPostThumbnailsSetThumbnailID(thumb_id, id, post_type){
	var field = jQuery('input[value=_' + post_type + '_' + id + '_thumbnail_id]', '#list-table');
	if ( field.size() > 0 ) {
		jQuery('#meta\\[' + field.attr('id').match(/[0-9]+/) + '\\]\\[value\\]').text(thumb_id);
	}
};

function MultiPostThumbnailsRemoveThumbnail(id, post_type, nonce){
	jQuery.post(ajaxurl, {
		action:'set-' + post_type + '-' + id + '-thumbnail', post_id: jQuery('#post_ID').val(), thumbnail_id: -1, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
	}, function(str){
		if ( str == '0' ) {
			alert( setPostThumbnailL10n.error );
		} else {
			MultiPostThumbnailsSetThumbnailHTML(str, id, post_type);
		}
	}
	);
};


function MultiPostThumbnailsSetAsThumbnail(thumb_id, id, post_type, nonce){
	var $link = jQuery('a#' + post_type + '-' + id + '-thumbnail-' + thumb_id);

	$link.text( setPostThumbnailL10n.saving );
	jQuery.post(ajaxurl, {
		action:'set-' + post_type + '-' + id + '-thumbnail', post_id: post_id, thumbnail_id: thumb_id, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
	}, function(str){
		var win = window.dialogArguments || opener || parent || top;
		$link.text( setPostThumbnailL10n.setThumbnail );
		if ( str == '0' ) {
			alert( setPostThumbnailL10n.error );
		} else {
			$link.show();
			$link.text( setPostThumbnailL10n.done );
			$link.fadeOut( 2000, function() {
				jQuery('tr.' + post_type + '-' + id + '-thumbnail').hide();
			});
			win.MultiPostThumbnailsSetThumbnailID(thumb_id, id, post_type);
			win.MultiPostThumbnailsSetThumbnailHTML(str, id, post_type);
		}
	}
	);
}

function hideAll(){
	
	jQuery('#coupons-format-meta-boxes').fadeOut();
	jQuery('.survey_hidden').fadeOut();
	jQuery('#contests-format-meta-boxes').fadeOut();
	jQuery('#rewards-format-meta-boxes').fadeOut();
	
	
	
}
function showCoupon(){
	hideAll();
	hideContestsClear();
	jQuery('#coupons-format-meta-boxes').fadeIn();
	
}

function showContests(){
 hideAll();
  hideCouponClear();
 jQuery('#contests-format-meta-boxes').fadeIn();

	
}
function showRewards(){
 hideAll();
 hideCouponClear();
 jQuery('#rewards-format-meta-boxes').fadeIn();

	
}



function hideCouponClear(){
	jQuery('#print').removeAttr('checked');
        jQuery('#mail').removeAttr('checked');
        jQuery('#online').removeAttr('checked');
        jQuery('#coupon-save-text').val('');
        jQuery('#coupon-code').val('');
		
}

function hideContestsClear(){
	jQuery('#mobile-friendly').removeAttr('checked');
	jQuery("input[name='entry-frequency']").removeAttr('checked');
	jQuery(".entry-type").removeAttr('checked');
	jQuery("#prize-value").val('');
	jQuery("#privacy-policy").val('');
	jQuery("#terms-and-conditions").val('');
	jQuery("#draw-date").val('');
	jQuery("#restrictions").text('');
	
}