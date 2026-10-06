jQuery(function ($) {
	// Main menu hover
	$('.resta-menu > li').on('mouseenter', function () {
		$(this).addClass('is-hovered');
	}).on('mouseleave', function () {
		$(this).removeClass('is-hovered');
	});

	// Slider functionality
	var sliderIndex = 0;
	var slides = $('.resta-slider__item');

	if (slides.length > 0) {
		function showSlide(n) {
			if (n >= slides.length) {
				sliderIndex = 0;
			}
			if (n < 0) {
				sliderIndex = slides.length - 1;
			}
			var offset = -sliderIndex * 100;
			$('.resta-slider__wrapper').css('transform', 'translateX(' + offset + '%)');
		}

	$('.resta-slider__nav--next').on('click', function () {
		++sliderIndex;
		showSlide(sliderIndex);
	});

	$('.resta-slider__nav--prev').on('click', function () {
		--sliderIndex;
		showSlide(sliderIndex);
	});

	// Auto-play slider
	setInterval(function () {
		++sliderIndex;
		showSlide(sliderIndex);
	}, 5000);

	// Newsletter form
	$('.resta-newsletter__form').on('submit', function (e) {
		e.preventDefault();
		var $form = $(this);
		var email = $form.find('input[type="email"]').val();

		if (email) {
			// Send email to server or external service
			console.log('Newsletter signup:', email);
			alert(<?php echo wp_json_encode( __( 'Thank you for subscribing!', 'resta' ) ); ?>);
			$form.reset();
		}
	});
});
