@extends('layout.master')

@section('title', $news->title)

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  {{ $news->title }}
 
  	@can('update', $news)
   		| <a href="{{ route('admin.news.edit', ['news' => $news]) }}">Изменить</a>
   	@endcan
	</h3>

	@include('layout.tags', ['tags' => $news->tags])

	<div class="blog-news">
	  <p class="blog-news-meta">Опубликовано: {{ $news->created_at }}</p>
	  {{ $news->text }}
	</div><!-- /.blog-news -->	

	<nav class="blog-pagination">
	  <a class="btn btn-outline-primary" href="{{ route('main') }}">Вернуться на главную</a>
	</nav>

@endsection