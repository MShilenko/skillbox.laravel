@component('mail::message')
# Изменена статья "{{ $post->title }}"

{{ $post->excerpt }}

@component('mail::button', [
	'url' => route('posts.show', ['post' => $post])
])
Перейти на страницу статьи
@endcomponent

{{ config('app.name') }}
@endcomponent
