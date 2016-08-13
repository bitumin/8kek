<div class="modal fade" id="newPost" tabindex="-1" role="dialog" aria-labelledby="newPostLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newPostLabel">New post</h4>
            </div>

            <div class="modal-body">

                {{--Image upload via dropzone--}}
                <form action="{{ route('services.upload.image') }}" class="dropzone" id="image-dropzone">
                    {{--CSRF token--}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>

                <form id="new-post" method="POST" action="{{ route('services.upload.post') }}" data-toggle="validator" data-focus="false">
                    {{--CSRF token--}}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    {{--Post title--}}
                    <div id="post-title" class="form-group{{ $errors->has('title') ? ' has-error' : '' }} has-feedback">
                        <input id="title" type="text" class="form-control input-lg" name="title"
                               placeholder="Post title"
                               disabled="disabled"
                               maxlength="140"
                               value="{{ old('title') }}"
                               required data-required-error="Post title is required">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block with-errors">
                            @if ($errors->has('title'))
                                {{ $errors->first('title') }}
                            @endif
                        </span>
                    </div>

                    {{--Recaptcha--}}
                    {!! Recaptcha::render() !!}

                    <span id="post-image-controllers">
                        <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Cancel</button>
                        <button id="btn-upload" type="submit" class="btn btn-lg btn-primary"><i class="fa fa-cloud-upload"></i> Send</button>
                    </span>
                </form>

            </div>

        </div>
    </div>
</div>
