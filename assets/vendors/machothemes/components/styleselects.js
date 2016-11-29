if ( typeof(MachoThemes) === 'undefined' ) {
	var MachoThemes = {};
}

MachoThemes.initStyleSelects = function ($) {
	var selects = $('.widget select');
	$.each(selects, function () {
		$(this).wrap('<div class="styled-select"></div>');
	});
};