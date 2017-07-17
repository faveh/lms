$("#TS").click(function() {
    if($(".content-page").hasClass('expand')) {
    	$(".side-bar").fadeIn('500');
	    $(".content-page").toggleClass("expand");
    } else {
    	$(".side-bar").fadeOut('500');
	    $(".content-page").fadeIn('500');
	    $(".content-page").toggleClass("expand");
    }
});

$("#S-UP").click(function() {
	$('body,html').animate({scrollTop: 0}, 300);
});