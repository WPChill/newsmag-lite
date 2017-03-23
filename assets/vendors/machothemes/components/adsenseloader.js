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