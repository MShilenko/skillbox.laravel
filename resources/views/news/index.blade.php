@extends('layout.master')

@section('title', 'Новости')

@section('content')

	<h3 class="pb-3 mb-4 font-italic border-bottom">
	  Новости
	</h3>

	@foreach ($news as $post)
		<div class="blog-news">
		  <h2 class="blog-news-title"><a href="{{ route('news.show', ['news' => $post]) }}">{{ $post->title }}</a></h2>

		 	@include('layout.tags', ['tags' => $post->tags])

		  <p class="blog-news-meta">Опубликовано: {{ $post->created_at }}</p>
		  {{ $post->excerpt }}
		</div><!-- /.blog-news -->
	@endforeach

	{{ $news->links() }}

@endsection