@extends('layout.master')

@section('title', 'Статьи')

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  Статьи
	</h3>

	@foreach ($posts as $post)
		<div class="blog-post">
		  <h2 class="blog-post-title"><a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a></h2>

		 	@include('posts.tags', ['tags' => $post->tags])

		  <p class="blog-post-meta">Опубликовано: {{ $post->created_at }}</p>
		  {{ $post->excerpt }}
		</div><!-- /.blog-post -->
	@endforeach

	<nav class="blog-pagination">
	  <a class="btn btn-outline-primary" href="#">Older</a>
	  <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
	</nav>

@endsection