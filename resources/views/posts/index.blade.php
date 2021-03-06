@extends('layout.master')

@section('title', 'Статьи')

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  Статьи
	</h3>

	@foreach ($posts as $post)
		<div class="blog-post">
		  <h2 class="blog-post-title"><a href="{{ route($post->getTable() . '.show', ['post' => $post]) }}">{{ $post->title }}</a></h2>

		  @include('layout.tags', ['tags' => $post->tags])

		  <p class="blog-post-meta">Опубликовано: {{ $post->created_at }}</p>
		  {{ $post->excerpt }}
		</div><!-- /.blog-post -->
	@endforeach

	{{ $posts->links() }}

@endsection