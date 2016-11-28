if ( typeof(MachoThemes) === 'undefined' ) {
	var MachoThemes = {};
}

MachoThemes.init = function ($) {
	var object = {
		gotop        : 'initGoToTop',
		searchform   : 'initSearchForm',
		mainslider   : 'initMainSlider',
		lazyload     : 'initLazyLoad',
		stickymenu   : 'initStickyMenu',
		adsenseloader: 'initAdsenseLoader',
		styleselects : 'initStyleSelects',
		offscreen    : 'initOffscreen',
		newsticker   : 'initNewsTicker',
		owlcarousel  : 'initOwlCarousel'
	};

	$.each(object, function () {
		var init = this;
		if ( typeof(MachoThemes[ init ]) === 'function' ) {
			MachoThemes[ init ]($);
		}
	});
};