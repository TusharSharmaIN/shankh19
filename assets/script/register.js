// Send AJAX request to the server to register an admin
$(document).ready(function(){
    $('#registration-form').submit(function(event){
        // Stop form from sending the default way
        event.preventDefault();
        
        // Get user input from the form
        var username = $('input[name=username]').val();
        var password = $('input[name=password]').val();
        var token = $('input[name=token]').val();

        $.ajax(
            {
                url: './register',
                method: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({ username: username, password: password, token: token }),
                beforeSend: function(){
                    $('#register-btn').css('cursor', 'not-allowed');
                    $('#register-btn').attr('disabled', true);
                },
                success: function(res){
                    $('.response').addClass('response-success');
                    $('.response').html(res.message);
                    $('input[name=username]').val('');
                    $('input[name=password]').val('');
                    $('input[name=token]').val('');
                },
                error: function(res){
                    $('.response').addClass('response-error');
                    $('.response').html(res.responseJSON.message);
                    $('#register-btn').css('cursor', 'pointer');
                    $('#register-btn').removeAttr('disabled');
                    $('input[name=username]').val('');
                    $('input[name=password]').val('');
                    $('input[name=token]').val('');
                }
            }
        );
    });
});