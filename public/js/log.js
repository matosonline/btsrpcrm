$(function () {
    $(document).on("click", ".viewLogData", function(){
        var log_id = $(this).attr('data-log-id');
        var log_view_type = $(this).attr('data-log-type');

        if(log_id != ''){
                jQuery.ajax({
                url  : base_url + '/view/logDetail',
                type : "GET",
                data: {log_id:log_id,log_view_type:log_view_type},
                success: function(response) {
                        $('#viewLogDetails').html(response);
                        $('#viewLogDetails').modal('show');
                }
            });
        }
    });
});
