(function ($) {

    "use strict";
    $(document).ready(function () {
        setTimeout(function () {
            if (cg_popupshow == 'show') {
                $(".popup_effect_class").attr('data-sattest_display', cg_popup_effect);
                $(".popupMain").slideDown(800);
                $(".popupMain").css({
                    "visibility": "visible",
                    "opacity": "1"
                });
            }

        }, cg_popup_delay_time + '000'); // 5000 to load it after 5 seconds from page load  

        //close popup autometically


        setTimeout(function () {

            if (cg_popupshow == 'show') {
                $(".popup_effect_class").attr('data-sattest_hidden', cg_popup_hide_effect);
                $(".popupMain").css({
                    "visibility": "none",
                    "opacity": "0"
                });
            }
        }, cg_p_hide_time + '000');

        $(".cancelBTN").click(function () {

            $(".popup_effect_class").attr('data-sattest_hidden', cg_popup_hide_effect);
            $(".popupMain").css({
                "visibility": "none",
                "opacity": "0"
            });


        });
    });
})(jQuery);