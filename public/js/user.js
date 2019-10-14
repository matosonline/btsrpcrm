$(function () {
    "use strict";
    $('#user_list').DataTable({
        responsive: true,
        "columns": [
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            { "orderable": false },
            { "orderable": false }
          ]
    });
   /* $('#add_user_button').click(function () {
        location.href = base_url + '/user/add_user';
    })*/
    jQuery.validator.addMethod("valid_email", function (value, element) {
        return this.optional(element) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
    }, 'Please enter a valid email address.');
    $('#store_user_data').validate({ // initialize the plugin
        rules: {
            first_name: {
                required: true,

            },
            last_name: {
                required: true,

            },
            email: {
                required: true,
                valid_email: true

            },
            password: {
                required: true,

            },
            confirm_password: {
                required: true,
                equalTo: "#password"

            },
            role:{
                required: true,
            },
            status:{
                required: true,
            }
        },
        messages: {
            first_name: "Please enter your firstname",
            last_name: "Please enter your lastname",
            password: {
                required: "Please provide a password",
            },
            confirm_password: {
                required: "Please provide a confirm password",
                equalTo: "Please enter same password as password",
            },
            email: "Please enter a valid email address",
            role : "Please select role",
            status : "Please select status",
        },

    });
    $('#change_pass').validate({ // initialize the plugin
        rules: {
            password: {
                required: true,

            },
            confirm_password: {
                required: true,
                equalTo: "#password"

            }
        },
        messages: {
            password: {
                required: "Please provide a password",
            },
            confirm_password: {
                required: "Please provide a confirm password",
                equalTo: "Please enter same password as password",
            }
        },

    });
    $("#phone_number").on("keypress keyup blur", function (e) {
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
                    var CSRF_TOKEN = $('input[name="_token"]').val();
                    $.ajax({
                        url: base_url + "/user/delete",
                        method: 'delete',
                        data: {_token: CSRF_TOKEN,user_id: $(this).attr('user_id')},
                        type : "DELETE",
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
