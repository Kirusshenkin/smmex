function login(event, form){
	event.preventDefault();

	var errorHolder = $(form).find('.error');
	errorHolder.html("");

	var username = $(form).find('[name=username]').val();
	var password = $(form).find('[name=password]').val();

	$.post(
        apiUrl + "/authorization",
        { Authorization: token, username: username, password: password },
        function (data) {
            if (data.success) {
                $.cookie('token', data.data.token);
                $.cookie('user_id', data.data.id);
                window.location.href = "/offers.php";
            }else{
            	errorHolder.html(data.data);
            }
        }
    );

    return false;
}

function register(event, form){
	event.preventDefault();

	var errorHolder = $(form).find('.error');
	errorHolder.html("");

	var email    = $(form).find('[name=email]').val();
	var username = $(form).find('[name=username]').val();
	var password = $(form).find('[name=password]').val();

	$.post(
        apiUrl + "/registration",
        { Authorization: token, email: email, username: username, password: password },
        function (data) {
            if (data.success) {
                login(event, form);
            }else{
            	errorHolder.html(data.errors);
            }
        }
    );

    return false;
}