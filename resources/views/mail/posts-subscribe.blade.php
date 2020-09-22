@component('mail::message')
# Статьи за период c {{ $start }} по {{ $end }}

@component('mail::table')
| Название статьи    | Описание статьи      | Дата публикации         |
| :----------------: | -------------------- | :---------------------: |
@foreach($posts as $post)
| {{ $post->title }} | {{ $post->excerpt }} | {{ $post->created_at }} |
@endforeach
@endcomponent

@component('mail::button', [
	'url' => route('main')
])
Посмотреть все статьи
@endcomponent

{{ config('app.name') }}
@endcomponent