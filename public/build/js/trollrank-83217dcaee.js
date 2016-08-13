+(function($, w) {
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
            autoTriggerUntil: 4,
            nextSelector: 'a.next:last',
            contentSelector: 'div.scroll',
            loadingHtml: '<small>Loading...</small>'
        });

        /*
         * Upload images, dropzone configuration
         */
        w.Dropzone.options.imageDropzone = {
            // autoProcessQueue: false,
            paramName: "file",
            maxFiles: 1,
            maxFilesize: 2, //MB
            parallelUploads: 1,
            acceptedFiles: 'image/*',
            uploadMultiple: false,
            dictDefaultMessage: '<i class="fa fa-3x fa-cloud-upload"></i><br>Select or drop image here',
            dictInvalidFileType: 'Only images allowed',
            dictFileTooBig: 'Image must not exceed {{maxFilesize}} MB',
            dictResponseError: 'Could not upload your image, verify it is a valid image with <{{maxFilesize}} MB',
            dictMaxFilesExceeded: 'Only one image allowed',
            init: function() {
                var that = this;

                // Allow only one image
                this.on("maxfilesexceeded", function(file) {
                    that.removeAllFiles();
                    that.addFile(file);
                });

                // Disable post title input before an image is uploaded
                this.on("sending", function() {
                    $('input[id=title]').attr('disabled', 'disabled');
                    $('button[id=btn-upload]').addClass('disabled');
                });

                // Enable post title input when an image has been successfully uploaded
                this.on("success", function() {
                    $('input[id=title]').removeAttr('disabled');
                    $('button[id=btn-upload]').removeClass('disabled');
                    $('form[id=new-post]').validator('validate');
                });

                // Reset dropzone and new post form on modal hide/close
                $('#newPost').on('hidden.bs.modal', function () {
                    that.removeAllFiles();
                    $('input[id=title]').attr('disabled', 'disabled').val('');
                    $('form[id=new-post]').validator('validate');
                });
            }
        };

    });
})(jQuery, window);

//# sourceMappingURL=trollrank.js.map
