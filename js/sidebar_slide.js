$(function() {
   if ($("#top_slide").length > 0){
            var offset = $("#top_slide").offset();
            var topPadding = 50;
			
			//var foffset = $("#social-connect").offset();
            $(window).scroll(function() {
                
				
				if ($(window).scrollTop() > offset.top) {
					$("#offsettest").val($(window).scrollTop());
					
                    $("#top_slide").stop().animate({
                        marginTop: $(window).scrollTop() - offset.top + topPadding,
						 
			      });
                } else {
					
					//alert(foffset.top+' ' +offset.top);
                    $("#top_slide").stop().animate({
                        marginTop: 50,
						
						
                    });
			$("#top_slide").css("margin-bottom", "-500px" );	 
					
					
					
                };
            });}
        });


