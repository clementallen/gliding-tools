require(['config'], function() {
    require(['jquery'], function($) {
        // Displays year in footer
        $('#footer p').append(new Date().getFullYear());
    });
});
