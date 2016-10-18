jQuery(document).ready(function ($) {
	Newsmag.initGoToTop($);
	Newsmag.initSearchForm($);
	Newsmag.initMainSlider($);
	Newsmag.initLazyLoad($);
});


var Newsmag = {
	initLazyLoad   : function ($) {
		$(".lazy").lazyload({
			effect        : "fadeIn",
			skip_invisible: false
		});
	},
	initMainSlider: function ($) {
		if ( $('.newsmag-slider').length ) {
			owl = $('.newsmag-slider');

			owl.on('initialized.owl.carousel', function(){
				$('.owl-nav-list').addClass('active');
			});

			owl.owlCarousel({
				loop           : true,
				items          : 1,
				dots           : false,
				mouseDrag      : true,
				navText        : '',
				// navText     : [ "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ],
				navClass       : [ "main-slider-previous", "main-slider-next" ],
				autoplay       : true,
				autoplayTimeout: 17000,
				responsive     : {
					1   : {
						nav : false,
						dots: false
					},
					600 : {
						nav : false,
						dots: true
					},
					991 : {
						nav : false,
						dots: true

					},
					1300: {
						nav : true,
						dots: true
					}
				}
			}).on('translated.owl.carousel', function (event) {

				$('.owl-nav-list li.active').removeClass('active');
				$('.owl-nav-list li:eq(' + event.page.index + ')').addClass('active');

			}).on('changed.owl.carousel', function (event) {

				// future enhancement

			});

			$('.owl-nav-list li').click(function () {
				var slide_index = $(this).index();

				owl.trigger("to.owl.carousel", [ slide_index, 300 ]);
				return false;
			})

		}
	},
	initSearchForm: function ($) {
		$('#search-top-bar-submit').on('click', function (e) {
			e.preventDefault();
			$('#search-field-top-bar').toggleClass('opened');
		});
	},
	initGoToTop   : function ($) {

		var offset = 300,
				offset_opacity = 1200,
				scroll_top_duration = 700,
				$back_to_top = $('#back-to-top');
		jQuery(window).scroll(function () {
			( jQuery(this).scrollTop() > offset ) ? $back_to_top.addClass('back-to-top-is-visible') : $back_to_top.removeClass('back-to-top-is-visible back-to-top-fade-out');
			if ( jQuery(this).scrollTop() > offset_opacity ) {
				$back_to_top.addClass('back-to-top-fade-out');
			}
		});
		$back_to_top.on('click', function (event) {
			event.preventDefault();
			jQuery('body,html').animate({
						scrollTop: 0
					}, scroll_top_duration
			);
		});
	},
};