jQuery(document).ready(function( $ ) {

/* ADD CLASS ON LOAD*/

    $("html").delay(100).queue(function(next) {
        $(this).addClass("loaded");

        next();
    });

/* COPY TO CLIPBOARD */

	$("label.highlight").click(function() {
		var el = $(this).next()[0];
		var range = document.createRange();
		range.selectNodeContents(el);
		var sel = window.getSelection();
		sel.removeAllRanges();
		sel.addRange(range);
		document.execCommand('copy');
		return false;
	});
	
	$(".icon, .wrapper-title").click(function() {
		$(this).parents(".website-card").siblings().find(".wrapper-content").slideUp().prev().find(".icon").removeClass("active");
		$(this).parents(".website-header").next().slideToggle();
		$(this).parents(".website-header").find(".icon").toggleClass("active");
	});
	
	$(".items input[type=checkbox]").change(function() {
		$.ajax({
			url:      ajax_object.ajax_url,
			type:     "POST",
			dataType: "JSON",
			data: {
				action: "update_checklist",
				name:   $(this).val(),
				value:  $(this).prop("checked"),
				postID: $(this).attr("post-id")  
			}
		});
	});


});//Don't remove ---- end of jQuery wrapper
