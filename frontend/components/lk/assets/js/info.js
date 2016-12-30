/**
 * Created by kirsanov_av on 24.12.16.
 */
$("#lkorder-hotels_info_id").on("change", function () {
    $.ajax({
        type: "POST",
        url: "/lk/reservation/child-hotels-info",
        data: "hotels=" + $(this).val(),
        success: function (answer) {
            $("#lkorder-hotels-info-details").html(answer);
        }
    });
    console.log($(this).val());
});


jQuery(document).ready(function () {

    if (jQuery('#lkorder-country_id').data('select2')) {
        jQuery('#lkorder-country_id').select2('destroy');
    }
    jQuery.when(jQuery('#lkorder-country_id').select2(select2_4c9ca683)).done(initS2Loading('lkorder-country_id', 's2options_d6851687'));

    if (jQuery('#lkorder-city_id').data('depdrop')) {
        jQuery('#lkorder-city_id').depdrop('destroy');
    }
    jQuery('#lkorder-city_id').depdrop(depdrop_85e0c6e1);

    if (jQuery('#lkorder-city_id').data('select2')) {
        jQuery('#lkorder-city_id').select2('destroy');
    }
    jQuery.when(jQuery('#lkorder-city_id').select2(select2_b51eb68b)).done(initS2Loading('lkorder-city_id', 's2options_d6851687'));

    initDepdropS2('lkorder-city_id', 'Please wait, loading data ...');
    if (jQuery('#lkorder-hotels_info_id').data('depdrop')) {
        jQuery('#lkorder-hotels_info_id').depdrop('destroy');
    }
    jQuery('#lkorder-hotels_info_id').depdrop(depdrop_3ad7df02);

    if (jQuery('#lkorder-hotels_info_id').data('select2')) {
        jQuery('#lkorder-hotels_info_id').select2('destroy');
    }
    jQuery.when(jQuery('#lkorder-hotels_info_id').select2(select2_b51eb68b)).done(initS2Loading('lkorder-hotels_info_id', 's2options_d6851687'));

    initDepdropS2('lkorder-hotels_info_id', 'Please wait, loading data ...');
    if (jQuery('#lkorder-hotels_appartment_id').data('select2')) {
        jQuery('#lkorder-hotels_appartment_id').select2('destroy');
    }
    jQuery.when(jQuery('#lkorder-hotels_appartment_id').select2(select2_f8eb38eb)).done(initS2Loading('lkorder-hotels_appartment_id', 's2options_d6851687'));


});