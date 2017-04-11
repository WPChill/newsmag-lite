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
