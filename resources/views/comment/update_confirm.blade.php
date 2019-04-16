@extends("layout.main")

@section("title", "コメントの編集")

@section("content")
<h1 class="topic-title-background mb-0 p-2">コメントの編集 - 確認画面</h1>
<div class="bg-white p-3">
    <h2>コメントID</h2>
    <p class="pl-2">{{ $comment->id }}</p>
    <h2>投稿者</h2>
    <p class="pl-2">{{ $comment->user->name }}</p>
    <h2>メッセージ</h2>
    <p class="pl-2">{!! $comment->message_br !!}</p>
    <h2>投稿日</h2>
    <p class="pl-2">{!! $comment->date !!}</p>

    <form action="{{ route('comment.update') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $comment->id }}">
        <input type="hidden" name="title" value="{{ $comment->title }}">
        <input type="hidden" name="message" value="{{ $comment->message }}">
        <div>
            <input class="btn btn-danger" name="edit" type="submit" value="編集する">
        </div>
        <div class="mt-3">
            <input class="btn btn-primary" name="back" type="submit" value="確認画面に戻る">
        </div>
    </form>

</div>

@endsection
