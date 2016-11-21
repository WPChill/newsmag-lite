jQuery(document).ready(function () {

	/* If there are required actions, add an icon with the number of required actions in the About newsmag page -> Actions required tab */
	var newsmag_nr_actions_required = newsmagWelcomeScreenObject.nr_actions_required;

	if ( (typeof newsmag_nr_actions_required !== 'undefined') && (newsmag_nr_actions_required != '0') ) {
		jQuery('li.newsmag-w-red-tab a').append('<span class="newsmag-actions-count">' + newsmag_nr_actions_required + '</span>');
	}

	/* Dismiss required actions */
	jQuery(".newsmag-required-action-button").click(function () {

		var id = jQuery(this).attr('id'),
				action = jQuery(this).attr('data-action');
		jQuery.ajax({
			type      : "GET",
			data      : { action: 'newsmag_dismiss_required_action', id: id, todo: action },
			dataType  : "html",
			url       : newsmagWelcomeScreenObject.ajaxurl,
			beforeSend: function (data, settings) {
				jQuery('.newsmag-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + newsmagWelcomeScreenObject.template_directory + '/inc/admin/welcome-screen/img/ajax-loader.gif" /></div>');
			},
			success   : function (data) {
				location.reload();
				jQuery("#temp_load").remove();
				/* Remove loading gif */
			},
			error     : function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}
		});
	});
});
