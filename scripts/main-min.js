!function(o){"use strict";o(".nav-toggle").on("click",function(){o(this).toggleClass("-toggled"),o(".site-menu .mobile-menu-item").slideToggle()}),o(".slider").slick({autoplay:!0,arrows:!0,fade:!0,autoplaySpeed:5e3,speed:600}),o("[data-card-link]").on("click",function(t){window.location.href=o(this).data("card-link")}),o("[data-toggle-class]").on("click",function(){o(o(this).data("toggle-target")).toggleClass(o(this).data("toggle-class"))}),o(".site-footer .app").on("click",function(){o(".site-footer .app-download").each(function(){o(this).hide()}),o(o(this).data("app-detail")).show(),o(".site-footer .sub-footer").slideDown(),o("html, body").animate({scrollTop:o(document).height()},400)})}(jQuery);