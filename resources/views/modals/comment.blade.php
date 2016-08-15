<div class="modal" id="postComment" tabindex="-1" role="dialog" aria-labelledby="postCommentLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="postCommentLabel">New comment</h4>
            </div>

            <div class="modal-body">

                <form id="new-post" method="POST" action="{{ route('api.comment') }}" data-toggle="validator" data-focus="false">
                    {{--CSRF token--}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    {{--Post id--}}
                    <input class="hidden" name="post_id" value="{{ $post->id }}" title="post_id">

                    {{--Post title--}}
                    <div id="post-content" class="form-group">
                        <textarea id="content" class="form-control input-lg" name="content"
                                  placeholder="Comment..."
                                  maxlength="200" rows="4"
                                  required data-required-error="Write something"></textarea>
                        <span class="help-block with-errors"></span>
                    </div>

                    {{--Recaptcha--}}
                    {!! Recaptcha::render() !!}

                    <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-comment"></i> Submit</button>
                    <button type="button" class="btn btn-lg btn-default btn-block" data-dismiss="modal">Cancel</button>
                </form>

            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
