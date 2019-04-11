@extends("layout.main")

@section("title", $topic->title)

@section("content")

<h1>{{ $topic->title }}</h1>

<div class="container bg-white p-0">
    <div class="media border pt-2 pl-2">
        <img data-src="holder.js/48x48?theme=sky&size=8">
        <div class="media-body pl-2">
            <div class="mt-0 mb-2">{{ $topic->user->name }}｜{{ $topic->date }}</div>
            <div class="pb-2 pr-2">
                {{ $topic->message }}
            </div>
        </div>
    </div>
</div>

<div class="container bg-white mt-4 p-0">
    <div class="bg-light border">
        @include("layout.form_comment")
    </div>

    @foreach($comments as $comment)
    <div class="media border pt-2 pl-2">
        <img data-src="holder.js/48x48?theme=sky&size=8">
        <div class="media-body pl-2">
            <div class="mt-0 mb-2">{{ $comment->user->name }}｜{{ $comment->date }}</div>
            <div class="pb-2 pr-2">
                {{ $comment->message }}
            </div>
            <p class="ml-1">
                <button type="button" class="btn btn-sm btn-secondary" aria-expanded="false" data-toggle="collapse"
                    data-target="#collapseExample{{ $comment->id }}" aria-controls="collapseExample">
                    ▼ 返信
                    @if(isset($commentRepliesCount[$comment->id]))
                    <span class="badge badge-pill ml-1 badge-light">{{ $commentRepliesCount[$comment->id] }}</span>
                    @else
                    <span class="badge badge-pill ml-1 badge-light">0</span>
                    @endif
                </button>
            </p>
            <div class="collapse" id="collapseExample{{ $comment->id }}">
                @isset($commentReplies[$comment->id])
                @foreach($commentReplies[$comment->id] as $commentReply)
                <div class="media border-left border-top pt-2 pl-2">
                    <img data-src="holder.js/48x48?theme=sky&size=8">
                    <div class="media-body pl-2">
                        <div class="mt-0 mb-2">{{ $commentReply->user->name }}｜{{ $commentReply->date }}</div>
                        <div class="pb-2 pr-2">
                            {{ $commentReply->message }}
                        </div>
                    </div>
                </div>
                @endforeach
                @endisset
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="container p-4">
    {{ $comments->links() }}
</div>
@endsection
