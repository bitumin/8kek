+(function($, app) {

    $(function() { //on document ready...
        'use strict';

        /*
         * Password strength bar
         */
        var options = {};
        options.common = {
            minChar: 6,
            usernameField: "#name"
        };
        options.ui = {
            showVerdicts: false,
            container: '#pwd-strength-bar',
            viewports: {
                progress: "#pwd-strength-viewport-progress"
            }
        };
        $('#password-register').pwstrength(options);

        /*
         * Infinite scrolling
         */
        $('.scroll').jscroll({
            // debug: true,
            // autoTrigger: true,
            autoTriggerUntil: 4,
            nextSelector: 'a.next:last',
            contentSelector: 'div.scroll',
            // pagingSelector: 'div.pagination-controller',
            loadingHtml: '<small>Loading...</small>'
        });

    });

})(jQuery, window.trollrank = window.trollrank || {});
