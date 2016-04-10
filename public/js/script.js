$(function() {
    var newMessageForm = new Form($('#new_message_form'));

    $('#message_preview_button').click(function() {
        newMessageForm.validate(function() {
            newMessageForm.preview();
        });
    });

    newMessageForm.form.on('submit', function(event) {
        event.preventDefault();

        newMessageForm.validate(function() {
            newMessageForm.submit(function() {
                document.location.reload(true);
            });
        });
    });

    var loginForm = new Form($('#login_form'));

    loginForm.form.on('submit', function(event) {
        event.preventDefault();

        loginForm.validate(function() {
            loginForm.submit(function() {
                document.location = '/';
            });
        });
    });

    $.each($('.editable'), function(_, editable) {
        new Editable($(editable));
    });
});