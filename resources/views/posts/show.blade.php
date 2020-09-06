@extends('layout.master')

@section('title', $post->title)

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  {{ $post->title }}
 
  	@can('update', $post)
   		| <a href="@editPost($post)">Изменить</a>
   	@endcan
	</h3>

	@include('layout.tags', ['tags' => $post->tags])

	<div class="blog-post">
	  <p class="blog-post-meta">Опубликовано: {{ $post->created_at }}</p>
	  {{ $post->text }}
	</div><!-- /.blog-post -->

	@include('layout.forms.comment', ['model' => 'App\Post', 'id' => $post->id])	

	@if ($post->comments()->exists())
		@include('layout.comments', ['comments' => $post->comments])
	@endif

	@admin
		<hr>

		@forelse($post->history as $item)
			<p>Автор: {{ $item->name }}</p>
			<p>Дата изменения: {{ $item->pivot->created_at->diffForHumans() }}</p>
			<p>Затронутые поля:</p>
			<table class="table">
				<tbody>
					@foreach(json_decode($item->pivot->changes) as $key => $item)
						<tr>
							<td>{{ $key }}</td>
							<td>{{ $item }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@empty
			<p>Статья еще не изменялась.</p>
		@endforelse
	@endadmin	

	<nav class="blog-pagination">
	  <a class="btn btn-outline-primary" href="{{ route('main') }}">Вернуться на главную</a>
	</nav>

@endsection