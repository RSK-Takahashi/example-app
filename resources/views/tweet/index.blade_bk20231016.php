<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>つぶやきアプリ</title>
    {{-- 149-07 --}}
    {{-- <link href="/css/app.css" rel="stylesheet"> --}}
    {{-- 149-09 --}}
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('/js/app.js') }}"></script>
</head>
<body>
    <h1>つぶやきアプリ</h1>
    {{-- 126-20 --}}
    @auth
        <div>
            <p>投稿フォーム</p>
            {{-- 96-03 --}}
            @if (session('feedback.success'))
                <p style="color: green">{{ session('feedback.success') }}</p>
            @endif
            <form action="{{ route('tweet.create') }}" method="post">
                @csrf
                <label for="tweet-content">つぶやき</label>
                <span>140文字まで</span>
                <textarea id="tweet-content" type="text" name="tweet" placeholder="つぶやきを入力"></textarea>
                {{-- 2-08 --}}
                @error('tweet')
                <p style="color: red;">{{ $message }}</p>
                @enderror
                <button type="submit">投稿</button>
            </form>
        </div>
    @endauth
    <div>
    {{-- 41 --}}
    @foreach($tweets as $tweet)
        {{-- <p>{{ $name }}</p> --}}
        {{-- <p>{{ $tweet->content }}</p> --}}
        {{-- 93-17 --}}
        <details>
            {{-- <summary>{{ $tweet->content }}</summary> --}}
            {{-- 135-30 --}}
            <summary>{{ $tweet->content }} by {{ $tweet->user->name }}</summary>
            {{-- 141-38 --}}
            @if(\Illuminate\Support\Facades\Auth::id() === $tweet->user_id)
                <div>
                    <a href="{{ route('tweet.update.index', ['tweetId' => $tweet->id]) }}">編集</a>
                    <form action="{{ route('tweet.delete', ['tweetId' => $tweet->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit">削除</button>
                    </form>
                </div>
            {{-- 141-38 --}}
            @else
                編集できません
            @endif
        </details>
    @endforeach
    </div>
</body>
</html>
