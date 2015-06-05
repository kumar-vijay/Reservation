$(document).ready(function () {
    getlob();
    getbroker();
    getbranch();
    /*****************************************For Form Validation************************************************/
    $('#daterange').change(function (ev) {
        var val = $(this).val();
        $('#branchOffice').val("");
        $('#producttype').val("");
        $('#productsubtype').val("");
        if (val == '0') {
            return false;
        }
        var dataObj = {
            'header': {
                'requestName': 'getStartDate'
            },
            'body': {
                'data': val
            }
        };
        $.ajax('/report/getStartDate', {
            'dataType': 'json',
            'data': JSON.stringify(dataObj),
            'type': 'post',
            'success': function (data, status, xhr) {
                if (data) {
                    var today = $.datepicker.formatDate('yy-mm-dd', new Date());
                    $('#startdate').val(data[0]['StartDate']);
                    $('#enddate').val(data[0]['EndDate']);
                    $('#reportasofdate').val(today);
                }
            }
        });
    });

    $(function () {
        $(document).click(function (e)
        {
            var container = $(".dropdown");

            if (!container.is(e.target) // if the target of the click isn't the container...
                    && container.has(e.target).length === 0) // ... nor a descendant of the container
            {
                container.removeClass("is-active");
            }
        });
        $(".dropdown").click(function () {
            $(this).toggleClass("is-active");
        });
        $(".dropdown ul").click(function (e) {
            e.stopPropagation();
        });
    });


    $('#startdate').datepicker({
        showTime: true,
        dateFormat: 'yy-mm-dd',
        onSelect: function () {
            $(this).valid();
        }
    });
    $('#enddate').datepicker({
        showTime: true,
        dateFormat: 'yy-mm-dd',
        onSelect: function () {
            $(this).valid();
        }
    });
    $('#reportasofdate').datepicker({
        showTime: true,
        dateFormat: 'yy-mm-dd',
        onSelect: function () {
            $(this).valid();
        }
    });

    /*select all for lob*/
    $('#selectAll').click(function (event) {

        if (this.checked) {
            $('.checklob').each(function () {
                this.checked = true;

            });
            getlob();
        } else {
            $('.checklob').each(function () {
                this.checked = false;
            });
            $("#lobVal").val('');
        }

    });

    $('.checklob').click(function (event) {
        getlob();
        var numofcheck = $('.checklob:checked').length;
        var numoflob = $('.checklob').length;
        if (numofcheck == numoflob) {
            $('#selectAll').prop('checked', 'checked');
        } else {
            $('#selectAll').prop('checked', '');
        }


    });

    function getlob() {
        var lobarray = new Array();
        var i = 0;
        $('.checklob').each(function (event) {
            if (this.checked) {
                lobarray[i] = $(this).val();
                i = i + 1;
            }
        });
        $("#lobVal").val(lobarray.toString());
    }


    /*select all for branchoffice*/
    $('#selectAllBranch').click(function (event) {
        if (this.checked) {
            $('.checkbranchoffice').each(function () {
                this.checked = true;
            });
            getbranch();
        } else {
            $('.checkbranchoffice').each(function () {
                this.checked = false;
            });
            $("#branchVal").val('');
        }
    });
    $('.checkbranchoffice').click(function (event) {
        getbranch();
        var numofcheck = $('.checkbranchoffice:checked').length;
        var numoflob = $('.checkbranchoffice').length;
        if (numofcheck == numoflob) {
            $('#selectAllBranch').prop('checked', 'checked');
        } else {
            $('#selectAllBranch').prop('checked', '');
        }
    });

    function getbranch() {
        var brancharray = new Array();
        var i = 0;
        $('.checkbranchoffice').each(function (event) {
            if (this.checked) {
                brancharray[i] = $(this).val();
                i = i + 1;
            }
        });
        $("#branchVal").val(brancharray.toString());
    }

    /*select all for broker*/
    $('#selectAllBroker').click(function (event) {
        if (this.checked) {
            $('.checkBroker').each(function () {
                this.checked = true;
            });
            getbroker();
        } else {
            $('.checkBroker').each(function () {
                this.checked = false;
            });
            $("#brokerVal").val('');
        }
    });
    $('.checkBroker').click(function (event) {
        getbroker();
        var numofcheck = $('.checkBroker:checked').length;
        var numoflob = $('.checkBroker').length;
        if (numofcheck == numoflob) {
            $('#selectAllBroker').prop('checked', 'checked');
        } else {
            $('#selectAllBroker').prop('checked', '');
        }
    });

    function getbroker() {
        var brancharray = new Array();
        var i = 0;
        $('.checkBroker').each(function (event) {
            if (this.checked) {
                brancharray[i] = $(this).val();
                i = i + 1;
            }
        });
        $("#brokerVal").val(brancharray.toString());
    }
    /*****************************************For Admitted Region************************************************/
});


