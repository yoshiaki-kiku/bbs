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
    <div class="alert alert-info">
        <p>
            コメントを投稿するにはユーザーログインが必要です。<br>
            編集、削除するには管理者ログインが必要です。<br>
            テスト用に以下のユーザーが利用可能です。
        </p>
        <p>
            管理者<br>
            ID: admin@mail<br>
            password: pass<br>
        </p>
        <p>
            一般ユーザー<br>
            ID:user@mail<br>
            password:pass<br>
        </p>
    </div>
    @endif

    <form action="{{ route('topic.page', $topic->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-2">
            <textarea class="form-control" name="message" value="{{ old('message') }}" id=""
                placeholder="コメントを入力してください。" rows="3"></textarea>
        </div>
        <select-file-component></select-file-component>
        <div class="text-right">
            <input class="btn btn-primary{{ $disabledButton }}" type="submit" name="newComment" value="投稿する"
                {{ $disabledButton }}>
        </div>
    </form>
</div>
