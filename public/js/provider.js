$(function () {
    
    $('#dob,.insTypeEnd,.insTypestart').datepicker({
        format: 'yyyy-mm-dd',
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
})

!function ($) {
    "use strict";

    var SweetAlert = function () { };

    //examples 
    SweetAlert.prototype.init = function () {
        $(".sa-confirm").click(function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              
                if (result.value) {
                $.ajax({
                    url: base_url + "/user/delete",
                    method: 'delete',
                    data: {
                        user_id: $(this).attr('user_id')
                    },
                    success: function (result) {
                        Swal.fire(
                            'Deleted!',
                            'User has been deleted.',
                            'success'
                        ).then((result)=>{
                            location.reload();
                        }
                        )
                    }
                });
            }
                    
                
            })
        });

    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing 
function ($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);
