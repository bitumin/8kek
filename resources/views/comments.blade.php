<div class="comments-section">
    <div class="comments-pagination">
        {{ $comments->links() }}
    </div>

    <div class="comments-container">
        @foreach($comments as $comment)
            <div class="comment">
                <div>{{ $comment->created_at }}</div>
                <div>{{ $comment->content }}</div>
            </div>
        @endforeach
    </div>

    <div class="comments-pagination">
        {{ $comments->links() }}
    </div>
</div>
