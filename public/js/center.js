$(function () {
    
    jQuery.validator.addMethod("valid_email", function (value, element) {
        return this.optional(element) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
    }, 'Please enter a valid email address.');
    $('#center_form').validate({ 
        rules: {
            centerName: {
                required: true,

            },
            inputAddress:{
                required: true,
            },
            inputAddress2:{
                required: true,
            },
            inputCity:{
                required: true,
            },
            inputState:{
                required: true,
            },
            inputZip:{
                required: true,
            },
            phone1:{
                required: true,
            },
            fax1:{
                required: true,
            },
            
        },
        messages: {
            centerName: "Please enter center name",
            inputAddress:{
                required: "Please enter address",
            },
            inputAddress2:{
                required: "Please enter address",
            },
            inputCity:{
                required: "Please enter city",
            },
            inputState:{
                required: "Please select state",
            },
            inputZip:{
                required: "Please enter zipcode",
            },
            phone1:{
                required: "Please enter Phone Number",
            },
            fax1:{
                required: "Please enter fax number",
            },
        },

    });
    
    $("#phone1,#inputZip").on("keypress keyup blur", function (e) {
        var regex = new RegExp(/^(\?\+?[0-9]\?)?[0-9_\-+ ]*$/);
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);

        if (regex.test(str)) {
            return true;
        } else {
            e.preventDefault();
            return false;
        }

    });
     $('.centerListingTable').DataTable({
        dom:"<'row'<'col-12 col-sm-6'l><'col-12 col-sm-6'f>>" +
            "<'row'<'col-sm-12'<'table-responsive'tr>>>" +
            "<'row'<'col-12 col-sm-6'i><'col-12 col-sm-6'p>>",
        order:[0,'desc'],
        drawCallback: function () {
            $('.dataTables_paginate > .pagination').addClass('justify-content-center justify-content-md-end');
            $('.dataTables_wrapper').removeClass('container-fluid');
            $('.dataTables_length').addClass('text-left');
            $('.dataTables_filter').addClass('text-left text-md-right');
        }
    });
})

