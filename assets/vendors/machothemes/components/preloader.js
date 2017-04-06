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