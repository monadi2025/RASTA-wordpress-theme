jQuery(function ($) {
	$('.resta-menu > li').on('mouseenter', function () {
		$(this).addClass('is-hovered');
	}).on('mouseleave', function () {
		$(this).removeClass('is-hovered');
	});
});
