(function ($) {

	'use strict';

	// mobile navigation toggling
	$('.nav-toggle').on('click', function () {
		$(this).toggleClass('-toggled');
		// $('.site-menu').toggleClass('-toggled');
		$('.site-menu .mobile-menu-item').slideToggle();
	});

	// slider
	$('.slider').slick({
		autoplay: true,
		arrows: true,
		fade: true,
		autoplaySpeed: 5000,
		speed: 600
	});

	// card links 
	$('[data-card-link]').on('click', function (e) {
		window.location.href = $(this).data('card-link');
	});

	// toggle class
	$('[data-toggle-class]').on('click', function () {
		$($(this).data('toggle-target')).toggleClass($(this).data('toggle-class'));
	});

}(jQuery));