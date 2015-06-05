$(document).ready(function (e) {
    $('h1.section-header').on('click', function () {
        if ($(this).children('div').hasClass('arrow')) {
            $(this).find('.arrow').toggleClass('colapse');
            $(this).siblings('.content').slideToggle();
        }
    });
    if ($('h1.section-header').children('div').hasClass('arrow')) {
        $('h1.section-header').css('cursor', 'pointer');
    }
    $('#content').click(function () {
        $('#sub-menu').slideUp();
    });

    $('#resetValue').click(function () {
        window.location = "/submission/List";
    });
    $('#reserQcValue').click(function () {
        window.location = "/submission/QCList";
    });
    $('#resetInsuredValue').click(function () {
        window.location = "/admin/insured";
    });
    $('#resetBrokerValue').click(function () {
        window.location = "/admin/broker";
    });
    $('#resetContactPersonValue').click(function () {
        window.location = "/admin/contactperson";
    });
    $('#resetReferenceValue').click(function () {
        window.location = "/admin/renewalreference";
    });
    $('#resetpolicyNumberValue').click(function () {
        window.location = "/policy/PolicyList";
    });
    $('#resetUnderwriterValue').click(function () {
        window.location = "/admin/underwriter";
    });
    $('#resetCountryValue').click(function () {
        window.location = "/admin/country";
    });
    $('#resetStateValue').click(function () {
        window.location = "/admin/state";
    });
    $('#resetCityValue').click(function () {
        window.location = "/admin/city";
    });
    
    //$('#state-list-wrapper').jScrollPane();
    //$('#city-list-wrapper').jScrollPane();
    //$('#underwriter-list-wrapper').jScrollPane();
    //$('#broker-list-wrapper').jScrollPane();
    //$('#insured-list-wrapper').jScrollPane();
    //$('#contactPerson-list-wrapper').jScrollPane();
    //$('#renewal-list-wrapper').jScrollPane();
    //$('#policy-list-wrapper').jScrollPane();


});
