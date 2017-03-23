jQuery(document).ready(function () {
    var newsmag_aboutpage = newsmagWelcomeScreenCustomizerObject.aboutpage;
    var newsmag_nr_actions_required = newsmagWelcomeScreenCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof newsmag_aboutpage !== 'undefined') && (typeof newsmag_nr_actions_required !== 'undefined') && (newsmag_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + newsmag_aboutpage + '"><span class="newsmag-actions-count">' + newsmag_nr_actions_required + '</span></a>');
    }


});
