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
