@extends("layout.main")
@section("title", "コメントの編集")

@section("content")
<h1 class="topic-title-background mb-0 p-2">コメントの編集</h1>
<div class="bg-white p-3">
    <form action="{{ route('comment.update.confirm') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $comment->id }}">
        <div class="form-group">
            <label for="commentInput">メッセージ</label>
            <textarea name="message" class="form-control" id="commentInput" rows="3">{{ old('message', $comment->message)  }}</textarea>
        </div>
        <input class="btn btn-danger" type="submit" value="確認画面">
    </form>
    <div class="mt-3">
        <a href="{{ url()->previous() }}">
            <button class="btn btn-primary">戻る</button>
        </a>
    </div>


</div>
@endsection
