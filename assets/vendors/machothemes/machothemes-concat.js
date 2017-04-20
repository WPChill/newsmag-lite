/*
  MachoThemes Object
 */
if ( typeof(MachoThemes) === 'undefined' ) {
	var MachoThemes = {};
}

MachoThemes.initAdsenseLoader = function ($) {
	var selector = $('.newsmag-adsense');
	if ( selector.length ) {
		// jQuery
		selector.adsenseLoader({
			onLoad: function ($ad) {
				$ad.addClass('adsense--loaded');
			}
		});
	}
};
MachoThemes.initBlazyLoad = function ($) {
	setTimeout(function(){
		var selector = new Blazy({
			selector: '.blazy',
			offset  : 250
		});
	}, 500);
};
MachoThemes.initGoToTop = function ($) {
	var offset = 300,
			scroll_top_duration = 700,
			$back_to_top = $('#back-to-top');
	jQuery(window).scroll(function () {
		( jQuery(this).scrollTop() > offset ) ? $back_to_top.addClass('back-to-top-is-visible') : $back_to_top.removeClass('back-to-top-is-visible');
	});
	$back_to_top.on('click', function (event) {
		event.preventDefault();
		jQuery('body,html').animate({
					scrollTop: 0
				}, scroll_top_duration
		);
	});
};
MachoThemes.initMainSlider = function ($) {
	var owl = $('.newsmag-slider');
	if ( owl.length ) {

		owl.on('initialized.owl.carousel', function () {
			$('.owl-nav-list').addClass('active');
		});

		owl.owlCarousel({
			loop           : true,
			items          : 1,
			dots           : false,
			mouseDrag      : true,
			navText        : '',
			// navText     : [ "<i class='nmicon-angle-left'></i>", "<i class='nmicon-angle-right'></i>" ],
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
};
MachoThemes.initMTNavigation = function ($) {
	/**
	 * Calculate the width of an element
	 *
	 * @param element
	 * @returns {*}
	 * @constructor
	 */
	var MTcalcWidth = function (element) {
		return element.width();
	};

	/**
	 *
	 * @type {number}
	 */
	var toggled = 0;

	/**
	 * Check the resize direction ( LEFT OR RIGHT )
	 *
	 * @param ref
	 * @param current
	 * @returns {*}
	 * @constructor
	 */
	var MTCheckResize = function (ref, current) {
		var result;

		if ( ref == current ) {
			return false;
		}

		if ( ref < current ) {
			result = 'right';
		} else {
			result = 'left';
		}

		windowWidth = current;
		return result;

	};
	/**
	 * Look for an already created list in the container, if there is none - create it and return it
	 *
	 * @param initiated
	 * @param container
	 * @returns {jQuery}
	 * @constructor
	 */
	var MTCreateList = function (container) {
		var hiddenList = $(container).find('.mt-navigation-hidden');
		if ( !hiddenList.length ) {
			$(container).append('<li class="mt-navigation-holder"><a href="#" class="mt-navigation-opener"></a><ul class="mt-navigation-hidden"></ul></li>');
			hiddenList = $(container).find('.mt-navigation-hidden');
		}

		$(container).trigger('MTNavigationHolderCreated', [ 'MTNavigationHolderCreated', 'Event' ]);

		return hiddenList;
	};

	/**
	 * Add items to the list
	 *
	 * @param data
	 * @constructor
	 */
	var MTAddItemsToList = function (data) {
		var items = data.hiddenItems,
				list = data.hiddenList;

		$.each(items, function () {
			$(this).detach().appendTo(list);
		});
	};

	/**
	 * Calculations, returns an object containing the items that need to be placed in the other list
	 *
	 * @param direction
	 * @param selector
	 * @returns {{action: boolean, perRow: number, hiddenItems: (Buffer|ArrayBuffer|Array.<T>|Blob|string|*), allItems:
	 *     (*|jQuery), notHidden: (Buffer|ArrayBuffer|Array.<T>|Blob|string|*), container: *}}
	 * @constructor
	 */
	var MTComputedStats = function (selector, direction) {
		var containerWidth = MTcalcWidth(selector.parents('.col-md-12')),
				listItems = $(selector).find('li').not('.mt-navigation-holder'),
				elementWidth = MTcalcWidth(listItems),
				allElements = $(selector).find('li').not('.mt-navigation-holder').length,
				perRow = Math.floor(containerWidth / elementWidth),
				maxPerRow = perRow - 2,
				hideThis = allElements - maxPerRow,
				hiddenItems = listItems.slice(-hideThis);

		var object = {
			action     : true,
			perRow     : maxPerRow,
			hiddenItems: hiddenItems,
			allItems   : listItems,
			notHidden  : listItems.slice(0, maxPerRow),
			container  : selector
		};

		if ( direction === 'right' ) {
			object.hiddenItems = listItems.slice(-(allElements - object.notHidden.length));
		}

		if ( perRow > allElements ) {
			object.action = false;
		}

		if ( object.action ) {
			object.hiddenList = MTCreateList(selector);
		}

		return object;
	};

	/**
	 * Initiate the script here, we define the selector and start the calculations
	 * @type {any}
	 */
	var menu = $('#menu-social-items'),
			pluginObject = MTComputedStats(menu),
			windowWidth = $(window).width();

	/**
	 * Start adding items to the list
	 */
	if ( pluginObject.action ) {
		MTAddItemsToList(pluginObject);
	}

	/**
	 * List toggle functionality
	 */
	var toggler = $('.mt-navigation-opener');
	toggler.addClass('mt-navigation-initiated');
	toggler.on('click', function (e) {
		e.preventDefault();
		$(this).next('ul').toggleClass('opened');
	});

	$(menu).on('MTNavigationHolderCreated', function () {
		toggler = $('.mt-navigation-opener');

		if ( toggler.hasClass('mt-navigation-initiated') ) {
			return false;
		}
		toggler.addClass('mt-navigation-initiated');
		toggler.on('click', function (e) {
			e.preventDefault();
			$(this).next('ul').toggleClass('opened');
		});
	});

	/**
	 * Close menu on click
	 */
	$(document).on('click', function (e) {
		var menuToggled = $('.mt-navigation-opener').next('ul');

		if ( menuToggled.hasClass('opened') ) {
			toggled++;
		}

		if ( !menuToggled.is(e.target) ) {
			if ( toggled > 1 ) {
				menuToggled.removeClass('opened');
				toggled = 0;
			}
		}
	});

	/**
	 * Window resize handling
	 */
	$(window).on('resize', function () {
		clearTimeout(window.MTresizedFinished);
		window.MTresizedFinished = setTimeout(function () {
			var resizedWindow = $(window).width(),
					direction = MTCheckResize(windowWidth, resizedWindow),
					newData;

			switch ( direction ) {
				case 'left':
					newData = MTComputedStats(menu);
					if ( newData.action ) {
						MTAddItemsToList(newData);
					}

					break;
				case 'right':
					newData = MTComputedStats(menu, direction);

					if ( !newData.action ) {
						$(menu).find('.mt-navigation-holder > ul').children().detach().appendTo(menu);
						$(menu).find('.mt-navigation-holder').remove();
					} else {
						var toggler = $(menu).find('.mt-navigation-holder');
						$.each(newData.notHidden, function () {
							if ( $(this).parent().hasClass('mt-navigation-hidden') ) {
								$(this).detach().insertBefore(toggler);
							}
						});
					}
					break;
			}
		}, 50);
	});
};

MachoThemes.initOffscreen = function ($) {
	$('.sub-menu').on('hover', function () {
		$(this).find('.sub-menu').offscreen({
			rightClass : 'right-edge',
			widthOffset: 40, //px value
			smartResize: true
		});
	});
};
MachoThemes.initPlyr = function ($) {
	plyr.setup('.plyr');
};
MachoThemes.initPreloader = function ($) {
	// Page loader
	$(window).load(function () {
		var context = $('.page-loader'),
				effect = context.attr('data-effect');

		switch ( effect ) {
			case 'slide':
				context.find('div').delay(0).slideUp();
				context.delay(200).slideUp("slow");
				break;
			default:
				context.find('div').delay(0).fadeOut();
				context.delay(200).fadeOut("slow");
				break;
		}
	});
};
MachoThemes.initSearchForm = function ($) {
	var element = $('.header-search-form'),
			input = $('#search-field-top-bar'),
			inputSubmit = $('#search-top-bar-submit'),
			trigger = $('.search-form-opener');

	trigger.on('click', function (e) {
		e.preventDefault();
		trigger.toggleClass('hide');
		element.toggleClass('opened');
		setTimeout(function () {
			input.focus();
		}, 300);
		if ( input.val() !== '' ) {
			inputSubmit.addClass('submit-button').removeClass('close-button');
			inputSubmit.html('<span class="nmicon-search"></span>');
		}
	});

	input.on('keyup', function () {
		if ( $(this).val() !== '' ) {
			inputSubmit.addClass('submit-button').removeClass('close-button');
			inputSubmit.html('<span class="nmicon-search"></span>');
		} else {
			inputSubmit.addClass('close-button').removeClass('submit-button');
			inputSubmit.html('<span class="first-bar"></span><span class="second-bar"></span>');
		}
	});

	inputSubmit.on('click', function () {
		if ( $(this).hasClass('submit-button') ) {
			$(this).parent().submit();
		} else {
			trigger.toggleClass('hide');
			element.toggleClass('opened');
		}
	});
};

MachoThemes.initStickyMenu = function ($) {
	var selector = $('.stick-menu'),
			container = selector.find('.stick-menu-logo'),
			img = container.find('img'),
			lists = selector.find('.nav-menu > li'),
			width = 0,
			maxWidth = container.parents('.container').outerWidth() - 200;

	$.each(lists, function () {
		width += $(this).outerWidth();
	});

	if ( selector.length ) {
		var window_w = jQuery(window).width();
		if ( window_w > 768 ) {
			selector.sticky();

			if ( width >= maxWidth ) {
				return false;
			}

			selector.on('sticky-start', function () {
				img.animate({ width: '100%' });
				container.animate({ 'margin-right': '60px' });
			});

			selector.on('sticky-end', function () {
				img.animate({ width: 0 });
				container.animate({ 'margin-right': '0' });
			});
		}

		$(window).resize(function () {
			window_w = $(window).width();
			if ( window_w < 768 ) {
				selector.unstick();
			} else {
				selector.sticky();
			}
		});
	}
};
MachoThemes.initStyleSelects = function ($) {
	var selects = $('select');
	$.each(selects, function () {
		if ( $(this).parent().hasClass('styled-select') ) {
			return false;
		}

		$(this).wrap('<div class="styled-select"></div>');
	});
};
MachoThemes.init = function ($) {
	function getOwnMethods(obj) {
		var props = Object.getOwnPropertyNames(obj);
		return props.filter(function (prop) {
			return obj[ prop ] && obj[ prop ].constructor &&
					obj[ prop ].call && obj[ prop ].apply;
		});
	}

	var methods = getOwnMethods(MachoThemes);
	methods.pop();

	$.each(methods, function () {
		var init = this;
		if ( typeof(MachoThemes[ init ]) === 'function' ) {
			MachoThemes[ init ]($);
		}
	});
};