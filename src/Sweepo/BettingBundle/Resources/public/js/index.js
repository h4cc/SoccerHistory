$(function(){
    init();

    $('#add_bet_button').on('click', function(){
        $('#add_bet').fadeToggle();
    });

    $('#add_bet > i').on('click', function(){
        console.log('ok');
        $('#add_bet').fadeToggle();
    });
});

function init() {
    $('#main_table').hide();
    $("#create_bet_first_team").select2();
    $("#create_bet_second_team").select2();

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

