$(function () {
    
    $('#dob,.insTypeEnd,.insTypestart').datepicker({
        format: 'mm/dd/yyyy', //'yyyy-mm-dd',
        todayHighlight:true,
        autoclose:true
    });
    jQuery.validator.addMethod("valid_email", function (value, element) {
        return this.optional(element) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
    }, 'Please enter a valid email address.');
    
    $('#add_provider_form,#edit_provider_form').validate({ 
        rules: {
            fName:{
                required: true,
            },
            lName:{
                required: true,
            },
            
            npi:{
                required: true,digits: true
            },
            cred:{
                required: true,
            },
            spec:{
                required: true,
            },
            phone1:{
                required: true,
            },
            email: {
                required: true,
                valid_email: true
            },
            startDate1:{
                required: '#1_Check:checked',
            },
            startDate2:{
                required: "#2_Check:checked",
            },
            startDate3:{
                required: "#3_Check:checked",
            },
            startDate4:{
                required: "#4_Check:checked",
            }
            
        },
        messages: {
            fName: "Please enter your firstname",
            lName: "Please enter your lastname",
            npi:{
                required: "Please enter npi",
            },
            cred:{
                required: "Please select credentials",
            },
            spec:{
                required: "Please enter primary specialty",
            },
            phone1:{
                required: "Please enter Phone Number",
            },
            email: {
                required: "Please enter your email",
                valid_email: "Please enter a valid email address",
            },
            startDate1:{
                required: "Please select the start date",
            },
            startDate2:{
                required: "Please select the start date",
            },
            startDate3:{
                required: "Please select the start date",
            },
            startDate4:{
                required: "Please select the start date",
            }
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
    $('.provider_listing').DataTable({
        dom:"<'row'<'col-12 col-sm-6'l><'col-12 col-sm-6'f>>" +
            "<'row'<'col-sm-12'<'table-responsive'tr>>>" +
            "<'row'<'col-12 col-sm-6'i><'col-12 col-sm-6'p>>",
        order:[0,'desc'],
        drawCallback: function () {
            $('.dataTables_paginate > .pagination').addClass('justify-content-center justify-content-md-end');
            $('.dataTables_wrapper').removeClass('container-fluid');
            $('.dataTables_length').addClass('text-left');
            $('.dataTables_filter').addClass('text-left text-md-right');
        },
        columnDefs: [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }]
    });
})

