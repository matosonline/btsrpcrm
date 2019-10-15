$(function () {
    $( "#search_data" ).autocomplete({
        source: function(request, response) {
            $.ajax({
            url: base_url+"/getAutocompleteData",
            dataType: "json",
            data: {term : request.term},
            success: function(data){
                if(!data.length){
                    var result = [
                        {
                            label: 'No matches found', 
                            value: response.term
                        }
                    ];
                    response(result);
                }
                else{
                    var resp = $.map(data,function(obj){
                         return obj;
                    }); 
                    response(resp);
                }
            }
        });
    },
    minLength: 1,
    focus: function(event, ui){
        event.preventDefault();
        $('#search_data').val(ui.item.label);
        $('#search_data_form').append('<input type="hidden" value='+ui.item.value+' name="search_value">');
        return false;
    },
    select: function (event, ui) {
        $('#search_data').val(ui.item.label);
        $('#search_data_form').append('<input type="hidden" value='+ui.item.value+' name="search_value">');
        return false;
    } 
 });
})