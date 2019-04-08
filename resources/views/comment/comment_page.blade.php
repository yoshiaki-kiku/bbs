@extends("layout.main")

@section("content")
<div class="container bg-white m-4 p-0 mx-auto">
    @foreach($comments as $comment)
    <div class="media border pt-2 pr-2 pb-3 pl-2">
        <img data-src="holder.js/48x48?theme=sky&size=8">
        <div class="media-body pl-2">
            <div class="mt-0 mb-2">{{ $comment->user->name }}｜{{ $comment->date }}</div>
            {{ $comment->message }}
        </div>
    </div>
    @endforeach
</div>

<div class="container p-4">
    {{ $comments->links() }}
</div>
@endsection
