/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
	$(document).ready(function () {
		if ( 'undefined' === typeof wp || !wp.customize || !wp.customize.selectiveRefresh ) {
			return;
		}

		wp.customize.selectiveRefresh.bind('widget-updated', function (placement) {
			switch ( placement.widgetIdParts.idBase ) {
				case 'newsmag_slider_widget':
					MachoThemes.initMainSlider($);
					break;
			}
			MachoThemes.initBlazyLoad($);
			MachoThemes.initStyleSelects($);
		});
	});
})(jQuery);