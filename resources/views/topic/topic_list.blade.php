@extends("layout.main")

@section("content")

@include("topic.component.form_topic")
@foreach($topics as $topic)
<div class="card border mx-2 my-4">
    <h3 class="card-header topic-title-background">{{ $topic->title }}</h3>
    <div class="card-body">
        <p class="card-text">{!! $topic->message_br !!}</p>
        @isset($topic->image_path)
        <div>
            <img class="img-thumbnail" src="{{ asset('/storage/post_images/' .$topic->image_path) }}">
        </div>
        @endisset
        <div class="row">
            <p class="col text-right">{{ $topic->date }}</p>
        </div>
        <a href="{{ route('topic.page', [$topic->id]) }}" class="btn btn-primary">
            コメントを見る
            <span class="badge badge-pill badge-light">{{ $numberOfComments[$loop->index] }}</span>
        </a>
        @can("admin")
        <a href="{{ route('topic.update.form', [$topic->id]) }}" class="btn btn-warning ml-2">
            編集
        </a>
        <a href="{{ route('topic.delete.confirm', [$topic->id]) }}" class="btn btn-danger ml-2">
            削除
        </a>
        @endcan
    </div>
</div>
@endforeach


<div class="container mt-4">
    {{ $topics->onEachSide(1)->links() }}
</div>
@endsection
