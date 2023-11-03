{{-- 189-19 --}}
@component('mail::message')

# 新しいユーザーが追加されました！

{{-- 183-11 --}}
{{-- 新しいユーザーが追加されました --}}
{{-- 188-17 --}}
{{ $toUser->name }}さんこんにちは！

{{-- 190-22 --}}
@component('mail::panel')
    新しく{{ $newUser->name }}さんが参加されましたよ！
@endcomponent

{{-- 190-22 --}}
@component('mail::button', ['url' => route('tweet.index')])
    つぶやきを見に行く
@endcomponent

@endcomponent