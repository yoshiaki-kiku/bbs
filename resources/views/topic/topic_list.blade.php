@extends("layout.main")

@section("content")

@include("layout.form_topic")

<div class="container">
    @foreach($topics as $topic)
    <div class="pt-4"></div>
    <div class="card border">
        <h3 class="card-header bg-dark text-white">{{ $topic->title }}</h3>
        <div class="card-body">
            <p class="card-text">{!! $topic->message_br !!}</p>
            <div class="row">
                <p class="col text-right">{{ $topic->date }}</p>
            </div>
            <a href="{{ route('topic.page', [$topic->id]) }}" class="btn btn-primary">
                コメントを見る
                <span class="badge badge-pill badge-light">{{ $numberOfComments[$loop->index] }}</span>
            </a>
        </div>
    </div>
    @endforeach
</div>
<div class="container mt-4">
    {{ $topics->links() }}
</div>
@endsection
