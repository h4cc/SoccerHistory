$(function(){
    init();
});

function init() {
    $('#main_table').hide();
    loadTable();
}

function loadTable()
{
    $.ajax({
        type : 'GET',
        url: Routing.generate('table'),
        success: function (data) {
            $('#loading_table').fadeToggle();
            $('#main_table').html(data);
            $('#main_table').fadeToggle();
        }
    });
}

