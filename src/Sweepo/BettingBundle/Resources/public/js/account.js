$(function(){
    $.ajax({
        type : 'GET',
        url: Routing.generate('account_table', {username: "remy"}),
        success: function (data) {
            console.log(data);
        }
    });
});