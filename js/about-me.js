$(document).ready(function () {
    // configure Lightbox settings
    lightbox.option({
        'albumLabel': '',
        'wrapAround': true
    });

    // show hide portfolio item text box
    $( ".thumbnail" ).hover(
        function() {
            $(this).find('span:first').fadeIn(200)
        }, function() {
            $(this).find('span:first').fadeOut(100);
        }
    );
});
