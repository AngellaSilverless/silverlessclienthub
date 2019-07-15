jQuery(document).ready(function( $ ) {

/* ADD CLASS ON LOAD*/

    $("html").delay(100).queue(function(next) {
        $(this).addClass("loaded");

        next();
    });

/* COPY TO CLIPBOARD */

	$("label").click(function() {
		var el = $(this).next()[0];
		var range = document.createRange();
		range.selectNodeContents(el);
		var sel = window.getSelection();
		sel.removeAllRanges();
		sel.addRange(range);
		document.execCommand('copy');
		return false;
	});
	
	$(".icon").click(function() {
		var parent = 
		$(this).parents(".website-card").siblings().find(".wrapper-content").slideUp().prev().find(".icon").removeClass("active");
		$(this).parents(".website-header").next().slideToggle();
		$(this).toggleClass("active");
	});


});//Don't remove ---- end of jQuery wrapper