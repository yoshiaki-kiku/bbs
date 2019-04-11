<form action="{{ route('topic.page', $topic->id) }}" method="POST">
    @csrf

    <input type="hidden" name="comment_reply_id" value="{{ $comment->id }}">
    <div class="form-group mr-3 mb-2">
        <textarea class="form-control" name="message" value="{{ old('message') }}" id="" placeholder="コメントを入力してください。"
            rows="3"></textarea>
    </div>
    <div class="text-right mr-3 mb-2">
            <input class="btn btn-primary{{ $disabledButton }}" type="submit" name="replyComment" value="返信する"
            {{ $disabledButton }}>
    </div>
</form>
