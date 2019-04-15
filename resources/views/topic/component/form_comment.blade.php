<div class="container py-2">
    {{-- フラッシュメッセージの表示 --}}
    @if (session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(Auth::guest())
    <div class="alert alert-info">投稿するにはログインが必要です。</div>
    @endif

    <form action="{{ route('topic.page', $topic->id) }}" method="POST">
        @csrf
        <div class="form-group mb-2">
            <textarea class="form-control" name="message" value="{{ old('message') }}" id=""
                placeholder="コメントを入力してください。" rows="3"></textarea>
        </div>
        <div class="text-right">
            <input class="btn btn-primary{{ $disabledButton }}" type="submit" name="newComment" value="投稿する"
                {{ $disabledButton }}>
        </div>
    </form>
</div>
