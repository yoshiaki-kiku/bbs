@extends("layout.main")
@section("title", "トピックの編集")

@section("content")
<h1 class="topic-title-background mb-0 p-2">トピックの編集</h1>
<div class="bg-white p-3">
    <form action="{{ route('topic.update.confirm') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $topic->id }}">
        <div class="form-group">
            <label for="topicNameInput">トピック名</label>
            <input type="text" name="title" value="{{ old('title', $topic->title) }}" class="form-control" id="topicNameInput"
                placeholder="">
        </div>
        <div class="form-group">
            <label for="commentInput">コメント欄</label>
            <textarea name="message" class="form-control" id="commentInput" rows="3">{{ old('message', $topic->message)  }}</textarea>
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
