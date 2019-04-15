@extends("layout.main")

@section("title", "トピック削除")

@section("content")
<h1 class="topic-title-background mb-0 p-2">トピックの削除</h1>
<div class="bg-white p-3">
    <div class="alert alert-warning" role="alert">
        トピックを削除することで、<strong>トピックに投稿されたコメントも全て削除</strong>されます。
    </div>
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

    <div class="d-flex flex-row">
        <form action="{{ route('topic.delete') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $topic->id }}">
            <input class="btn btn-danger mr-4" type="submit" value="削除する">
        </form>
        <div>
            <a href="{{ url()->previous() }}">
                <button class="btn btn-primary">戻る</button>
            </a>
        </div>
    </div>
</div>

@endsection
