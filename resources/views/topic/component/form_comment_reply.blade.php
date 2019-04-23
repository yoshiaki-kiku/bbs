<form action="{{ route('topic.page', $topic->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="comment_reply_id" value="{{ $comment->id }}">
    <div class="form-group mb-2">
        <textarea class="form-control" name="message" value="{{ old('message') }}" id="" placeholder="コメントを入力してください。"
            rows="3"></textarea>
    </div>
    <select-file-component parent-element-id="accordion{{ $comment->id }}"></select-file-component>
    <div class="text-right">
        @if((Auth::check()))
        <input class="btn btn-primary" type="submit" name="replyComment" value="返信する">
        @else
        <span class="btn btn-primary btn-sm">返信はログインが必要です</span>
        @endif
    </div>
</form>
