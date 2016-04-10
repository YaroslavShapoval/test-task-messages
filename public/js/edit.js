var Editable = function($parent) {
    var self = this;
    this.parent = $parent;

    this.form = new Form($parent.find('form'));

    $parent.on('click', '.editable-button__edit', function(event) {
        event.preventDefault();
        self.toggle();
    });

    $parent.on('click', '.editable-button__save', function(event) {
        event.preventDefault();

        self.form.validate(function() {
            self.form.submit(function() {
                document.location.reload(true);
            });
        });
    });

    this.toggle = function() {
        this.parent.toggleClass('editable__active');
    };
};