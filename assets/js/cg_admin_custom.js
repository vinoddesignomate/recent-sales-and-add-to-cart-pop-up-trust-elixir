(function($){

    "use strict";
    
    $(function () {
        $("#tabs").tabs({
            activate: function (event, ui) {
                $("#tab_name").val(ui.newPanel[0].id);
            }
        });
    });
    })(jQuery);
    
    jQuery(document).ready(function ($) {
    
        jQuery(".headfontsize").on("keyup change", function (e) {
    
            jQuery(".popupMain h4").css({
                "font-size": jQuery(this).val()
            });
            // do stuff!
        })
    
        jQuery(".cfontsize").on("keyup change", function (e) {
    
            jQuery(".popupMain h5").css({
                "font-size": jQuery(this).val()
            });
            // do stuff!
        })
    
        jQuery("#poposition").on("change", function (e) {
    
            // alert(jQuery(this).val());
            if (jQuery(this).val() == "br") {
                jQuery(".popupMain").css({
                    "top": "auto",
                    "bottom": "20px",
                    "right": "20px",
                    "left": "auto"
                });
            }
            if (jQuery(this).val() == "tl") {
                jQuery(".popupMain").css({
                    "top": "20px",
                    "bottom": "auto",
                    "right": "auto",
                    "left": "20px"
                });
            }
            if (jQuery(this).val() == "tr") {
                jQuery(".popupMain").css({
                    "top": "20px",
                    "bottom": "auto",
                    "right": "20px",
                    "left": "auto"
                });
            }
            if (jQuery(this).val() == "bl") {
                jQuery(".popupMain").css({
                    "top": "auto",
                    "bottom": "20px",
                    "right": "auto",
                    "left": "20px"
                });
            }
            // do stuff!
        })
    
        // $('#mv_cr_section_color').wpColorPicker();
        var box = jQuery('.popupMain');
        jQuery('#color_code').iris({
            // or in the data-default-color attribute on the input
            defaultColor: true,
            // a callback to fire whenever the color changes to a valid color
            // callback to fire when the input is emptied or an invalid color
            clear: function () { },
            // hide the color picker controls on load
            hide: true,
            // show a group of common colors beneath the square
            palettes: true,
            change: function (event, ui) {
                box.css("background", ui.color.toString());
                //ssalert( jQuery(this).val());
            } //
            // a
        });
    
        //$('#color_code').wpColorPicker(myOptions);
    
        var headcolor = jQuery('.popupMain h4');
        jQuery('#fcolor_code').iris({
            // or in the data-default-color attribute on the input
            defaultColor: true,
            // a callback to fire whenever the color changes to a valid color
            change: function (event, ui) {
                headcolor.css("color", ui.color.toString());
    
            },
            // a callback to fire when the input is emptied or an invalid color
            clear: function () { },
            // hide the color picker controls on load
            hide: true,
            // show a group of common colors beneath the square
            palettes: true
        });
    
        var contentcolor = jQuery('.popupMain h5');
        jQuery('#cf_color_code').iris({
            // or in the data-default-color attribute on the input
            defaultColor: true,
            // a callback to fire whenever the color changes to a valid color
            change: function (event, ui) {
                contentcolor.css("color", ui.color.toString());
    
            },
            // a callback to fire when the input is emptied or an invalid color
            clear: function () { },
            // hide the color picker controls on load
            hide: true,
            // show a group of common colors beneath the square
            palettes: true
        });
    
        $('.color-picker').iris();
        $(document).click(function (e) {
            if (!$(e.target).is(".color-picker, .iris-picker, .iris-picker-inner")) {
                $('.color-picker').iris('hide');
                //return false;
            }
        });
        $('.color-picker').click(function (event) {
            $('.color-picker').iris('hide');
            $(this).iris('show');
            return false;
        });
    
        $("input[name=popup_template]:radio").click(function () {
    
            var sel_img = $(this).attr("data-img");
            var sel_color = $(this).attr("data-color");
            $(".popup_back").css('background-image', 'url(' + sel_img + ')');
            $(".hfcls").css('color', '#' + sel_color);
            $(".hficls").css('color', '#' + sel_color);
            $("#fcolor_code").val("#" + sel_color);
            $("#cf_color_code").val("#" + sel_color);
    
    
        });
    
        $("input[name=popup_close_icon]:radio").click(function () {
    
            var icongetval = $(this).val();
            if (icongetval == 'on') {
                $(".cancelBTN").show();
            } else {
                $(".cancelBTN").hide();
            }
    
        });
    
    
        $('.popup_effect_class').attr('data-sattest_display', '');
        $('.popup_effect_class').attr('data-sattest_hidden', '');
    
        $("#message_display_effect").change(function () {
            var selval = $(this).val();
            $(".popup_effect_class").attr('data-sattest_display', selval);
        });
    
        $("#message_hide_effect").change(function () {
            var selval = $(this).val();
            $(".popup_effect_class").attr('data-sattest_hidden', selval);
        });
    
        $("#get_product_type").change(function () {
            var get_val = $(this).val();
    
            show_product_type(get_val);
        });
    
        $("input[name=rounded_corner]:radio").click(function () {
            var getval = $(this).val();
            if (getval == 'on') {
                //product_image
                //
                $(".product_image").css('border-radius', '14px 0px 0px 14px');
                $(".template_image").css('border-radius', '0px 14px 14px 0px');
    
            } else {
                $(".product_image").css('border-radius', '0px 0px 0px 0px');
                $(".template_image").css('border-radius', '0px 0px 0px 0px');
            }
        });
    
        $("#predef_filter").change(function () {
            var filter_val = $(this).val();
            show_hide_filter(filter_val)
            // if(filter_val == 'custom')
            // {
            // 	$(".custom_filter").show();
    
            // }
            // else
            // {
            // 	$(".custom_filter").hide();
            // }
    
        });
    
        $('#search_filter').click(function (e) {
    
            var predef_filter = $('#predef_filter').val();
            var fromdatefilter = "";
            if (predef_filter == 'custom') {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (from_date != "" && to_date != "") {
                    fromdatefilter = "&fromdate=" + from_date + "&todate=" + to_date;
                }
    
            }
    
            window.location.href = admin_url + "/wp-admin/admin.php?page=trust-elixir&status=1&filterby=" + predef_filter + fromdatefilter + "#report";
    
        });
        $('.datepick').datetimepicker({
            format: 'Y-m-d',
            formatDate: 'Y-m-d',
            timepicker: false,
            maxDate: new Date()
        });
    
        jQuery('#cls_color_code').iris({
            change: function (event, ui) {
                var colorcode = ui.color.toString();
                $(".cancelBTN").css('color', colorcode);
    
            }
        });
    });
    
    
    
    