@extends("layout.main")

@section("title", $topic->title)

@section("content")

<h1 class="p-3 topic-title-background mb-0">{{ $topic->title }}</h1>

<div class="container border bg-white py-2 p-0">
    <div class="px-2">
        <div class="d-flex flex-row">
            <div class="mr-2"><img data-src="holder.js/40x40?theme=sky&size=8"></div>
            <div>{{ $topic->user->name }}｜{{ $topic->date }}</div>
        </div>
        <div class="d-flex flex-row py-2">
            {!! $topic->message_br !!}
        </div>
        @isset($topic->image_path)
        <div>
            <img class="img-thumbnail" src="{{ asset('/storage/post_images/' .$topic->image_path) }}">
        </div>
        @endisset
    </div>
</div>

<div class="container bg-white mt-4 p-0">
    <div class="bg-light border">
        @include("topic.component.form_comment")
    </div>


    @foreach($comments as $comment)
    {{-- 親コメントエリア --}}
    <div class="container border py-2 px-0" id="{{ $comment->id }}"
        v-bind:class="newCommentCheck({{ $comment->id }}, {{ session('new_comment_id') }})">
        <div class="px-2">
            <div class="d-flex flex-row">
                <div class="mr-2"><img data-src="holder.js/40x40?theme=sky&size=8"></div>
                <div>{{ $comment->user->name }}｜{{ $comment->date }}</div>
            </div>
            <div class="d-flex flex-row py-2">
                {!! $comment->message_br !!}
            </div>
            @isset($comment->image_path)
            <div>
                <img class="img-thumbnail" src="{{ asset('/storage/post_images/' .$comment->image_path) }}">
            </div>
            @endisset
            <div class="d-flex flex-row mb-2 justify-content-end">
                <div>
                    <vote-component vote="{{ $comment->vote }}" comment-id="{{ $comment->id }}"></vote-component>
                </div>
            </div>

            @can("admin")
            <div class="d-flex flex-row mb-2">
                <a href="{{ route('comment.update.form', [$comment->id]) }}" class="btn btn-sm btn-warning">
                    編集
                </a>
                <a href="{{ route('comment.delete.confirm', [$comment->id]) }}" class="btn btn-sm btn-danger ml-2">
                    削除
                </a>
            </div>
            @endcan

            <div class="d-flex flex-row">
                <button type="button" class="btn btn-sm btn-secondary mr-auto" aria-expanded="true"
                    data-toggle="collapse" data-target="#collapse{{ $comment->id }}"
                    aria-controls="collapse{{ $comment->id }}">
                    ▼ 返信
                    @if(isset($commentRepliesCount[$comment->id]))
                    <span class="badge badge-pill ml-1 badge-light">{{ $commentRepliesCount[$comment->id] }}</span>
                    @else
                    <span class="badge badge-pill ml-1 badge-light">0</span>
                    @endif
                </button>
            </div>
        </div>
        {{-- 返信コメントエリア --}}
        {{-- コメントがあるdivはデフォで開く --}}
        <div class="collapse pt-2 pl-3 @if(isset($commentRepliesCount[$comment->id])) show @endif"
            id="collapse{{ $comment->id }}">
            @isset($commentReplies[$comment->id])
            @foreach($commentReplies[$comment->id] as $commentReply)
            <div class="container border-left border-top py-2 px-0" id="{{ $commentReply->id }}"
                v-bind:class="newCommentCheck({{ $commentReply->id }}, {{ session('new_comment_id') }})">
                <div class="px-2">
                    <div class="d-flex flex-row">
                        <div class="mr-2"><img data-src="holder.js/40x40?theme=sky&size=8"></div>
                        <div>{{ $commentReply->user->name }}｜{{ $commentReply->date }}</div>
                    </div>
                    <div class="d-flex flex-row py-2">
                        {!! $commentReply->message_br !!}
                    </div>
                    @isset($commentReply->image_path)
                    <div>
                        <img class="img-thumbnail"
                            src="{{ asset('/storage/post_images/' .$commentReply->image_path) }}">
                    </div>
                    @endisset
                    <div class="d-flex flex-row mb-2 justify-content-end">
                        <vote-component vote="{{ $commentReply->vote }}" comment-id="{{ $commentReply->id }}">
                        </vote-component>
                    </div>
                    @can("admin")
                    <div class="d-flex flex-row">
                        <a href="{{ route('comment.update.form', [$commentReply->id]) }}"
                            class="btn btn-sm btn-warning">
                            編集
                        </a>
                        <a href="{{ route('comment.delete.confirm', [$commentReply->id]) }}"
                            class="btn btn-sm btn-danger ml-2">
                            削除
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
            @endforeach
            @endisset

            <div class="border-left border-top p-2">
                @include("topic.component.form_comment_reply")
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="container p-4">
    {{ $comments->links() }}
</div>


@endsection

@section('vue_mixin')
<script>
    Laravel.vueMixins.push({
        data: {
            classObject: {
                'my-bg-success': true,
            }
        },
        methods: {
            newCommentCheck(comment_id, session_id) {
                if (comment_id == session_id) {
                    return this.classObject;
                }
            }
        },
    })
</script>
@endsection
