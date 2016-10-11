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
				id = slider.attr('id');

		$('#' + id).slider({
			value: $('#' + input_id).attr('value'),
			range: 'min',
			min  : 2,
			max  : 10,
			step : 2,
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

	$(document).on('widget-updated widget-added', function (a, selector) {
		EpsilonFramework.rangeSliders(selector);
	});

})(jQuery);