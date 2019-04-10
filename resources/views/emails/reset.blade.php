<h3>
    <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
</h3>
<p>
    下のリンクをクリックしてパスワードを再設定してください。<br>
    パスワードのリセットを要求しなかった場合は、これ以上の操作は不要です。
</p>
<p>
    {{ $actionText }}: <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
</p>
