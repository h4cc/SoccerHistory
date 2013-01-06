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
        url: Routing.generate('bets_table', {filter:'date'}),
        success: function (data) {
            $('#loading_table').fadeToggle();
            $('#main_table').html(data);
            $('#main_table').fadeToggle();
        }
    });
}
