/**
 * File epsilon.js.
 *
 *
 * Epsilon Framework
 */

(function ($) {
	var EpsilonFramework = {};

	EpsilonFramework.rangeSliders = function (selector) {
		var context = $(selector),
				slider = context.find('.ss-slider'),
				input = context.find('.rl-slider'),
				input_id = input.attr('id'),
				id = slider.attr('id'),
				min = $('#' + id).attr('data-attr-min'),
				max = $('#' + id).attr('data-attr-max'),
				step = $('#' + id).attr('data-attr-step');

		$('#' + id).slider({
			value: $('#' + input_id).attr('value'),
			range: 'min',
			min  : parseFloat(min),
			max  : parseFloat(max),
			step : parseFloat(step),
			slide: function (event, ui) {
				$('#' + input_id).attr('value', ui.value).change();
			}
		});

		$('#' + input_id).attr('value', ($('#' + id).slider("value")));
		$('#' + input_id).change(function () {
			$('#' + id).slider({
				value: $(this).val()
			});
		});
	};

	EpsilonFramework.typography = {
		/**
		 * Selectize instance
		 */
		_selectize: null,

		/**
		 * Initiate function
		 * @private
		 */
		_init: function (selector) {
			if ( selector.length ) {
				var self = this;
				/**
				 * Reset button
				 */
				$('.mte-typography-default').on('click', function (e) {
					e.preventDefault();
					var element = $(this);
					EpsilonFramework.typography._resetDefault(element);
				});

				$.each(selector, function () {
					var container = $(this),
							uniqueId = container.attr('data-unique-id'),
							selects = container.find('select'),
							numbers = $('.mte-number-field'),
							inputs = container.find('.mte-typography-input');

					/**
					 * Instantiate the selectize javascript plugin
					 * and the input type number
					 */
					try {
						self._selectize = selects.selectize();
						$.each(numbers, function () {
							EpsilonFramework.typography._number($(this));
						});
					}
					catch ( err ) {
						/**
						 * In case the selectize plugin is not loaded, raise an error
						 */
						console.warn('selectize not yet loaded');
					}

					/**
					 * Add/subtract from the input type number fields
					 */
					$('.incrementor').on('click', function (e) {
						e.preventDefault();
						EpsilonFramework.typography._calcValue($(this));
					});

					/**
					 * Don't allow a value smaller than 0 in number fields
					 */
					numbers.find('input').on('change', function () {
						if ( $(this).val() < 0 ) {
							$(this).val(0).trigger('change');
						}
					});

					/**
					 * On triggering the change event, create a json with the values and send it to the preview window
					 */
					inputs.on('change', function () {
						var val = EpsilonFramework.typography._parseJson(inputs, uniqueId);
						$('#hidden_input_' + uniqueId).val(val).trigger('change');
					});
				});
			}
		},

		/**
		 * Reset defaults
		 *
		 * @param element
		 * @private
		 */
		_resetDefault: function (element) {
			var container = $(element).parent(),
					uniqueId = container.attr('data-unique-id'),
					selects = container.find('select'),
					inputs = container.find('inputs');

			var fontFamily = selects[ 0 ].selectize,
					fontWeight = selects[ 1 ].selectize,
					fontStyle = selects[ 2 ].selectize;

			var object = {
						action: 'epsilon_generate_typography_css',
						id    : uniqueId,
						data  : {
							'selectors': $('#selectors_' + uniqueId).val(),
							'json'     : {}
						}
					},
					api = wp.customize;

			fontFamily.setValue('Select font');
			fontWeight.setValue('initial');
			fontStyle.setValue('initial');

			if ( $('#' + uniqueId + '-font-size').length ) {
				$('#' + uniqueId + '-font-size').val('15');
			}

			if ( $('#' + uniqueId + '-line-height').length ) {
				$('#' + uniqueId + '-line-height').val('22');
			}


			object.data.json[ 'font-family' ] = 'Select font';
			object.data.json[ 'font-weight' ] = 'initial';
			object.data.json[ 'font-style' ] = 'initial';
			object.data.json[ 'font-size' ] = '15';
			object.data.json[ 'line-height' ] = '22';

			api.previewer.send('update-inline-css', object);
		},

		/**
		 * parse/create the json and send it to the preview window
		 *
		 * @param inputs
		 * @param id
		 * @private
		 */
		_parseJson: function (inputs, id) {
			var object = {
						action: 'epsilon_generate_typography_css',
						id    : id,
						data  : {
							'selectors': $('#selectors_' + id).val(),
							'json'     : {}
						}
					},
					api = wp.customize;


			$.each(inputs, function (index, value) {
				var key = $(value).attr('id'),
						replace = id + '-';
				key = key.replace(replace, '');

				object.data[ 'json' ][ key ] = $(value).val();
			});

			api.previewer.send('update-inline-css', object);
			return JSON.stringify(object.data);
		},

		/**
		 * Initiate the Number fields
		 *
		 * @param el
		 * @private
		 */
		_number: function (el) {
			var input = el.find('input');

			el.append('<a href="#" class="arrow-up incrementor"  data-increment="up"><span class="dashicons dashicons-arrow-up"></span></a>' +
					'<a href="#" class="arrow-down incrementor" data-increment="down"><span class="dashicons dashicons-arrow-down"></span></a>');
		},

		/**
		 * Calculate the value of the input number fields
		 *
		 * @param el
		 * @private
		 */
		_calcValue: function (el) {
			var input = $(el.siblings('input'));
			switch ( $(el).attr('data-increment') ) {
				case 'up':
					input.val(parseInt(input.val()) + 1).trigger('change');
					break;
				case 'down':
					if ( input.val() == 0 ) {
						return;
					}
					input.val(parseInt(input.val()) - 1).trigger('change');
					break;
			}
		}
	};

	$(document).on('widget-updated widget-added', function (a, selector) {
		EpsilonFramework.rangeSliders(selector);
	});

	if ( typeof(wp) !== 'undefined' ) {
		if ( typeof(wp.customize) !== 'undefined' ) {
			wp.customize.bind('ready', function () {
				EpsilonFramework.typography._init($('.mte-typography-container'));
			});
		}
	}

})(jQuery);