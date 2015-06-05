$(document).ready(function(e) {
    //$('.dateCal').datepicker();//For date picker 

    $(".from").datepicker({
        onClose: function(selectedDate) {
            $(".to").datepicker("option", "minDate", selectedDate);
        },
        onSelect: function() {
            $("#fromDate").valid();
        }
    });

    $(".to").datepicker({
        onClose: function(selectedDate) {
            $(".from").datepicker("option", "maxDate", selectedDate);
        },
        onSelect: function() {
            $("#toDate").valid();
        }
    });
    var lastSearchCriteria = $.parseJSON($('#lastSearchCriteria').html());
    var quoteFormNode = $("#userSearchForm");

    setLastSearchCriteria(lastSearchCriteria);
    setPaginationLinks(quoteFormNode);
    function setPaginationLinks(formNode) {
        $('.pagination-link').each(function() {
            $(this).click(function(e) {
                e.preventDefault();
                var pageNumber = $(this).attr('id').split("-")[1];
                formNode.attr('action', formNode.attr('action') + "?page=" + pageNumber)
                formNode.submit();
            });
        });
    }

    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
    }, "Only Characters Allowed.");

    $("#userSearchForm").validate({
        rules: {
            userName: {
                alpha: true
            },
            fromDate: {
                required: {
                    depends: function(element) {
                        var status = false;
                        if ($("#toDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            },
            toDate: {
                required: {
                    depends: function(element) {
                        var status = false;
                        if ($("#fromDate").val()) {
                            var status = true;
                        }
                        return status;
                    }
                }
            }
        },
        errorElement: 'div',
        wrapper: 'div',
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        messages: {
            userName: {
                alpha: "User name should only have alphabets"
            },
            fromDate: {
                required: "Please enter create date (From Date)"
            },
            toDate: {
                required: "Please enter create date (To Date)"
            } 
        }
    });

    function setLastSearchCriteria(lastSearchCriteria) {
        var node;
        for (var i in lastSearchCriteria) {
            if (lastSearchCriteria[i]) {
                node = $("#" + i);
                console.log(node);
                if (node.get('type') == 'checkbox') {
                    //node.set('checked', true);
                    node.prop('checked', true);
                } else {
                    node.val(lastSearchCriteria[i]);
                }
            }
        }
    }
    
    $('#resetUserValue').click(function() {
        window.location = "/admin/users";
    });

});
