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

	$('.site-footer .app').on('click', function () {
		$('.site-footer .app-download').each(function () {
			$(this).hide();
		});
		$($(this).data('app-detail')).show();
		$('.site-footer .sub-footer').slideDown();
		$("html, body").animate({ scrollTop: $(document).height() }, 400);
	});

}(jQuery));