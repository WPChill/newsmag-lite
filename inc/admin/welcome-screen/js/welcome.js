jQuery(document).ready(function () {

    /* If there are required actions, add an icon with the number of required actions in the About newsmag page -> Actions required tab */
    var newsmag_nr_actions_required = newsmagWelcomeScreenObject.nr_actions_required;

    if ((typeof newsmag_nr_actions_required !== 'undefined') && (newsmag_nr_actions_required != '0')) {
        jQuery('li.newsmag-w-red-tab a').append('<span class="newsmag-actions-count">' + newsmag_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".newsmag-dismiss-required-action").click(function () {

        var id = jQuery(this).attr('id');
        console.log(id);
        jQuery.ajax({
            type: "GET",
            data: {action: 'newsmag_dismiss_required_action', dismiss_id: id},
            dataType: "html",
            url: newsmagWelcomeScreenObject.ajaxurl,
            beforeSend: function (data, settings) {
                jQuery('.newsmag-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + newsmagWelcomeScreenObject.template_directory + '/inc/admin/welcome-screen/img/ajax-loader.gif" /></div>');
            },
            success: function (data) {
                jQuery("#temp_load").remove();
                /* Remove loading gif */
                jQuery('#' + data).parent().remove();
                /* Remove required action box */

                var newsmag_actions_count = jQuery('.newsmag-actions-count').text();
                /* Decrease or remove the counter for required actions */
                if (typeof newsmag_actions_count !== 'undefined') {
                    if (newsmag_actions_count == '1') {
                        jQuery('.newsmag-actions-count').remove();
                        jQuery('.newsmag-tab-pane#actions_required').append('<p>' + newsmagWelcomeScreenObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.newsmag-actions-count').text(parseInt(newsmag_actions_count) - 1);
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });

    /* Tabs in welcome page */
    function newsmag_welcome_page_tabs(event) {
        if(jQuery(event).hasClass('newsmag-delegate')){
            jQuery('*[href="'+jQuery(event).attr('href')+'"]').parent().addClass("active");
            jQuery('*[href="'+jQuery(event).attr('href')+'"]').parent().siblings().removeClass("active");
        } else {
            jQuery(event).parent().addClass("active");
            jQuery(event).parent().siblings().removeClass("active");
        }

        var tab = jQuery(event).attr("href");
        jQuery(".newsmag-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
    }

    var newsmag_actions_anchor = location.hash;

    if ((typeof newsmag_actions_anchor !== 'undefined') && (newsmag_actions_anchor != '')) {
        newsmag_welcome_page_tabs('a[href="' + newsmag_actions_anchor + '"]');
    }

    jQuery(".newsmag-nav-tabs a, a.newsmag-delegate").click(function (event) {
        event.preventDefault();
        newsmag_welcome_page_tabs(this);
    });

    /* Tab Content height matches admin menu height for scrolling purpouses */
    $tab = jQuery('.newsmag-tab-content > div');
    $admin_menu_height = jQuery('#adminmenu').height();
    if ((typeof $tab !== 'undefined') && (typeof $admin_menu_height !== 'undefined')) {
        $newheight = $admin_menu_height - 180;
        $tab.css('min-height', $newheight);
    }

});
