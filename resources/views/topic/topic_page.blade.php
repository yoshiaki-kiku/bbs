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
                <button type="button" class="btn btn-sm mr-auto" v-on:click="toggleAccordion({{ $comment->id }})"
                    v-bind:class="replyButtonColor(show[{{ $comment->id }}])">
                    ▼ 返信
                    <span class="ml-1 my-font-bold">
                        {{ $commentRepliesCount[$comment->id] }}
                    </span>
                </button>
            </div>
        </div>
        {{-- 返信コメントエリア --}}
        {{-- コメントがあるdivはデフォで開く --}}

        <transition v-on:before-enter="onBeforeEnter" v-on:enter="onEnter" v-on:before-leave="onBeforeLeave"
            v-on:leave="onLeave">
            <div class="pt-2 pl-3 my-accordion" id="accordion{{ $comment->id }}" v-show="show[{{ $comment->id }}]">
                @isset($commentReplies[$comment->id])
                @foreach($commentReplies[$comment->id] as $commentReply)
                <div class="container border-left border-top py-2 px-0" id="{{ $commentReply->id }}"
                    v-bind:class="newCommentCheck({{ $commentReply->id }}, {{ session('new_comment_id') }})">
                    <div class="px-2">
                        <div class="d-flex flex-row">
                            <div class="mr-2" style="height:40px;">
                                <img data-src="holder.js/40x40?theme=sky&size=8">
                            </div>
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
        </transition>
    </div>
    @endforeach
</div>

<div class="container p-4">
    {{ $comments->links() }}
</div>
@endsection

@section('vue_mixin')
<script>
    var showData = @json($commentRepliesFlagJson);

    Laravel.vueMixins.push({
        data: {
            show: showData,
        },

        // アコーディオンパネルの高さに初期値を与える
        // 与えないと初期に開いてるパネルの閉じ動作でアニメーションが適用されない
        mounted: function () {
            self = this;
            Object.keys(this.show).forEach(function (key) {
                if (self.show[key]) {
                    var el = document.getElementById('accordion' + key);
                    el.style.height = el.scrollHeight + 'px';
                }
            })
        },

        methods: {
            // セッションIDと照らし合わせて
            // 新規コメントのbgカラーを変更
            newCommentCheck(comment_id, session_id) {
                if (comment_id == session_id) {
                    return {
                        'my-bg-success': true,
                    };
                }
            },

            // 返信ボタンのONOFFで色を変更
            replyButtonColor(flag) {
                var replyFlag;
                if (flag) {
                    replyFlag = true
                } else {
                    replyFlag = false
                }

                return {
                    'btn-outline-dark': !replyFlag,
                    'btn-secondary': replyFlag
                }
            },

            // アコーディオンパネルのボタン処理
            toggleAccordion(commentId) {
                if (this.show[commentId]) {
                    this.$delete(this.show, commentId);
                } else {
                    this.$set(this.show, commentId, true);
                }
            },

            onBeforeEnter: function (el) {
                el.style.height = 0;
            },
            onEnter: function (el) {
                el.style.height = el.scrollHeight + 'px';
            },
            onBeforeLeave: function (el) {
                el.style.height = el.scrollHeight + 'px';
            },
            onLeave: function (el) {
                el.style.height = 0;
            }

        },
    })
</script>
@endsection
