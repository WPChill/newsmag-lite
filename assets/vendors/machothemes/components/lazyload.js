if ( typeof(MachoThemes) === 'undefined' ) {
	var MachoThemes = {};
}

MachoThemes.initLazyLoad = function ($) {
	$(".lazy").lazyload({
		effect        : "fadeIn",
		skip_invisible: false
	});
};