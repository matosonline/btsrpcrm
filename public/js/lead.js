$(function () {
   if($('#id').val() != '' && typeof($('#id').val()) != 'undefined'){
       $('#pcpName').trigger('change');
       $('#agent').val($('#agent_id').val());
   }
    "use strict";
    /*$('#lead').DataTable({
        responsive: true,
        "columns": [
            null,
            null,
            null,
            null,
            null
          ]
    });*/
   /* $('#add_user_button').click(function () {
        location.href = base_url + '/user/add_user';
    })*/
    $('#dob,#startDate').datepicker({
        format: 'mm/dd/yyyy', //'yyyy-mm-dd',
        todayHighlight:true,
        autoclose:true
    });
    jQuery.validator.addMethod("valid_email", function (value, element) {
        return this.optional(element) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
    }, 'Please enter a valid email address.');
    $('#lead_form').validate({ // initialize the plugin
        rules: {
           
            fName: {
                required: true,

            },
            lName: {
                required: true,

            },
//            email: {
//                required: '#agree:checked',
//                valid_email: true
//
//            },
         /*   dob: {
                required: '#agree:checked',

            },
            lang: {
                required: '#agree:checked',
            },
            inputAddress:{
                required: '#agree:checked',
            },
            inputCity:{
                required: '#agree:checked',
            },
            inputState:{
                required: '#agree:checked',
            },
            inputZip:{
                required: '#agree:checked',
            },*/
            phone1:{
                required: '#agree:checked',
            },
            
            pcp_other:{
                required:function(element) {
                    return $('#pcpName').val() == '0';
                },
                minlength: 4
            },
            pcpName:{
                required: '#inquireNo:checked',
            },
          /* agent:{
                required: true
            }*/
            
        },
        messages: {
            fName: "Please enter your firstname",
            lName: "Please enter your lastname",
//          email: {
//                required: "Please enter your email",
//                valid_email: "Please enter a valid email address",
//            },
          /*  dob: {
                required: "Please select Date of Birth",
                
            },
            
            lang : "Please select Language",
            inputAddress:{
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
            },*/
            phone1:{
                required: "Please enter Phone Number",
            },
            
            pcp_other:{
                required: "Please enter details",
            },
            pcpName:{
                required: "Please select pcpName",
            },
            /*agent:{
                required: "Please select agent",
            },*/

        },

    });
    $('#lead_edit_form').validate({ // initialize the plugin
        rules: {
           
            fName: {
                required: true,

            },
            lName: {
                required: true,

            },
//            email: {
//                required: true,
//                valid_email: true,
//
//            },
            dob: {
                required: true,

            },
//            careID:{
//                 required: true,
//            },
            lang: {
                required: true,
            },
            inputAddress:{
                required: true,
            },
            inputCity:{
                required: true,
            },
            inputState:{
                required: true,
            },
            healthPlan:{
                required:function(element) {
                        return $('#lStatus').val() == '3';
                }
            },
            startDate:{
                required:function(element) {
                        return $('#lStatus').val() == '3';
                }
            },
            inputZip:{
                required: true,
            },
            phone1:{
                required: true,
            },
            pcpName:{
                required:function(element) {
                        return $('#lStatus').val() == '3';
                }
            },
        },
        messages: {
            fName: "Please enter your firstname",
            lName: "Please enter your lastname",
//            email: {
//                required: "Please enter your email",
//                valid_email: "Please enter a valid email address",
//            },
            dob: {
                required: "Please select Date of Birth",
                
            },
            
            lang : "Please select Language",
//            careID:"Please enter medicare id",
            inputAddress:{
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
            healthPlan:{
                required: "Please select helthplan",
            },
            startDate:{
                required: "Please select start date",
            },
            phone1:{
                required: "Please enter Phone Number",
            },
            pcpName:{
                required: "Please select pcpName",
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
    $('#planType').on('change',function(){
        if($(this).val() == 5){
            $( ".type_option" ).css('display','flex');
        }   
    });
    $('.attach_delete').on('click',function(){
        var CSRF_TOKEN = $('input[name="_token"]').val();
        var attachId = $(this).attr('data-attach');
        $.ajax({
            url: base_url + "/attach/delete",
            method: 'delete',
            data: {_token: CSRF_TOKEN,attachId:attachId},
            type : "DELETE",
            success: function (result) {
                $('#attach_'+attachId).remove();
            }
        });
    });
})
$('#pcpName').on("change",function(){
    if($(this).val() == 0 ){
        $( ".pcp_other_textbox input" ).css('display','block');
    }  
    $.ajax({
        url: base_url + "/get_agent",
        method: 'get',
        data: {
            doctor_id: $(this).val()
        },
        success: function (result) {
            $('#agent').html(result);
            if($('#id').val() != ''){
                $('#agent').val($('#agent_id').val());
            }
        }
    });
})

