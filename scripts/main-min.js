!function(i){"use strict";i(".nav-toggle").on("click",function(){i(this).toggleClass("-toggled"),i(".site-menu .mobile-menu-item").slideToggle()}),i(".slider").slick({autoplay:!0,arrows:!0,fade:!0,autoplaySpeed:5e3,speed:600}),i(".card[data-card-link]").on("click",function(e){window.location.href=i(this).data("card-link")})}(jQuery);