jQuery(document).ready(function ($) {
	
	

	
	
	$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
			$('#toTop').fadeIn();	
		} else {
			$('#toTop').fadeOut();
		}
	});
 
	$('#toTop').click(function() {
		$('body,html').animate({scrollTop:0},800);
	});	

	
	
	
	$.urlParam = function(name){
    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
	if(results){
    return results[1] || 0;
	}
	
	
	
}



//this is filter on contest page
$("#filterontest" ).submit(function( event ) {
$.cookie('poertclass');
cookiearray=$("#filterontest").serialize();
$.cookie('poertclass', cookiearray  ,{ path: '/'});
event.preventDefault();
var value = $("#brand_post_js" ).val();
if (value=='no_brand'){value=''};
newurl =  contests_url + value;
window.location=newurl;
});


});

jQuery(document).ready(function(){
	
		jQuery('.featured-image').hover(function(e) {
		jQuery(this).find('.hover-bg').animate({
			bottom: 0,
		}, 200)
	}, function(e) {
		jQuery(this).find('.hover-bg').animate({
			bottom: -55,
		}, 200)
	});

// Drop Down Menu
jQuery(" #menu ul li ul ").css({display: "none"}); // Opera Fix
jQuery(" #menu li").hover(function(){
  jQuery(this).addClass("activeLink");
  jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).fadeIn(300);
  },function(){
  jQuery(this).removeClass("activeLink");
  jQuery(this).find('ul:first').fadeOut(300);
  });




  

	
	
	//this is advertiser page starts
	
	
	jQuery('#ad-form input[type="text"],#ad-form [type="tel"],#ad-form [type="email"],#ad-form [type="password"]').focus(function() {
		$(this).addClass('ad-form-focus');
		this.value = '';
    });
	jQuery('.form-ad select').focus(function() {
		$(this).addClass('ad-form-focus');
	
    });
    jQuery('#ad-form input[type="text"],#ad-form [type="tel"],#ad-form [type="email"],#ad-form [type="password"],.form-ad select').blur(function() {
		$(this).removeClass('ad-form-focus');
		if (this.value == ''){
            this.value = this.defaultValue;
        }
    });
	jQuery('#ad-form textarea').focus(function() {
		$(this).addClass('ad-form-focus');
		 this.value = '';
		
    });
    jQuery('#ad-form textarea').blur(function() {
		$(this).removeClass('ad-form-focus');
		if (this.value == ''){
            this.value = this.defaultValue;
        }
    });
	
	//this is advertiser page ends
	
	
	
	jQuery('.cat').click(function(e) {
		e.preventDefault();
		jQuery(this).toggleClass('activeCat').delay(500);
        jQuery('.cat-list').toggle();
		
    });
	/*
	jQuery('.cat, .cat-list').hover(function(e) {
		jQuery('.cat').toggleClass('activeCat');
        jQuery('.cat-list').toggle();
		
    });
	
*/

jQuery('#sidebaremail').focus(function() {
		
		 this.value = '';
		
    });
	
	jQuery('#sidebaremail').blur(function() {
		
		if (this.value == ''){
            this.value = this.defaultValue;
        }
		
    });


	//
	
	// Field boder
	 jQuery('.signup-form input[type="text"]').focus(function() {
       jQuery(this).addClass('fld-focus');
    });
    jQuery('.signup-form input[type="text"]').blur(function() {
       jQuery(this).removeClass('fld-focus');
    });
	
	
	if (jQuery("#expired-date").length){ 
    jQuery("#expired-date").datepicker();
	 }
	 if (jQuery("#draw-date").length){ 
    jQuery("#draw-date").datepicker();
	 }
	 
	jQuery('.submit-btn-sf').click(function(e) {
    $('#form-ad input').css('border', '5px solid #aee0f5');
        
	params=jQuery("#form-ad, #text-area-sbmt, #facebook, #google, #other_ad_exchange, #blogs, #agency, #not_buying, #ad_field_other").serialize();
	//params='action=send_advertise_email&formelements='+formelements;
	//alert(params);
	send_email(params,ajax_url);
    }); 
	
	
})
// whitney-book-italic


   





Cufon.replace('.field-1', { fontFamily: 'Whitney Book', hover: true });

// whitney-book-italic ends
// whitney-bold

Cufon.replace('#menu ul li a, #content h1, .panel-rewards h1, .panel-signup h5', { fontFamily: 'Whitney Bold', hover: true });

// whitney-mediume

Cufon.replace('#new-menu ul li a, .category-image, #brands ul li a, .Deals-result h5, .contest-post h6, #contst-post h2, #related-artical h4, .coupons-checks h6, .coupons-checks label, .related-offers h6, .brand-search-head h5, .brand-chracters ul li a, .brand-alphabat h1, .signup-footer-text p', { fontFamily: 'Whitney', hover: true });

// whitney-book-italic
//Cufon.replace('#new-menu ul li.language a', { fontFamily: 'Whitney Book', hover: false });

// whitney-semi-bold

Cufon.replace('h5, .post-heading .see-more,.back, .survey-post h5, .back-main, .back-top, .paid-back, .coupons-head h2, .contest-head h2, .free-samples-head h2, .blog-head h2, .what-bottom-btn', { fontFamily: 'Whitney Semibold', hover: true });
Cufon.replace('h1, .post-heading .see-more,.back, .survey-post h1, .back-main, .back-top, .paid-back, .coupons-head h2, .contest-head h2, .free-samples-head h2, .blog-head h2, .what-bottom-btn', { fontFamily: 'Whitney Semibold', hover: true });
//
// whitney-book

Cufon.replace('.coupon-detail h2, .text-widget h2', { fontFamily: 'Whitney Book', hover: true });



//sending ajax email


function send_email(datastr, ajax_url){
	
		$.ajax({	
        type: "POST",
        url: ajax_url,
        data:datastr /*{
		action: 'send_advertise_email'
		}*/,
        cache: true,
		dataType: 'html',
        success: function(response){
		//alert(response);
       if (response==116){
             $('#email_email').css('border', '5px solid red');
        }
       if (response==117){
             $('#email_website').css('border', '5px solid red');
        }	
       if (response==118){
            $('#email_phone').css('border', '5px solid red');
       }
       if (response==119){
            $('#email_name').css('border', '5px solid red');
       }
       if (response==120){
            $('#email_company').css('border', '5px solid red');
       }
        if (response==121){
            $('#email_budget').css('border', '5px solid red');
       }
       if (response==122){
            $('#email_title').attr('value', '');
       }
        if (response==202){
            alert('email was not sent');
       }
       if (response==101){
           jQuery('#submit-btn-sf').fadeOut("fast");
            jQuery('#ad-done-mail').fadeIn();
            
            
       }
	 },
	 error: function (jqXHR, textStatus, errorThrown){
     errormess=textStatus+" : "+jqXHR.status+" "+jqXHR.statusText;
	 $('#errmess').html(errormess);
	 $('div.errmess').fadeIn(300);
	 setTimeout('fadeError()', 5000);
}
    });
		
		
}

function fadeError(){
$('div.errmess').fadeOut(1000);
}
function eraseContestFilter(){
$("#filterontest").reset();
$.cookie('poertclass', '',{ path: '/'});
location.reload();
}