$(document).ready(function () {
    $('#underwriter').blur(function (ev) {
        var str = $(this).val().toLowerCase().replace(/\b[a-z]/g, function (letter) {
            return letter.toUpperCase();
        });
        var string = $.trim(str);
        var finalstring = string.replace(/\s+/g, " ");
        $(this).val(finalstring);
    });
    /****************************************************************************************************/
    $.validator.addMethod("checkName", function (value, element, params) {
        var x = value;
        if (x == 0) {
            return false;
        } else {
            return true;
        }
    });
    $.validator.addMethod(
            "regex",
            function (value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
            );
    $.validator.addMethod("checkSubType", function (value, element, params) {
        if ($('#productline').length > 0) {
            var prodline = $('#productline').val();
        } else
            var prodline = $('#editproductline').val();
        var x = value;
        if (x == 0 && prodline == 3) {
            return false;
        } else {
            return true;
        }
    });
    /****************************************************************************************************/
    $('#underwriterAddForm').validate({
        rules: {
            underwriter: {required: true, regex: "^[A-Za-z'. ]+([A-Za-z']+)*$"},
            branchoffice: {required: true, checkName: $('#branchoffice').val()},
            productline: {required: true, checkName: $('#productline').val()},
            productLineSubType: {checkSubType: $('#productLineSubType').val()}
        },
        messages: {
            underwriter: '<br />Please enter a valid value of underwriter name',
            branchoffice: '<br />Please select a valid value of branch office',
            productline: '<br />Please select a valid value of product line',
            productLineSubType: '<br />Please select a valid product line subtype', checkSubType: '<br />Please select a valid product line subtype',
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });
    /****************************************************************************************************/
    $('#underwriterEditForm').validate({
        rules: {
            editunderwritername: {required: true, regex: "^[A-Za-z'.]+( [A-Za-z']+)*$"},
            editbranchoffice: {required: true, checkName: $('#editbranchoffice').val()},
            editproductline: {required: true, checkName: $('#editproductline').val()},
            productLineSubType: {checkSubType: $('#productLineSubType').val()}
        },
        messages: {
            editunderwritername: '<br />Please enter a valid value of underwriter name',
            editbranchoffice: '<br />Please select a valid value of branch office',
            editproductline: '<br />Please select a valid value of product line',
            productLineSubType: '<br />Please select a valid product line subtype'
        },
        highlight: function (element) {
            $(element).addClass('error');
        },
        unhighlight: function (element) {
            $(element).removeClass('error');
        }
    });
    /****************************************************************************************************/
    $(function () {
        $(document).click(function (e) {
            var container = $(".dropdown");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.removeClass("is-active");
            }
        });
        $(".dropdown").click(function () {
            var prodline = '';
            if ($('#productline').length > 0) {
                prodline = $('#productline').val();
            } else {
                prodline = $('#editproductline').val();
            }
            $(this).toggleClass("is-active");
            if (prodline != 3) {
                $(".dropdown").removeClass("is-active");
                return false;
            }
        });
        $(".dropdown ul").click(function (e) {
            e.stopPropagation();
        });
    });
    $('#selectAllCompany').click(function (event) {
        if (this.checked) {
            $('.checkProductLineSubType').each(function () {
                this.checked = true;
            });
            getCabCompany();
        } else {
            $('.checkProductLineSubType').each(function () {
                this.checked = false;
            });
            $("#productLineSubType").val('');
        }
    });
    $('.checkProductLineSubType').click(function (event) {
        getCabCompany();
        var numofcheck = $('.checkProductLineSubType:checked').length;
        var numoflob = $('.checkProductLineSubType').length;
        if (numofcheck == numoflob) {
            $('#selectAllCompany').prop('checked', 'checked');
        } else {
            $('#selectAllCompany').prop('checked', '');
        }
    });

    function getCabCompany() {
        var brancharray = new Array();
        var i = 0;
        $('.checkProductLineSubType').each(function (event) {
            if (this.checked) {
                brancharray[i] = $(this).val();
                i = i + 1;
            }
        });
        var productLineSubTypes = brancharray.toString();
        $("#productLineSubType").val(productLineSubTypes.split(/[,]+/).filter(function (v) {
            return v !== '';
        }).join(' & '));
    }
    var numofcheck = $('.checkProductLineSubType:checked').length;
    var numoflob = $('.checkProductLineSubType').length;
    if (numofcheck == numoflob) {
        $('#selectAllCompany').prop('checked', 'checked');
    } else {
        $('#selectAllCompany').prop('checked', '');
    }
    if (document.getElementById("productline")) {
        $('#productline').change(function () {
            var val = $(this).val();
            if (val != 3) {
                $('.checkProductLineSubType').each(function () {
                    this.checked = false;
                });
                $("#productLineSubType").val('');
                $('#selectAllCompany').prop('checked', '');
            } else {
                $('.checkProductLineSubType').each(function () {
                    this.checked = true;
                });
                $('#selectAllCompany').prop('checked', 'checked');
                getCabCompany();
            }
        });
    }

    if (document.getElementById("editproductline")) {
        $('#editproductline').change(function () {
            var val = $(this).val();
            if (val != 3) {
                $('.checkProductLineSubType').each(function () {
                    this.checked = false;
                });
                $("#productLineSubType").val('');
                $('#selectAllCompany').prop('checked', '');
            } else {
                $('.checkProductLineSubType').each(function () {
                    this.checked = true;
                });
                $('#selectAllCompany').prop('checked', 'checked');
                getCabCompany();
            }
        });
    }

    if (document.getElementById("underwriterAddForm")) {
        document.getElementById("underwriterAddForm").addEventListener("submit", productLineSubType);
    }

    if (document.getElementById("underwriterEditForm")) {
        document.getElementById("underwriterEditForm").addEventListener("submit", productLineSubType);
    }

    function productLineSubType() {
        var prodline = '';
        if ($('#productline').length > 0) {
            prodline = $('#productline').val();
        } else {
            prodline = $('#editproductline').val();
        }
        var x = $('#productLineSubType').val();
        if (x == 0 && prodline == 3) {
            $('.divdropdown label.error').css('top', '10px');
        }
    }

});


