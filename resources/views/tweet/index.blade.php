<x-layout title="TOP | つぶやきアプリ">
    {{-- <h1>ここに内容が入ります</h1> --}}
    {{-- 153-15 --}}
    {{-- <x-slot name="aside">追加したslot</x-slot> --}}

    {{-- 156-20 --}}
    <x-layout.single>
        <h2 class="text-center text-blue-500 text-4xl font-bold mt-8 mb-8">
            つぶやきアプリ
        </h2>
        <x-tweet.form.post></x-tweet.form.post>
        {{-- 161-29 --}}
        <x-tweet.list :tweets="$tweets"></x-tweet.list>
        @php phpinfo(); @endphp
    </x-layout.single>
</x-layout>
