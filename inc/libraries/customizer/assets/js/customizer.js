/**
 * File customizer.js.
 *
 */

(function ($) {
	jQuery(document).ready(function ($) {
		/**
		 * Bind an event for the add new widget
		 */
		$('.add-new-widget').on('click', function (event) {
			/**
			 * Define variables used in the script
			 * @type {any}
			 */
			var parent = $(this).parent(),
					id = parent.attr('id'),
					search = $('#widgets-search'),
					widgetList = $('#available-widgets-list').find('.widget-tpl');

			/**
			 * Reset the widget display state
			 */
			$.each(widgetList, function ($k, $v) {
				$(this).show();
			});

			/**
			 * Initiate a switch for the sidebars
			 */
			switch ( id ) {
					/**
					 * When we're in the slider, show only slider widget
					 */
        case 'customize-control-sidebars_widgets-homepage-slider':
					$.each(widgetList, function ($k, $v) {
						var individualId = $(this).attr('data-widget-id');
						if ( individualId.search('newsmag_slider_widget') == -1 ) {
							$(this).hide();
							search.attr('disabled', true);
						}
					});
					break;
					/**
					 * In content, show only builder item
					 */
				case 'customize-control-sidebars_widgets-content-area':
					$.each(widgetList, function ($k, $v) {
						var individualId = $(this).attr('data-widget-id');
						if ( individualId.search('newsmag_widget') == -1 ) {
							$(this).hide();
							search.attr('disabled', true);
						}
					});
					break;
					/**
					 * By default, hide those 2 specific widgets
					 */
				default:
					$.each(widgetList, function ($k, $v) {
						search.removeAttr('disabled');
						var individualId = $(this).attr('data-widget-id');
						if ( individualId.search('newsmag_widget') != -1 || individualId.search('newsmag_slider_widget') != -1) {
							$(this).hide();
						} else {
							$(this).show();
						}
					});
					break;
			}
		});
	});
})(jQuery);