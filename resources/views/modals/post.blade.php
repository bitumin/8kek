<div class="modal fade" id="newPost" tabindex="-1" role="dialog" aria-labelledby="newPostLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newPostLabel">New post</h4>
            </div>

            <div class="modal-body">

                {{--Image upload dropzone--}}
                <form action="{{ route('api.upload.image') }}" class="dropzone" id="image-dropzone">
                    {{--CSRF token--}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>

                <div id="new-post-form-container" class="row hidden">

                    <form id="new-post" method="POST" action="{{ route('api.upload.post') }}" data-toggle="validator" data-focus="false">
                        {{--CSRF token--}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="col-fixed-left-150">
                            <div id="dropzone-preview-container" class="dropzone-preview"></div>
                        </div>

                        {{--Post title--}}
                        <div id="post-title" class="col-left-offset-150 form-group">
                            <textarea id="title" class="form-control input-lg" name="title"
                                      placeholder="Post title..."
                                      maxlength="140" rows="4"
                                      required data-required-error="Post title is required"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div id="post-image-controllers" class="col-xs-12">
                            {{--Recaptcha--}}
                            {!! Recaptcha::render() !!}

                            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancel</button>
                            <button id="btn-upload" type="submit" class="btn btn-lg btn-primary"><i class="fa fa-cloud-upload"></i> Send</button>
                        </div>
                    </form>

                </div><!-- /.row -->
            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
