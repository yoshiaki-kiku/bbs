@extends("layout.main")

@section("title", "トピックの編集")

@section("content")
<h1 class="topic-title-background mb-0 p-2">トピックの編集 - 確認画面</h1>
<div class="bg-white p-3">
    <h2>トピックID</h2>
    <p class="pl-2">{{ $topic->id }}</p>
    <h2>トピック名</h2>
    <p class="pl-2">{{ $topic->title }}</p>
    <h2>投稿者</h2>
    <p class="pl-2">{{ $topic->user->name }}</p>
    <h2>メッセージ</h2>
    <p class="pl-2">{!! $topic->message_br !!}</p>
    <h2>投稿日</h2>
    <p class="pl-2">{!! $topic->date !!}</p>

    <form action="{{ route('topic.update') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $topic->id }}">
        <input type="hidden" name="title" value="{{ $topic->title }}">
        <input type="hidden" name="message" value="{{ $topic->message }}">
        <div>
            <input class="btn btn-danger" name="edit" type="submit" value="編集する">
        </div>
        <div class="mt-3">
            <input class="btn btn-primary" name="back" type="submit" value="確認画面に戻る">
        </div>
    </form>

</div>

@endsection
