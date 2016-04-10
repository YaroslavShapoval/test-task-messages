var Form = function($form) {
    this.form = $form;

    this.getData = function(asObject) {
        if (asObject) {
            var o = {};
            var a = this.form.serializeArray();
            $.each(a, function() {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        } else {
            return new FormData(this.form[0]);
        }
    };

    this.validate = function(callback) {
        var self = this;
        var url = this.form.data('validate_url');
        this.clearErrors();

        $.post(url, this.form.serialize(), function(data) {
            if (!data) {
                callback.apply(self);
            } else {
                data = JSON.parse(data);

                $.each(data, function(fieldName, messages) {
                    for (var i = 0; i < messages.length; i++) self.addError(messages[i]);
                });
            }
        });
    };

    this.preview = function() {
        var formData = this.getData(true);

        var previewContainer = $('#new_message_preview');
        previewContainer.removeClass('hidden');

        $('#new_message_title').text(formData['name'] + '(' + formData['email'] + ')');
        $('#new_message_text').text(formData['text']);
    };

    this.submit = function(callback) {
        var self = this;
        var url = this.form.attr('action');

        $.ajax({
            url: url,
            type: 'POST',
            data: this.getData(),
            cache: false,
            processData: false,
            contentType: false,

            success: function(data) {
                if (!data) {
                    callback.apply(self);
                } else {
                    $.each(data, function(fieldName, messages) {
                        for (var i = 0; i < messages.length; i++) self.addError(messages[i]);
                    });
                }
            },

            error: function(jqXHR, textStatus) {
                console.log(textStatus);
            }
        });
    };

    this.clearErrors = function() {
        var $alerts = $('#alerts');
        $alerts.empty();
    };

    this.addError = function(message) {
        this.addMessage('danger', message);
    };

    /**
     * @param type - [success, info, warning, danger]
     * @param message
     */
    this.addMessage = function(type, message) {
        type = type || 'success';

        var alert = '<div class="alert alert-'+type+' alert-dismissible" role="alert">'
            + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
            + message + '</div>';

        var $alerts = $('#alerts');
        $alerts.append(alert);
    };
};