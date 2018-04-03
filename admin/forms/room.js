jQuery(function() {
    document.formvalidator.setHandler('roomNumber',
        function (value) {
            regex=/^[A-Z][0-9]+$/;
            return regex.test(value);
        });
});