// Send AJAX request to the server to login the admin
$(document).ready(function(){
    $('#login-form').submit(function(event){
        // Stop form from sending the default way
        event.preventDefault();
        
        // Get user input from the form
        var username = $('input[name=username]').val();
        var password = $('input[name=password]').val();

        $.ajax(
            {
                url: './login',
                method: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({ username: username, password: password }),
                beforeSend: function(){
                    $('#login-btn').css('cursor', 'not-allowed');
                    $('#login-btn').attr('disabled', true);
                },
                success: function(res){
                    $('.response').addClass('response-success');
                    $('.response').html(res.message);
                    $('input[name=username]').val('');
                    $('input[name=password]').val('');
                    window.location.href = "/dashboard";
                },
                error: function(res){
                    $('.response').addClass('response-error');
                    $('.response').html(res.responseJSON.message);
                    $('#login-btn').css('cursor', 'pointer');
                    $('#login-btn').removeAttr('disabled');
                    $('input[name=username]').val('');
                    $('input[name=password]').val('');
                }
            }
        );
    });
});