/*Renewable yes/no validation*/
$(document).ready(function (e) {
$.validator.setDefaults({
        ignore: []
    });
    var sectionval = $('#sectionCodeHidden').val();
    if (($('#productLineHidden').val() == 'Property' && $('#productLineSubTypeHidden').val() == 3) || ($('#productLineHidden').val() == 'Casualty' && $('#productLineSubTypeHidden').val() == 11 && (sectionval == 616 || sectionval == 617 || sectionval == 618 || sectionval == 619 || sectionval == 620)) || ($('#productLineHidden').val() == 'Program') || ($('#productLineHidden').val() == 'Home Owners')) {
        var option_no = $('<option></option>').attr("value", "143").text("No");
        $("#editamendmentrenewable").empty().append(option_no);

    } else {
        var option_yes = $('<option></option>').attr("value", "142").text("Yes");
        $("#editamendmentrenewable").empty().append(option_yes);
    }
    var ed = $('#effective_date').val();
    var expd = $('#expiration_date').val();
    $('#processdate').datepicker({
        minDate: $('#originaleffectivedate').val(),
       // maxDate: expd,
        showTime: true,
        dateFormat: 'mm/dd/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "1980:2040",
        onSelect: function () {
            $(this).valid();
        }
    });
    if ($("#gross_premium").val() !== "0" && $('#hiddenyesGross').val() =='1') {
        $("#gross_premium_values").toggleClass('dp-block');
        $("#gross_premium_value").toggleClass('dp-none');
    }
    if ($("#limit_select").val() !== "0" && $('#hiddenyesLimit').val() == '1') {
        $("#limit_values").toggleClass('dp-block');
        $("#limit_value").toggleClass('dp-none');
    }
    if ($("#attachment_point_select").val() !== "0" && $('#hiddenyesAttachment').val() =='1') {
        $("#attachment_values").toggleClass('dp-block');
        $("#attachment_value").toggleClass('dp-none');
    }
});
