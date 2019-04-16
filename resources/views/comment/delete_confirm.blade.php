@extends("layout.main")

@section("title", "コメントの削除")

@section("content")
<h1 class="topic-title-background mb-0 p-2">コメントの削除</h1>
<div class="bg-white p-3">
    <div class="alert alert-warning" role="alert">
        <strong>対応する返信コメントがある場合は、返信コメントも削除されます。</strong>
    </div>
    <h2>コメントID</h2>
    <p class="pl-2">{{ $comment->id }}</p>
    <h2>投稿者</h2>
    <p class="pl-2">{{ $comment->user->name }}</p>
    <h2>メッセージ</h2>
    <p class="pl-2">{!! $comment->message_br !!}</p>
    <h2>投稿日</h2>
    <p class="pl-2">{!! $comment->date !!}</p>

    <form action="{{ route('comment.delete') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $comment->id }}">
        <input class="btn btn-danger" type="submit" value="削除する">
    </form>
    <div class="mt-3">
        <a href="{{ url()->previous() }}">
            <button class="btn btn-primary">戻る</button>
        </a>
    </div>
</div>

@endsection
