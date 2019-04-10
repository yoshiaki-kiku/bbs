<div class="container py-2">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('topic.page', $topic->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <textarea class="form-control" name="message" value="{{ old('message') }}" id=""
                placeholder="コメントを入力してください。" rows="3"></textarea>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">コメントを投稿</button>
        </div>
    </form>
</div>
