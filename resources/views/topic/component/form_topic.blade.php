<div class="bg-white m-2 p-3">
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
            トピックを投稿するにはユーザーログインが必要です。<br>
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
            ID:admin@mail<br>
            password:pass<br>
        </p>
    </div>
    @endif

    <form action="{{ route('home') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" id=""
                placeholder="タイトルを入力してください。">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="message" value="{{ old('message') }}" id=""
                placeholder="コメントを入力してください。" rows="3"></textarea>
        </div>
        <select-file-component></select-file-component>
        <div class="text-right">
            @if(Auth::check())
            <button type="submit" class="btn btn-primary">トピックを投稿</button>
            @else
            <button type="submit" class="btn btn-primary disabled text-right" disabled>トピックを投稿</button>
            @endif
        </div>
    </form>
</div>
