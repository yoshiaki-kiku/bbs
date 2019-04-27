@extends("layout.main")

@section("content")

<div class="mx-2">
    <div class="bg-white p-3 mb-4">
        <form action="{{ route('search.result') }}" class="d-flex flex-row w-100" method="get">
            <div class="flex-grow-1 mr-2">
                <input name="keywords" type="text" value="{{ old('keywords') }}" class="form-control" placeholder=""
                    aria-label="" aria-describedby="basic-addon1">
            </div>
            <div>
                <button class="btn btn-success" type="submit">検索</button>
            </div>
        </form>

        @if(empty($results))
        <div class="alert alert-danger mt-3" role="alert">
            キーワードを入力して検索してください。
        </div>
        @endif
    </div>

    <h2 class="p-3 mb-0 bg-white">
        検索結果 {{ $resultsCount }} 件
    </h2>
</div>

@if(isset($results))

@foreach($results as $result)
<div class="card border mx-2 my-4">
    <h3 class="card-header topic-title-background">{{ $result->title }}</h3>
    <div class="card-body">
        <p class="card-text">{!! $result->message_br !!}</p>
        <div class="row">
            <p class="col text-right">{{ $result->date }}</p>
        </div>
        <a href="{{ route('topic.page', [$result->id]) }}" class="btn btn-primary">
            コメントを見る
            <span class="badge badge-pill badge-light">{{ $numberOfComments[$loop->index] }}</span>
        </a>
    </div>
</div>
@endforeach
<div class="container mt-4">
    {{ $results->appends(["keywords" => old('keywords')])->onEachSide(1)->links() }}
</div>
@endif

@endsection
