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

