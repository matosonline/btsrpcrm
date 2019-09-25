$(function () {
    "use strict";
    //This is for the Notification top right

    // Dashboard 1 Morris-chart
    /*Morris.Area({
        element: 'morris-area-chart'
        , data: [{
                period: '2010'
                , iphone: 50
                , ipad: 80
                , itouch: 20
        }, {
                period: '2011'
                , iphone: 130
                , ipad: 100
                , itouch: 80
        }, {
                period: '2012'
                , iphone: 80
                , ipad: 60
                , itouch: 70
        }, {
                period: '2013'
                , iphone: 70
                , ipad: 200
                , itouch: 140
        }, {
                period: '2014'
                , iphone: 180
                , ipad: 150
                , itouch: 140
        }, {
                period: '2015'
                , iphone: 105
                , ipad: 100
                , itouch: 80
        }
            , {
                period: '2016'
                , iphone: 250
                , ipad: 150
                , itouch: 200
        }]
        , xkey: 'period'
        , ykeys: ['iphone', 'ipad', 'itouch']
        , labels: ['iPhone', 'iPad', 'iPod Touch']
        , pointSize: 3
        , fillOpacity: 0
        , pointStrokeColors: ['#00bfc7', '#fb9678', '#9675ce']
        , behaveLikeLine: true
        , gridLineColor: '#e0e0e0'
        , lineWidth: 3
        , hideHover: 'auto'
        , lineColors: ['#00bfc7', '#fb9678', '#9675ce']
        , resize: true
    });
    Morris.Area({
        element: 'morris-area-chart2'
        , data: [{
                period: '2010'
                , SiteA: 0
                , SiteB: 0
        , }, {
                period: '2011'
                , SiteA: 130
                , SiteB: 100
        , }, {
                period: '2012'
                , SiteA: 80
                , SiteB: 60
        , }, {
                period: '2013'
                , SiteA: 70
                , SiteB: 200
        , }, {
                period: '2014'
                , SiteA: 180
                , SiteB: 150
        , }, {
                period: '2015'
                , SiteA: 105
                , SiteB: 90
        , }
            , {
                period: '2016'
                , SiteA: 250
                , SiteB: 150
        , }]
        , xkey: 'period'
        , ykeys: ['SiteA', 'SiteB']
        , labels: ['Site A', 'Site B']
        , pointSize: 0
        , fillOpacity: 0.4
        , pointStrokeColors: ['#b4becb', '#01c0c8']
        , behaveLikeLine: true
        , gridLineColor: '#e0e0e0'
        , lineWidth: 0
        , smooth: false
        , hideHover: 'auto'
        , lineColors: ['#b4becb', '#01c0c8']
        , resize: true
    });*/
});
// sparkline
var sparklineLogin = function () {
    $('#sales1').sparkline([20, 40, 30], {
        type: 'pie',
        height: '90',
        resize: true,
        sliceColors: ['#01c0c8', '#7d5ab6', '#ffffff']
    });
    $('#sparkline2dash').sparkline([6, 10, 9, 11, 9, 10, 12], {
        type: 'bar',
        height: '154',
        barWidth: '4',
        resize: true,
        barSpacing: '10',
        barColor: '#25a6f7'
    });

};
var sparkResize;

$(window).resize(function (e) {
    clearTimeout(sparkResize);
    sparkResize = setTimeout(sparklineLogin, 500);
});
sparklineLogin();
// ==============================================================
// code for open popup when click on company in dashboard
// ==============================================================
$('#policy_details').validate({ // initialize the plugin
    rules: {
        social_id: {
            required: true,

        },
        mobile_number: {
            required: true,

        },
    },
    messages: {
        social_id: "Please enter Socialid.",
        mobile_number: "Please enter mobile",

    },

});
$("#mobile_number").on("keypress keyup blur", function (e) {
    var regex = new RegExp(/^(\?\+?[0-9]\?)?[0-9_\-+ ]*$/);
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);

    if (regex.test(str)) {
        return true;
    } else {
        e.preventDefault();
        return false;
    }

});


$('.get_info').on('click', function () {
    document.getElementById('policy_details').reset();
    $('#enter_otp').hide();
    $('#policy_details').validate().resetForm();
    $('.error').removeClass('error');
    $('#get_policy_data_modal').modal();
    $('#submit_data').hide();
    $('#captcha').html('');
    $('#get_captcha').show();
    $('#otp_message').html('');
    $('#company_name').val($(this).attr('company_name'));
})
$('#get_captcha').on('click', function () {
    if ($('#policy_details').valid()) {
        $('.loader__label').html('System try to login...');
        $('.preloader').show();
        $.ajax({
            url: base_url + "/get_otp",
            method: 'post',
            data: {
                social_id: $('#social_id').val(),
                mobile_number: $('#mobile_number').val(),
                company_name: $('#company_name').val()
            },
            success: function (result) {
                if (result && result != "fail") {
                    $('.preloader').hide();
                    $('#modal_body').html(result);
                    $('#get_captcha').hide();
                    $('#submit_data').show();
                    $('#fill_client_details').hide();
                    $('#enter_otp').show();


                    $('#verify_otp_form').validate({ // initialize the plugin
                        rules: {
                            otp: {
                                required: true,

                            },

                        },
                        messages: {
                            otp: "Please enter otp.",


                        },

                    });
                    $('#submit_data').on('click', function () {
                        if ($('#verify_otp_form').valid()) {
                            $('.loader__label').html('System login to the site...');
                            $('.preloader').show();
                            $.ajax({
                                url: base_url + "/verify_otp",
                                method: 'post',
                                data: {
                                    otp: $('#otp').val(),
                                    company_name: $('#company_name').val()

                                },
                                success: function (result) {
                                    if (result && result != 'fail') {
                                        $('.loader__label').html('Login successfully done ! Work in progress for Downloading neccessary files and making zip...');
                                        $.ajax({
                                            url: base_url + "/get_files",
                                            method: 'post',
                                            data: {
                                                company_name: $('#company_name').val(),
                                            },
                                            success: function (result) {
                                                $('#download_link').attr('href',"http://"+result);
                                                $('#get_policy_data_modal').modal('hide')
                                                $('#download_popup').modal();
                                                $('.preloader').hide();
                                            }
                                        })
                                    } else {
                                        $('.preloader').hide();
                                        alert('Invalid otp !');
                                        location.reload();
                                    }



                                }
                            })
                        }

                    })

                } else {
                    $('.preloader').hide();
                    alert("Login Fail");
                    location.reload();
                }
            }

        });
    }
})

$('#download_link').on('click',function(){
    $('#download_popup').modal('hide');
    location.reload();
})
