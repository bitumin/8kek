+(function($, w, b) {
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
            previewsContainer: '#dropzone-preview-container',
            dictDefaultMessage: '<i class="fa fa-3x fa-cloud-upload"></i><br>Select or drop image here',
            dictInvalidFileType: 'Only images allowed',
            dictFileTooBig: 'Image must not exceed {{maxFilesize}} MB',
            dictResponseError: 'Could not upload your image, verify it is a valid image with <{{maxFilesize}} MB',
            dictMaxFilesExceeded: 'Only one image allowed',
            init: function() {
                var that = this;

                // Show image preview and title form after image has been selected for upload
                this.on("sending", function() {
                    $('form#image-dropzone').addClass('hidden');
                    $('div#new-post-form-container').removeClass('hidden');
                });

                // Reset dropzone and title form on modal close
                $('#newPost').on('hidden.bs.modal', function () {
                    that.removeAllFiles();
                    $('textarea[id=title]').val('');
                    $('form[id=new-post]').validator();
                    $('form#image-dropzone').removeClass('hidden');
                    $('div#new-post-form-container').addClass('hidden');
                });
            }
        };

        /*
         * Up/down voting system
         */
        var $b = $(b);
        $b.on('click', '#up-vote', function() {
            $(this).addClass('disabled');
            $('#down-vote').addClass('disabled');
            $.post('/services/vote/up', {
                '_token': $('input[name="_token"]').val(),
                'post-id': parseInt($('input[name="post-id"]').val(), 10)
            }, function(res) {
                if (res['status'] === 'ok' && typeof(res['up-votes']) != "undefined")
                    $('#up-votes').html(res['up-votes'] + ' downs');
            });
        });
        $b.on('click', '#down-vote', function() {
            $(this).addClass('disabled');
            $('#up-vote').addClass('disabled');
            $.post('/services/vote/down', {
                '_token': $('input[name="_token"]').val(),
                'post-id': parseInt($('input[name="post-id"]').val(), 10)
            }, function(res) {
                if (res['status'] === 'ok' && typeof(res['down-votes']) != "undefined")
                    $('#down-votes').html(res['down-votes'] + ' downs');
            });
        });

    });
})(jQuery, window, window.document.body);
