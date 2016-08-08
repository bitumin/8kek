+(function($, app) {

    $(function() { //on document ready...
        'use strict';

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
    });

})(jQuery, window.trollrank = window.trollrank || {});

//# sourceMappingURL=trollrank.js.map
