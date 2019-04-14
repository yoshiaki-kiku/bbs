@extends("layout.main")

@section("content")

<form action="{{ route('search.result') }}" class="d-flex flex-row w-100 mb-3" method="get">
    <div class="flex-grow-1 mr-2">
        <input name="keywords" type="text" class="form-control" placeholder="" aria-label=""
            aria-describedby="basic-addon1">
    </div>
    <div>
        <button class="btn btn-success" type="submit">検索</button>
    </div>
</form>

@if(empty($results))
<div class="alert alert-danger" role="alert">
    キーワードを入力して検索してください。
</div>
@else
{{ $results->count() }} 件 ヒットしました。
@foreach($results as $result)
{{ $result->topic->title }} <br>
@endforeach
<div class="container mt-4">
    {{ $results->onEachSide(1)->links() }}
</div>
@endif




@endsection
