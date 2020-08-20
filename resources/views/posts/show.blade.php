@extends('layout.master')

@section('title', $post->title)

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  {{ $post->title }} | <a href="{{ route('posts.edit', ['post' => $post]) }}">Изменить</a>
	</h3>

	@include('posts.tags', ['tags' => $post->tags])

	<div class="blog-post">
	  <p class="blog-post-meta">Опубликовано: {{ $post->created_at }}</p>
	  {{ $post->text }}
	</div><!-- /.blog-post -->

	<nav class="blog-pagination">
	  <a class="btn btn-outline-primary" href="{{ route('main') }}">Вернуться на главную</a>
	</nav>

@endsection