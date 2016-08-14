<div class="comments-section">
    <div class="comments-pagination">
        {{ $comments->links() }}
    </div>

    <div class="comments-container">
        @foreach($comments as $comment)
            <div class="comment-authorship">
                #{{ $comment->id }} Posted by {{ $comment->author ?: 'Anonymous' }}
                <small>{{ $comment->created_at }}</small>
            </div>
            <div class="comment-content">{{ $comment->content }}</div>
        @endforeach
    </div>

    <div class="comments-pagination">
        {{ $comments->links() }}
    </div>
</div>
